import pandas as pd
from sqlalchemy import create_engine, MetaData, Table, text
from io import StringIO
import csv
import logging
from core import settings
from django_rq import job

# Configurar logging
logging.basicConfig(level=logging.INFO)
logger = logging.getLogger(__name__)

@job
def consumer_spreadsheet():
    try:
        logger.info("Lendo o arquivo CSV")
        df = pd.read_csv('/code/apps/instruments/instruments_test.csv', encoding='latin1', sep=';', skiprows=1)
        logger.info("Arquivo CSV lido com sucesso")

        # Configurar a conexão com o banco de dados PostgreSQL
        database_url = f"postgresql+psycopg2://{settings.DATABASES['default']['USER']}:{settings.DATABASES['default']['PASSWORD']}@{settings.DATABASES['default']['HOST']}:{settings.DATABASES['default']['PORT']}/{settings.DATABASES['default']['NAME']}"
        engine = create_engine(database_url)
        conn = engine.connect()
        logger.info("Conexão com o banco de dados estabelecida")

        # Definir a tabela usando SQLAlchemy
        metadata = MetaData()
        table = Table('instruments_instrument', metadata, autoload_with=engine)

        # Preparar os dados
        keys = df.columns.tolist()
        data_iter = df.itertuples(index=False, name=None)
        logger.info("Dados preparados para inserção")

        # Gets a DBAPI connection that provides a cursor
        dbapi_conn = conn.connection
        with dbapi_conn.cursor() as cur:
            string_buffer = StringIO()
            writer = csv.writer(string_buffer)
            writer.writerows(data_iter)
            string_buffer.seek(0)

            columns = ', '.join(['"{}"'.format(k) for k in keys])
            if table.schema:
                table_name = '{}.{}'.format(table.schema, table.name)
            else:
                table_name = table.name

            sql = 'COPY {} ({}) FROM STDIN WITH CSV'.format(
                table_name, columns)
            logger.info(f"Executando comando COPY: {sql}")
            cur.copy_expert(sql=sql, file=string_buffer)
            logger.info("Dados inseridos com sucesso")

        # Confirmar a transação
        conn.execute("COMMIT")
        logger.info("Transação confirmada")

    except Exception as e:
        logger.error(f"Erro ao inserir dados no banco: {e}")
    finally:
        try:
            # Verificar se os dados foram inseridos
            result = conn.execute(text("SELECT COUNT(*) FROM instruments_instrument;"))
            count = result.fetchone()[0]
            logger.info(f"Número de registros na tabela: {count}")
        except Exception as e:
            logger.error(f"Erro ao verificar os dados no banco: {e}")
        finally:
            # Fechar a conexão
            conn.close()
            engine.dispose()
            logger.info("Conexão fechada")

        logger.info("Tarefa concluída")