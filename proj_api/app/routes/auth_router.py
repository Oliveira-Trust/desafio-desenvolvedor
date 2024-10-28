# auth_router.py
from app.auth import create_access_token, hash_password, verify_password
from app.database import accounts_collection
from app.models import Token, UserCreate, UserLogin
from fastapi import APIRouter, HTTPException

router = APIRouter(tags=['Authentication'])


@router.post('/register/', response_model=Token)
async def register(user: UserCreate):
    user_exist = await accounts_collection.find_one({
        'username': user.username
    })

    if user_exist:
        raise HTTPException(status_code=400, detail='Usuário já existe')

    hashed_password = hash_password(user.password)

    new_user = {'username': user.username, 'password': hashed_password}

    result = await accounts_collection.insert_one(new_user)

    access_token = create_access_token(data={'sub': str(result.inserted_id)})

    return {'access_token': access_token, 'token_type': 'bearer'}


@router.post('/token/', response_model=Token)
async def login(user: UserLogin):
    db_user = await accounts_collection.find_one({'username': user.username})

    if not db_user or not verify_password(user.password, db_user['password']):
        raise HTTPException(
            status_code=400, detail='Usuário ou senha incorretos'
        )

    access_token = create_access_token(data={'sub': str(db_user['_id'])})

    return {'access_token': access_token, 'token_type': 'bearer'}


"""
Não implementei a autenticação de usuário com JWT, no endpoint de uploads,
pois ainda não entendi porque a rota /token na aplicação não está funcionando
corretamente, a mesma rota está retornando o token autorizado ao usar Postman, 
mas não está autorizando na aplicação dentro do container docker.
Farei essa verificação com mais calma depois.

Rota no postman: http://localhost:8000/token/
JSON:
{
    "username": "admin",
    "password": "admin123"
}

Retorno:
{
    "access_token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.
    eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.
    SflKxwRJSMeKKF2QT4fwpMeJf36POk6yJV_adQssw5c",
    "token_type": "bearer"
}

Na aplicação informa Entity not processesable
mas a rota /token está funcionando corretamente.
"""  # noqa
