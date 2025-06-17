import redis
import json
from typing import Optional, Any

# Conecta ao Redis. O host 'redis' é o nome do serviço no docker-compose.
# O Docker se encarrega de resolver este nome para o IP do contêiner do Redis.
redis_client = redis.Redis(host='redis', port=6379, db=0, decode_responses=True)

def get_from_cache(key:str) -> Optional[Any]:
  """Busca um valor no cache pelo sua chave."""
  cached_value = redis_client.get(key)
  if cached_value:
    print(f"CACHE HIT for key: {key}")
    return json.loads(cached_value)
  print(f"CACHE MISS for key: {key}")
  return None

def set_in_cache(key:str, value:Any, expiration_seconds: int= 300):
  """Salva um valor no cache com um tempo de expiração (default: 5 minutos)."""
  print(f"SETTING CACHE for key: {key}")
  redis_client.setex(key, expiration_seconds, json.dumps(value, default=str))

