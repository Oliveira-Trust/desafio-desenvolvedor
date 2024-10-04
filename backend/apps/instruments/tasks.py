import csv
import logging
from io import StringIO

from django_rq import job
from sqlalchemy import create_engine

from core import settings
from apps.instruments.utils import clean_instrument_spreadsheet
from apps.instruments.models import Instrument, InstrumentFile

# Configurar logging
logging.basicConfig(level=logging.INFO)
logger = logging.getLogger(__name__)


@job
def consumer_instrument_spreadsheet(instrument_file_pk: int):
    try:
        # Define tabela do banco
        table_name = Instrument._meta.db_table

        # Sanitiza arquivo e gera dataframe
        instrument_file = InstrumentFile.objects.filter(pk=instrument_file_pk).first()
        df = clean_instrument_spreadsheet(instrument_file)

        # Configurar a conexão com o banco de dados PostgreSQL
        db_url = f"postgresql+psycopg2://{settings.POSTGRES_USER}:{settings.POSTGRES_PASSWORD}@{settings.DB_HOST}:{settings.DB_PORT}/{settings.POSTGRES_DB}" # noqa
        engine = create_engine(db_url)

        # Estabelecer a conexão
        with engine.begin() as conn:
            # Preparar os dados para o COPY
            keys = df.columns.tolist()
            data_iter = df.itertuples(index=False, name=None)

            # Cria um buffer em memória (StringIO) para armazenar o CSV
            string_buffer = StringIO()
            writer = csv.writer(string_buffer)
            writer.writerows(data_iter)
            string_buffer.seek(0)  # Volta para o início do buffer

            # Gera o comando COPY
            columns = ', '.join([f'"{k}"' for k in keys])
            copy_sql = f'COPY {table_name} ({columns}) FROM STDIN WITH CSV'

            # Executar o comando COPY usando o cursor
            dbapi_conn = conn.connection
            with dbapi_conn.cursor() as cur:
                cur.copy_expert(sql=copy_sql, file=string_buffer)

        logger.info("Dados inseridos com sucesso.")

    except Exception as e:
        logger.info(f"Erro ao inserir dados no banco: {e}")
        raise e

    finally:
        # Fechar a conexão
        engine.dispose()
