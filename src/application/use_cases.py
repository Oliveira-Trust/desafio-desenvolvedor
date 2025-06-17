import pandas as pd
import hashlib
from typing import List, IO, Optional
from src.infrastructure.database import repositories
from src.infrastructure.cache import redis_cache

def process_file_upload (file: IO, filename: str):
    """
    Caso de uso para processar o upload de um arquivo.
    """

    file_content = file.read()
    file.seek(0) #Retorna ao inicio do arquivo para o Pandas ler

    file_hash = hashlib.sha256(file_content).hexdigest()

    if repositories.is_file_processed(file_hash):
        raise ValueError('Arquivo já processado anteriormente.')
    # Processa o arquivo com Pandas para lidar com grandes volumes
    try:
        if filename.endswith('.csv'):
            df = pd.read_csv(file, sep=';', on_bad_lines='skip')
        elif filename.endswith('.xlsx'):
            df = pd.read_excel(file, engine="openpyxl")
        else:
            raise ValueError('Formato de arquivo não suportado. Use CSV ou Excel')
    except Exception as e:
        raise ValueError(f'Erro ao ler o arquivo: {e}')

    required_columns = ['RptDt', 'TckrSymb']
    if not all(col in df.columns for col in required_columns):
        raise ValueError ("O arquivo não contem as colunas necessárias (RptDt, TckrSymb)")

    # Converte a coluna de data
    df['RptDt'] = pd.to_datetime(df['RptDt']).dt.date

    repositories.save_file_data(df, filename, file_hash)

    return {"filename": filename, "message": "Arquivo processado com sucesso"}

def find_instruments(TckrSymb: Optional[str]=None, RptDt: Optional[str]=None, page: int = 1, page_size: int = 20):
    """Caso de uso para buscar instrumentos. Agora com lógica de cache."""
     # 1. Cria uma chave de cache única para esta busca específica.
    cache_key = f"find_instruments:{TckrSymb}:{RptDt}:{page}:{page_size}"

    # 2. Tenta buscar os dados do cache primeiro.
    cached_result = redis_cache.get_from_cache(cache_key)
    if cached_result is not None:
        return cached_result
    
    # 3. Se não houver cache (cache miss), busca no banco de dados.
    db_result = repositories.search_instruments(TckrSymb, RptDt, page, page_size)

    # 4. Salva o resultado do banco no cache para futuras requisições.
    if db_result:
        redis_cache.set_in_cache(cache_key, db_result)
    
    return db_result
    return repositories.search_instruments(TckrSymb, RptDt, page, page_size)
def list_upload_history(filename: Optional[str]=None, upload_date: Optional[str]=None):
    """Caso de uso para listar o histórico de upload de arquivos."""
    return repositories.get_upload_history(filename, upload_date)
