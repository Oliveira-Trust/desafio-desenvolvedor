from sqlmodel import SQLModel
from sqlmodel import create_engine

from pydantic import PostgresDsn
from pydantic_core import MultiHostUrl

POSTGRES_PORT: int = 5432
POSTGRES_DB: str = "postgres"
POSTGRES_USER: str = "postgres"
POSTGRES_SERVER: str = "localhost"
POSTGRES_PASSWORD: str  = "postgres"
PROJECT_NAME: str = "Oliveira Trust"


def get_postgres_url() -> PostgresDsn:
    return MultiHostUrl.build(
        scheme="postgresql+psycopg",
        password=POSTGRES_PASSWORD,
        username=POSTGRES_USER,
        host=POSTGRES_SERVER,
        port=POSTGRES_PORT,
        path=POSTGRES_DB,
    )

def get_db_session():
    engine = create_engine(str(get_postgres_url()), echo=True)
    SQLModel.metadata.create_all(engine)
    return engine
