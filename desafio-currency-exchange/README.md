Exchange API
===

Pré-requisitos
---

1.  Instale o composer globalmente seguindo as instruções em **https://getcomposer.org/download**

Passos para iniciar o ambiente
---

Faça os passos abaixo após o clone para ter o projeto funcionando:

1.  Instale as dependências do composer

        composer install

1.  Copie o arquivo `.env.example` para `.env`

        cp .env.example .env

1.  Crie uma nova chave para a aplicação

        php artisan key:generate

1.  Execute o comando para subir o servidor 

        php artisan serve

1.  Acesse:

        localhost:8000


Testes
---

1. Para executar teste unitários

        ./vendor/bin/phpunit
