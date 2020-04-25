
#  Oliveira Trust

O app está separado em Api e front 
o Banco de Dados já está populado com informações de usuarios, produtos e pedidos fictício .

login para teste:

//matheus.sant4l@gmail.com
//cpassos

# Front

Entre na Pasta    
```
cd front
```

Instalar dependencias
```
npm install 
```

Rodar servidor de desenvolvimento
```
npm start
```

Será levantado em http://localhost:3000


# Backend

Copiar arquivo env de exemplo
```
cp .env.example .env
```

Rodar docker compose para subir o banco de dados MySql
```
sudo docker-compose up -d --build
```

Gerar link simbolico
```
ln -s public html
```
Para Ativar o Servidor de teste
...
php -S localhost:8004 -t public
...

Gerar a key JWT
```
php artisan jwt:secret
```

A API será levantada em http://localhost:8004/api
