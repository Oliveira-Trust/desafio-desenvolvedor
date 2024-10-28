from pydantic import BaseModel


# Modelo para JWT criar um novo usuário
class UserCreate(BaseModel):
    username: str
    password: str


# Modelo para a resposta do token
class Token(BaseModel):
    access_token: str
    token_type: str


# Modelo para login
class UserLogin(BaseModel):
    username: str
    password: str
