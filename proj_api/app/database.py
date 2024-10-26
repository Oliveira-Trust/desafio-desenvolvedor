# app/database.py
from motor.motor_asyncio import AsyncIOMotorClient
from fastapi import FastAPI

DATABASE_URL = "mongodb://mongodb_container:27017/upload_db"
client = AsyncIOMotorClient(DATABASE_URL)
# Nome do banco de dados
database = client.upload_db
