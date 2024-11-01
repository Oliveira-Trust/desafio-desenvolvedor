import re
from datetime import datetime, timedelta, timezone
from typing import List, Optional

import pandas as pd
from app.auth import get_current_user
from app.database import datalake_collection, historico_collection
from fastapi import (
    APIRouter,
    Depends,
    File,
    HTTPException,
    Query,
    UploadFile,
)

router = APIRouter(tags=['Upload Files'])


# Função para serializar o ObjectId do MongoDB
def serialize_document(doc):
    """
    serialize_document(doc)
    - Função para converter um documento do MongoDB
    """
    if doc:
        # Converte ObjectId para string
        doc['_id'] = str(doc['_id'])
    return doc


# Endpoint de Upload de Arquivo
@router.post('/upload/')
async def upload_file(
    file: UploadFile = File(...),  # Arquivo a ser enviado.
    current_user: dict = Depends(get_current_user),  # Usuário autenticado.
):
    if not file.filename.endswith(('.csv', '.xls', '.xlsx')):
        raise HTTPException(
            status_code=400, detail='Formato de arquivo não suportado.'
        )

    # Verifica se o arquivo já foi enviado anteriormente.
    existing_file = await historico_collection.find_one({
        'filename': file.filename
    })

    if existing_file:
        raise HTTPException(
            status_code=409, detail='Arquivo já foi enviado anteriormente.'
        )

    """
    Lê o conteúdo do arquivo ignorando a primeira linha que não tem informação
    relevante e definindo a partir da segunda linha como cabeçalho que contém
    os nomes das colunas.
    """  # noqa
    try:
        if file.filename.endswith('.csv'):
            df = pd.read_csv(
                file.file,
                encoding='ISO-8859-1',  # Define a codificação do arquivo.
                on_bad_lines='skip',  # Ignora linhas com problemas.
                skiprows=1,  # Ignora a primeira linha do arquivo.
                dtype=str,  # Definindo os dados como string.
                delimiter=';',  # Define o delimitador de colunas para ';'.
            )

        elif file.filename.endswith('.xlsx'):
            # Define a engine 'openpyxl' para o Pandas ler arquivos '.xlsx'.
            df = pd.read_excel(
                file.file,
                engine='openpyxl',  # Define a engine para o Pandas.
                skiprows=1,
                dtype=str,
            )

        elif file.filename.endswith('.xls'):
            # Define a engine 'xlrd' para o Pandas ler arquivos '.xls'.
            df = pd.read_excel(
                file.file,
                engine='xlrd',  # Define a engine para o Pandas.
                skiprows=1,
                dtype=str,
            )

        else:
            raise HTTPException(
                status_code=400, detail='Formato de arquivo não suportado.'
            )

        """ 
        Força a coluna 'RptDt' a ser tratada pelo Pandas como string nos 
        casos de importação vinda de arquivos xls e xlsx e remove a parte 
        que o Pandas preenche a data com horário 00:00:00
        Isso não acontece nos casos de arquivos csv.
        """  # noqa
        if 'RptDt' in df.columns:
            df['RptDt'] = df['RptDt'].astype(str).str.split().str[0]

        # Substitui 'NaN' do arquivo por 'None' quando não há valor.
        df = df.where(pd.notnull(df), None)

        # Conto o total de registros importados (linhas) no DataFrame.
        total_registros = df.shape[0]

    except UnicodeDecodeError as e:
        raise HTTPException(
            status_code=400, detail=f'Erro ao ler o arquivo: {e}'
        )
    except Exception as e:
        raise HTTPException(status_code=500, detail=f'Erro inesperado: {e}')

    # Filtro apenas as colunas que foram pedidas.
    colunas_obrigatorias = [
        'RptDt',
        'TckrSymb',
        'MktNm',
        'SctyCtgyNm',
        'ISIN',
        'CrpnNm',
    ]

    # Verifico se todas as colunas obrigatórias estão presentes no arquivo.
    colunas_disponiveis = set(df.columns.tolist())
    colunas_faltando = [
        col for col in colunas_obrigatorias if col not in colunas_disponiveis
    ]

    if colunas_faltando:
        raise HTTPException(
            status_code=400,
            detail=f"""O arquivo pode estar faltando algumas
                  colunas obrigatórias: {colunas_faltando}""",
        )

    # Seleciono no Dataframe apenas as colunas obrigatórias.
    df = df[colunas_obrigatorias]

    # Converto o dataframe em uma lista de dicionários.
    records = df.to_dict(orient='records')

    # Armazena o histórico do upload no banco "historico".
    upload_info = {
        'filename': file.filename,
        'upload_date': datetime.now(timezone.utc),
    }

    await historico_collection.insert_one(upload_info)

    # Armazeno os dados do arquivo na coleção "datalake"
    await datalake_collection.insert_many(records)

    return {
        'filename': file.filename,
        'message': 'Upload bem-sucedido',
        'total_registers': total_registros,
    }


