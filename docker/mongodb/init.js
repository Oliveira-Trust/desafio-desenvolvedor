// mongodb/init.js

// Use as variáveis de ambiente definidas no docker-compose.yml
const rootUser = process.env.MONGO_INITDB_ROOT_USERNAME;
const rootPassword = process.env.MONGO_INITDB_ROOT_PASSWORD;
const appDatabase = process.env.MONGO_INITDB_DATABASE; // O banco de dados da sua aplicação
const appUser = process.env.MONGODB_USER || 'finance_user'; // Usuário específico para a aplicação (opcional)
const appPassword = process.env.MONGODB_PASSWORD || 'finance_password'; // Senha do usuário da aplicação (opcional)

// Conectar ao banco de dados 'admin' para criar o usuário da aplicação
const adminDb = db.getSiblingDB('admin');

// Autenticar como usuário root (se já existir) ou criar o usuário root
// Nota: O usuário root geralmente é criado automaticamente pelo entrypoint do Docker
// com as variáveis MONGO_INITDB_ROOT_USERNAME/PASSWORD.

// Selecionar/Criar o banco de dados da aplicação
const appDb = db.getSiblingDB(appDatabase);

// Criar um usuário específico para a aplicação (melhor prática de segurança)
// Evita usar o usuário root na aplicação Laravel
appDb.createUser({
  user: appUser,
  pwd: appPassword,
  roles: [{ role: 'readWrite', db: appDatabase }],
});

print(`Usuário '${appUser}' criado com sucesso no banco de dados '${appDatabase}'`);

// Opcional: Criar coleções iniciais (se necessário)
// Exemplo: Criar a coleção 'file_data' onde os dados serão armazenados
if (!appDb.getCollectionNames().includes('file_data')) {
  appDb.createCollection('file_data');
  print("Coleção 'file_data' criada com sucesso.");
}

// Opcional: Criar a coleção 'uploads' se for usar MongoDB para metadados também
if (!appDb.getCollectionNames().includes('uploads')) {
    appDb.createCollection('uploads');
    print("Coleção 'uploads' criada com sucesso.");
}

// Opcional: Criar a coleção 'logs' se for usar MongoDB para logging
if (!appDb.getCollectionNames().includes('logs')) {
    appDb.createCollection('logs');
    print("Coleção 'logs' criada com sucesso.");
}

print('Script de inicialização do MongoDB concluído.');