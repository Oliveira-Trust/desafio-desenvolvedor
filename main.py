from fastapi import FastAPI
from src.infrastructure.web import api

app = FastAPI(
  title="API de Instrumentos Financeiros - Desafio Oliveira Trust",
  description= "Uma API para processar e consultar dados de instrumentos financeiros",
  version="1.0.0"
)

app.include_router(api.router, prefix="/api", tags=["Instrumentos"])

@app.get("/", tags=["Root"])
def read_root():
  return {"message": "Bem-vindo à API de Instrumentos Financeiros!"}
