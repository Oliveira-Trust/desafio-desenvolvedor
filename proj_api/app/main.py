from contextlib import asynccontextmanager

from fastapi import FastAPI

from app.database import initialize_databases
from app.routes import auth_router, upload_router


@asynccontextmanager
async def lifespan(app: FastAPI):
    # Inicializa os bancos e coleções antes de iniciar a aplicação
    # para ter certeza que os bancos estão prontos para serem usados.
    await initialize_databases()

    yield  # Mantém a aplicação ativa enquanto o servidor está rodando


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