# Endpoint de Histórico de Uploads
@router.get('/upload/history/', response_model=List[dict])
async def upload_history(
    filename: Optional[str] = None,  # Nome do arquivo.
    date: Optional[str] = None,  # Data do upload.
    page: int = Query(1, ge=1),  # Página inicial.
    limit: int = Query(10, ge=1, le=100),  # Qtde de registros por página.
    current_user: dict = Depends(get_current_user),  # Usuário autenticado.
):
    query = {}

    if filename:
        query['filename'] = filename

    if date:
        try:
            # Transforma a data em datetime para
            # compatibilidade com o MongoDB.
            query_date = datetime.strptime(date, '%Y-%m-%d')
            next_day = query_date + timedelta(days=1)
            query['upload_date'] = {'$gte': query_date, '$lt': next_day}

        except ValueError:
            raise HTTPException(
                status_code=400,
                detail='Formato de data inválido. Use o formato ISO (YYYY-MM-DD).',  # noqa
            )

    # Consulta feita com paginação.
    skip = (page - 1) * limit
    uploads = (
        await historico_collection.find(query)
        .skip(skip)
        .limit(limit)
        .to_list(length=limit)
    )

    # Serializa cada documento antes de retorná-lo.
    uploads_serialized = [serialize_document(upload) for upload in uploads]

    # Se não houver uploads, retornará uma mensagem.
    if not uploads_serialized:
        raise HTTPException(
            status_code=404,
            detail='Nenhum upload encontrado com os critérios especificados.',
        )
    # Retornando apenas a lista de uploads.
    return uploads_serialized


# Endpoint de Busca de Conteúdo
@router.get('/upload/search/')
async def search_content(
    TckrSymb: Optional[str] = None,  # Código do Ativo.
    RptDt: Optional[str] = None,  # Data do Relatório no formato YYYY-MM-DD.
    skip: int = Query(0, ge=0),  # Página inicial.
    limit: int = Query(10, ge=1, le=100),  # Qtde de registros por página.
    current_user: dict = Depends(get_current_user),  # Usuário autenticado.
):
    query = {}

    # Adiciona os filtros apenas se os parâmetros forem fornecidos.
    if TckrSymb:
        query['TckrSymb'] = TckrSymb

    if RptDt:
        # Verifica se a data está no formato YYYY-MM-DD usando regex.
        if not re.match(r'\d{4}-\d{2}-\d{2}', RptDt):
            raise HTTPException(
                status_code=400,
                detail='Formato de data inválido. Use o formato YYYY-MM-DD.',
            )
        query['RptDt'] = RptDt

    # Consulta feita com paginação.
    results = (
        await datalake_collection.find(query)
        .skip(skip)
        .limit(limit)
        .to_list(length=limit)
    )

    # Formata os resultados para o retorno.
    formatted_results = [
        {
            'RptDt': item.get('RptDt'),
            'TckrSymb': item.get('TckrSymb'),
            'MktNm': item.get('MktNm'),
            'SctyCtgyNm': item.get('SctyCtgyNm'),
            'ISIN': item.get('ISIN'),
            'CrpnNm': item.get('CrpnNm'),
        }
        for item in results
    ]

    # Verifica se encontrou resultados.
    if not formatted_results:
        return {'message': 'Nenhum resultado encontrado com estes parâmetros!'}

    return {'results': formatted_results}
