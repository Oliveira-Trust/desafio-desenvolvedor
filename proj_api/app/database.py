from motor.motor_asyncio import AsyncIOMotorClient

# Conexão com MongoDB
MONGODB_URL = 'mongodb://mongodb_container:27017'
client = AsyncIOMotorClient(MONGODB_URL)

# Bancos
historico_db = client['historico']
datalake_db = client['datalake']
accounts_db = client['accounts']

# Coleções
historico_collection = historico_db['uploads']
datalake_collection = datalake_db['dados']
accounts_collection = accounts_db['users']


# Função para inicializar bancos e coleções
async def initialize_databases():
    # Cria um documento temporário se a coleção estiver vazia, depois remove
    if not await historico_collection.count_documents({}):
        await historico_collection.insert_one({'init': 'init'})
        await historico_collection.delete_one({'init': 'init'})

    if not await datalake_collection.count_documents({}):
        await datalake_collection.insert_one({'init': 'init'})
        await datalake_collection.delete_one({'init': 'init'})
