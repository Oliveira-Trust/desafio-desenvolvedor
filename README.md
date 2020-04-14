# Desafio Desenvolvedor Oliveira Trust

O app está separado em Frontend e Backend 

# Frontend

Copiar arquivo env de exemplo
```
cp .env.example .env
```

Instalar dependencias
```
npm install
```

Rodar servidor de desenvolvimento
```
npm start
```

O app Frontend será levantado em http://localhost:3000


# Backend

Copiar arquivo env de exemplo
```
cp .env.example .env
```

Rodar docker compose (-d flag para o modo daemon)
```
docker-compose up -d
```

Rodando migrations e seeds
```
docker-compose exec app php artisan migrate:refresh --seeder
```

Usuário criado pela seed
```
Login: user@teste.com
Senha: 1234
```

Gerar a key JWT
```
docker-compose exec app php artisan jwt:secret
```

A API será levantada em http://localhost:8080
