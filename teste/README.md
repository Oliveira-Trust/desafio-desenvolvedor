# Desafio Desenvolvedor Back-end Jr
Projeto desenvolvido conforme instruções solicitadas na documentação pela empresa Oliveira Trust como teste para a vaga de Desenvolvedor Back-end Jr.
Este projeto consiste em uma API desenvolvida utilizando Laravel 12 com PHP 8.3, adotando MongoDB como banco de dados. A autenticação é baseada em JWT.

## Tecnologias
- PHP 8.3
- Laravel 12
- MongoDB
- JWT Authentication (tymon/jwt-auth)
- Insomnia (para testes de requisições HTTP)
- Redis (predis/predis)
- Laravel Excel (maatwebsite/excel)

## Configuração do Ambiente

1. **Clone o repositório** <br>
     ```git clone https://github.com/andressa-mb/desafio-desenvolvedor.git```
2. **Instale suas dependências** <br>
    ```composer install```
3. **Configurar variáveis de ambiente** <br>
```Copie o .env.example e configure seu env com os dados relacionadas ao MongoDB``` <br>
```php artisan key:generate```
4. **Executar o projeto** <br>
```php artisan serve```
----

**Autenticação** <br>
A API utiliza autenticação via JWT.
Para acessar endpoints protegidos, é necessário obter um token através do login e enviá-lo no header das requisições:
>Authorization: Bearer {token}

----

## Rotas da API
### Autenticação e Controle de Acesso

#### Rotas Públicas (não requerem token)
| Método | Endpoint | Descrição |
|--------|----------------|--------------------------|
| POST   | /auth/create   | Cadastro de usuário      |
| POST   | /auth/login    | Login e geração de token |

#### Rotas Protegidas (requerem token JWT)
| Método | Endpoint | Descrição |
|--------|----------------|--------------------------|
| POST	 | /auth/logout   | Logout do usuário        |
| GET	 | /auth/user/{id}|	Detalhes de um usuário   |
| GET	 | /auth/users	  | Listagem de usuários     |

#### Arquivos (/docs) (Requer autenticação)
| Método | Endpoint | Descrição |
|--------|------------------------|------------------------------|
| POST   | /docs/save             |	Upload/salvamento de arquivo |
| GET	 | /docs/history-files    | Histórico de arquivos        |
| GET    | /docs/search-file-data | Busca de dados nos arquivos  |

----

## Testes com Insomnia

Para testar a API utilizando o Insomnia, siga os passos:

1. Criar usuário

**POST**  ```/auth/create```
```
{
  "name": "Ana Garcia",
  "email": "usuario@email.com",
  "password": "12345678",
  "password_confirmation": "12345678",
}
```

2. Realizar login

**POST**  ```/auth/login```
```
{
  "email": "usuario@email.com",
  "password": "12345678"
}
```

3. Configurar autenticação
No insomnia, adicionar o header:
>Authorization: Bearer {token}
**POST**  ```/auth/login```

4. Acessar endpoints protegidos
Após autenticação, é possível consumir as rotas do prefixo /docs. <br>
Exemplo:
**GET**  ```/docs/history-files```

## Observações importantes
- O token deve ser enviado em todas as requisições protegidas.
- Certifique-se de que o MongoDB esteja em execução antes de iniciar o projeto.
