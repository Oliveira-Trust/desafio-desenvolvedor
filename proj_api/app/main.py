from fastapi import FastAPI
from app.routes import router

app = FastAPI()

# Página de boavinda para não apresentar nada vazio.
@app.get("/", include_in_schema=False)
def root():
    return {"message": "Bem-vindo ao desafio do Desenvolvedor API!"}

# Inclusão das rotas.
app.include_router(router)
