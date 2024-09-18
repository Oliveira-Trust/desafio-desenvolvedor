from fastapi import FastAPI

from routes.main import api_router

api = FastAPI(title="Oliveira Trust")
api.include_router(api_router, prefix="/api/v1")
