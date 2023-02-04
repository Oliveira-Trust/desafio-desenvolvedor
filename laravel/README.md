<h1 align="center"> Cotação de Moedas </h1>

> **Credenciais de Acesso (opcional):**
>
> **email**: test@email.com
>
> **senha**: secret


## 🛠️ Para rodar o projeto

Acessar a pasta do projeto
```bash
cd laravel
```

Instale as dependências
```bash
composer install 
```

E em seguida
```bash
npm install && npm run dev
```

Ajustar o banco de dados a partir do arquivo .env.example

```bash
cp .env.example .env
```

Criar todas as tabelas e usuário teste
```bash
php artisan migrate --seed 
```

Iniciar o servidor
```bash
php artisan serve
```



### 🛠 Tecnologias

As seguintes ferramentas foram usadas na construção do projeto:

- [PHP v8.0](https://www.php.net/releases/8_0_27.php)
- [Laravel v9](https://laravel.com/docs/9.x/releases)

Caso o disparo de e-mails não funcione, usar o [MailTrap](https://mailtrap.io/)

## Autor

[<img src="https://avatars.githubusercontent.com/u/45495061?v=4" width=115><br><sub>Geanne Santos</sub>](https://github.com/gemaynara) 
