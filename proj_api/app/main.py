from contextlib import asynccontextmanager

from fastapi import FastAPI

from app.database import client, initialize_databases
from app.routes import auth_router, upload_router


@asynccontextmanager
async def lifespan(app: FastAPI):
    # Armazena a instância do client MongoDB.
    app.state.db = client
    # Inicializa as coleções do MongoDB.
    await initialize_databases()
    yield

    # Fecha a conexão com o MongoDB.
    app.state.db.close()


app = FastAPI(
    lifespan=lifespan,
    swagger_ui_parameters={'defaultModelsExpandDepth': 0},
    title='Oliveira-Trust - Desafio Desenvolvedor API',
)


# Mensagem de boas-vindas para a raiz da API.
# Não é necessário, mas é apenas para orientar o usuário.
@app.get('/', include_in_schema=False)
def root():
    return {'message': 'Bem-vindo ao desafio do Desenvolvedor API!'}


app.include_router(upload_router.router)
app.include_router(auth_router.router)
