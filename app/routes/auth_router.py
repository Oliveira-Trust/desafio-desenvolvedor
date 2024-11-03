from app.auth import create_access_token, hash_password, verify_password
from app.database import accounts_collection
from app.models import Token, UserCreate
from fastapi import APIRouter, Depends, HTTPException
from fastapi.security import OAuth2PasswordRequestForm

router = APIRouter(prefix='/auth', tags=['Authentication'])


@router.post('/register', response_model=Token)
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


@router.post('/token', response_model=Token)
async def login(form_data: OAuth2PasswordRequestForm = Depends()):
    db_user = await accounts_collection.find_one({
        'username': form_data.username
    })

    if not db_user or not verify_password(
        form_data.password, db_user['password']
    ):
        raise HTTPException(
            status_code=400,
            detail='Usuário ou senha incorretos',
            headers={'WWW-Authenticate': 'Bearer'},
        )

    access_token = create_access_token(data={'sub': str(db_user['username'])})

    return {'access_token': access_token, 'token_type': 'bearer'}
