from datetime import datetime, timedelta, timezone

from bson import ObjectId
from fastapi import Depends, HTTPException
from fastapi.security import OAuth2PasswordBearer
from jose import JWTError, jwt
from passlib.context import CryptContext

from app.database import accounts_collection

oauth2_scheme = OAuth2PasswordBearer(tokenUrl='token')

# Configuração do hash
pwd_context = CryptContext(schemes=['bcrypt'], deprecated='auto')

# Configuração do token
# Devo enviar depois para um .env,
# não deixarei assim para produção.
SECRET_KEY = 'your_secret_key'
ALGORITHM = 'HS256'
ACCESS_TOKEN_EXPIRE_MINUTES = 30


def hash_password(password):
    return pwd_context.hash(password)


def verify_password(plain_password, hashed_password):
    return pwd_context.verify(plain_password, hashed_password)


def create_access_token(data: dict, expires_delta: timedelta = None):
    to_encode = data.copy()

    expire = datetime.now(timezone.utc) + (
        expires_delta or timedelta(minutes=ACCESS_TOKEN_EXPIRE_MINUTES)
    )

    to_encode.update({'exp': expire})
    encoded_jwt = jwt.encode(to_encode, SECRET_KEY, algorithm=ALGORITHM)
    return encoded_jwt


async def get_current_user(token: str = Depends(oauth2_scheme)):
    try:
        payload = jwt.decode(token, SECRET_KEY, algorithms=[ALGORITHM])
        user_id = payload.get('sub')
        if user_id is None:
            raise HTTPException(
                status_code=401, detail='Credenciais inválidas'
            )

        user = await accounts_collection.find_one({'_id': ObjectId(user_id)})
        if user is None:
            raise HTTPException(
                status_code=401, detail='Credenciais inválidas'
            )
        return user

    except JWTError:
        raise HTTPException(status_code=403, detail='Token de acesso inválido')
