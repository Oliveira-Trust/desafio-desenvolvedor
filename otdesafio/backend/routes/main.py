from fastapi import APIRouter
from .arquivo import router as arquivoRouter

api_router = APIRouter()

api_router.include_router(arquivoRouter, prefix="/arquivos", tags=["arquivos"])
