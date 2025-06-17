import pandas as pd
from sqlalchemy import create_engine, text
from typing import List, Optional

# Usaremos um banco de dados SQLite em memória para simplificar
DATABASE_URL = "sqlite:///./test.db"
engine = create_engine(DATABASE_URL, connect_args={"check_same_thread": False})

def initialize_database():
    """Cria as tabelas no banco de dados se não existirem."""
    with engine.connect() as connection:
        connection.execute(text("""
        CREATE TABLE IF NOT EXISTS instruments (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            RptDt DATE,
            TckrSymb TEXT,
            MktNm TEXT,
            SctyCtgyNm TEXT,
            ISIN TEXT,
            CrpnNm TEXT
        );
        """))
        connection.execute(text("""
        CREATE TABLE IF NOT EXISTS upload_history (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            filename TEXT,
            upload_date DATE,
            file_hash TEXT UNIQUE
        );
        """))

def is_file_processed(file_hash: str) -> bool:
    """Verifica se um arquivo já foi processado"""
    with engine.connect() as connection:
        result = connection.execute(
            text("SELECT 1 FROM upload_history WHERE file_hash = :file_hash"),
            {"file_hash": file_hash}
        ).scalar()
        return result is not None

def save_file_data(df: pd.DataFrame, filename: str, file_hash: str):
    """
    Salva os dados do DataFrame no banco e registra o histórico.
    Usa 'to_sql' do Pandas para uma inserção em massa eficiente.
    """
    # Garante que as colunas do DataFrame correspondem às da tabela
    columns_to_save = ['RptDt', 'TckrSymb', 'MktNm', 'SctyCtgyNm', 'ISIN', 'CrpnNm']
    df_to_save = df[columns_to_save]  # type: ignore

    df_to_save.to_sql('instruments', engine, if_exists='append', index=False)

    with engine.connect() as connection:
        connection.execute(
            text("INSERT INTO upload_history (filename, upload_date, file_hash) VALUES (:name, CURRENT_DATE, :hash)"),
            {"name": filename, "hash": file_hash}
        )
        connection.commit()

def search_instruments(TckrSymb: Optional[str] = None, RptDt: Optional[str] = None, page: int = 1, page_size: int = 20):
    """Busca instrumentos com paginação e filtros opcionais."""
    offset = (page - 1) * page_size
    query = "SELECT RptDt, TckrSymb, MktNm, SctyCtgyNm, ISIN, CrpnNm FROM instruments WHERE 1=1 "
    params = {}

    if TckrSymb:
        query += " AND TckrSymb = :tckr"
        params["tckr"] = TckrSymb

    if RptDt:
        query += " AND RptDt = :rpt_dt"
        params["rpt_dt"] = RptDt

    query += " LIMIT :limit OFFSET :offset"
    params["limit"] = page_size
    params["offset"] = offset

    with engine.connect() as connection:
        result = connection.execute(text(query), params).fetchall()
        return [dict(row._mapping) for row in result]

def get_upload_history(filename: Optional[str] = None, upload_date: Optional[str] = None):
    """Busca o histórico de uploads com filtros."""
    query = "SELECT filename, upload_date FROM upload_history WHERE 1=1 "
    params = {}

    if filename:
        query += " AND filename = :filename"
        params["filename"] = f"%{filename}%"
    if upload_date:
        query += " AND upload_date = :upload_date"
        params["upload_date"] = upload_date

    with engine.connect() as connection:
        result = connection.execute(text(query), params).fetchall()
        return [dict(row._mapping) for row in result]

# Inicializa o banco ao carregar o módulo
initialize_database()
