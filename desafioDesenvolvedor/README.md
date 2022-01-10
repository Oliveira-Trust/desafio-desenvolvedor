
## Instalação

Clone o repósitorio do Gitlab
```bash
git clone https://github.com/MoisesFausto/desafio-desenvolvedor.git
```

Entre na pasta do projeto
```bash
cd .\desafio-desenvolvedor\desafioDesenvolvedor\
```   

Crie o arquivo .env
Entre na pasta do projeto
```bash
cp .\.env.example .env
```  

Instale ou atualize as depências 
Entre na pasta do projeto
```bash
composer update
```

Gere a KEY
```bash
php artisan key:generate
```

Instale as depências do NPM
```bash
npm run
```

Copile os assets
```bash
npm run dev
```

## Bando de Dados

Crie um banco de dados, com nome de:  desafio_desenvolvedor

Rode as Migration
```bash
php artisan migrate
```


## Rodar Localmente

Para rodar a aplicação digite
```bash
php artisan serve
```



## Uso

Para acessar é necessario criar um usuário na página inicial, 
no menu que fica na parte superior direita, chamado: **Cadastro**

Após efetuar o cadastro, o sistema irá redirecionar para a área de cotação, 
onde já será possivel fazer a mesma.

O sistema salvará toda cotação feita pela o usuário.

O usuário poderá ver o historico de cotação feita por ele, no menu sobre seu nome
chamado: **Histórico**


