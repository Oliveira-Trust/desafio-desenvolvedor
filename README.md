## Desafio Oliveira Trust

### Tecnologias utilizadas
* PHP 8.0
* Laravel 8
* AlpineJS

---
Aplicação que faz a conversão da nossa moeda nacional para uma moeda estrangeira, aplicando
algumas taxas e regras de negócio.

![](https://user-images.githubusercontent.com/16580745/150660406-b8e35b5c-c113-46cf-8b85-a778f75fcc54.png)
![](https://user-images.githubusercontent.com/16580745/150660404-ecdf206d-5a53-4a37-bb9e-449345a9aef7.png)

**Instruções:**

Clone o projeto:

```bash
$ git clone git@github.com:webmasterdro/oliveira-trust-test.git
```

Rode o comando para subir os containers:

```bash
$ docker-compose up -d
```

Acesse o container

```bash
$ docker exec -it test-app-oliveira-trust sh 
```

Rode o comando

```bash
$ composer install
```

Rodando os testes

```bash
$ php artisan test
```

Acessando o projeto 
- [localhost](http://localhost/)
- Acessar [Mailhog](http://localhost:8025/)

---
**Usuario de teste:**

- Email: admin@admin.com
- Password: admin
