from datetime import datetime, timezone
import pandas as pd
from fastapi import APIRouter, File, HTTPException, UploadFile

from app.database import datalake_collection, historico_collection

router = APIRouter()


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
async def upload_file(file: UploadFile = File(...)):
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
    """
    try:
        if file.filename.endswith('.csv'):
            df = pd.read_csv(
                file.file,
                encoding='ISO-8859-1',  # Define a codificação do arquivo.
                on_bad_lines='skip',  # Ignora linhas com problemas.
                skiprows=1,  # Ignora a primeira linha do arquivo.
                dtype=str,  # Defini o tipo de dado de cada coluna como string.
                delimiter=';',  # Define o delimitador de colunas para ';'.
            )
        else:
            df = pd.read_excel(file.file, skiprows=1, dtype=str)

        # Substitui NaN por None quando não há valor.
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
            detail=f'O arquivo pode estar faltando algumas\
                  colunas obrigatórias: {colunas_faltando}',
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


@router.get("/upload/history/")
async def upload_history(filename: str = None, date: str = None):
    pass


@router.get("/upload/search/")
async def search_content(TckrSymb: str = None, RptDt: str = None):
    pass