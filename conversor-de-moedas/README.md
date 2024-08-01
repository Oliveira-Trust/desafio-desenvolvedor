# Projeto Conversor de Moeda BRL

Aplicação onde é criado um conversor de moeda BRL para outras moedas a partir do consumo de uma API que consulta os dados da moeda destino de conversão e as devidas taxas. Também podendo enviar a cotação de conversão realizada por e-mail.

## Requisitos para Rodar a Aplicação

- **PHP:** 8.2
- **Laravel:** 11.9
- **Composer**
- **Git**

## Instruções de Instalação

Abra o terminal

1. Clone este repositório usando o comando:

    ```bash
    git clone https://github.com/izadora-toledo/lista-de-usuarios.git
    ```

2. Acesse a pasta do projeto:

    ```bash
    cd lista-de-usuarios
    ```

3. Instale as dependências do projeto:

    ```bash
    composer install
    ```

4. Faça uma cópia do arquivo .env.example e nomeie como .env

5. Gere a chave de criptografia do Laravel:

    ```bash
    php artisan key:generate
    ```

6. Crie o arquivo `database.sqlite` dentro do diretório `database`:

    ```bash
    touch database/database.sqlite
    ```

7. Rode as migrations do banco de dados:

    ```bash
    php artisan migrate
    ```

8. Inicie o servidor da aplicação:

    ```bash
    php artisan serve
    ```

## Configurando envio do e-mail

- Caso queira apenas digitar o e-mail e apertar no botão pra disparar após gerar a conversão, configure seu arquivo .env com os dados abaixo:

```plaintext
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=4d551170896d16
MAIL_PASSWORD=b8c08f9c3ab8ba
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=maistecnologia.oficial@gmail.com
MAIL_FROM_NAME="Izadora Toledo"
```

- Caso queira visualizar o recebimento da tabela da conversão com as informações que foram enviadas no e-mail é necessário criar uma conta no https://mailtrap.io/.

- Após criar a conta, vá no painel e acesse a opção 'E-mail testing'.
- Depois acesse o ícone de engrenagem (se você passar o mouse em cima do ícone vai estar escrito 'settings').
- Visualmente vai abrir na aba 'Integration' e logo abaixo terá uns dados parecido com isso:

```plaintext
Host: sandbox.smtp.mailtrap.io
Port: 25, 465, 587 or 2525
Username: 4d551170896d16
Password: ********b8ba
Auth: PLAIN, LOGIN and CRAM-MD5
TLS: Optional (STARTTLS on all ports)
```

- Você vai pegar esses dados que vai aparecer pra você e preencher o arquivo .env e substituir as informações abaixo pelas suas, lembrando que o campo MAIL_FROM_NAME é o nome que você colocou quando criou a conta no mailtrap.io:

```plaintext
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=4d551170896d16
MAIL_PASSWORD=b8c08f9c3ab8ba
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=maistecnologia.oficial@gmail.com
MAIL_FROM_NAME="Izadora Toledo"
```

- Quando disparar o e-mail na aplicação, volte ao painel da mailtrap.io e acesse 'email testing' novamente e depois 'inboxes'. 
- Vai abrir o quadro escrito 'My project' e você seleciona o 'emailtrap' (por padrão é esse nome que fica) que é referente a opção onde você clicou na engrenagem em um dos passos acima. 
- Vai abrir um histórico dos disparos de e-mail que você fez, ai você clica em cima do disparo e lá vai estar a tabela com as devidas informações.

## Acesso à Aplicação

- Após seguir todos os passos acima, acesse o servidor através da URL que aparecer no terminal. Por padrão, geralmente é:

[http://127.0.0.1:8000](http://127.0.0.1:8000)

- Após acessar, basta clicar no botão 'Realizar conversão' para ir até o formulário de conversão.

- Após isso preencha todos os dados do formulário, lembrando que o campo 'valor' deve ser no mínimo 1.000. 

- Abaixo pode configurar o valor das taxas, caso não altere os campos, será considerado o valor da taxa que foi dado no desafio.

- Clique no botão 'Converter' e a direita os dados de saída da conversão serão preenchidos em uma tabela.

- Caso queira enviar por e-mail essa tabela com as informações da conversão, basta digitar um e-mail válido e clicar em 'Enviar e-mail'.

## Testes

- O arquivo de teste é o 'ConversorMoedasControllerTest.php', esse teste é apenas pra saber se o envio do e-mail está sendo feito com sucesso, para rodar o arquivo de teste:

    ```bash
    php artisan test
    ```

