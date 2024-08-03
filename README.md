
# Exchangify

O exchangify foi criado para fazer a compra de moedas, após a feito a compra um recibo é enviado para o email do usuário com todas as informações da transação, como o valor bruto, valor após as taxas, o valor que foi comprado, entre outros, também é possível checar dados de compras anteriores na tela de perfil, configurar parâmetros do sistema como por exemplo a taxa de tipo de pagamento.

As tecnologias utilizadas foram react com material ui para construir o frontend e laravel para construir o backend, a autênticação foi feita com jwt, armazenando os dados de usuário no local storage.

Foi utilizado DDD(Domain Driven Design para) principalmente no backend, os domínios foram separados em:

- Auth
- Config
- Currency
- Exchange
- Marketing
- Payment
- User

Também foi utilizado no backend o pattern *action pattern*.
### Referência
- [Laravel Actions](https://medium.com/@remi_collin/keeping-your-laravel-applications-dry-with-single-action-classes-6a950ec54d1d)
## Instalando o projeto

Para fazer o projeto funcionar, será preciso ter instalado:

- php
- node
- npm(ou yarn)
- composer
- Xampp(Ou qualquer programa que execute PHP e MySql)

Após fazer o clone do projeto, entre na pasta do projeto e em seguida em frontend através do terminal.

```cd desafio-desenvolvedor/frontend```

Em seguida, use o seguinte comando para instalar todos os pacotes necessários do frontend.

```npm install``` ou ```yarn install```

Em uma outra aba do terminal, entre na pasta do projeto e em seguida em backend.

```cd desafio-desenvolvedor/api```

E execute o comando abaixo para instalar todas os pacotes do backend.

```composer install```

Quando todos os pacotes tiverem sido instalados e o seu ambiente de virtualização esteja rodando, execute os comandos para iniciar o host do projeto.

Em ```desafio-desenvolvedor/frontend``` execute ```npm start``` ou ```yarn start```

Em ```desafio-desenvolvedor/api``` execute ```php artisan migrate``` e então ```php artisan serve```

Caso laravel seja hosteado em uma porta diferente de 8000, é importante alterar a constante ROOT no arquivo ```frontend/src/library/HttpClient.js``` para a porta utilizada para o host.

Acessando o endereço disponibilizado pelo frontend, você terá acesso ao App.

## Autenticação

Por padrão o é criado um usuário Admin, ele tem o poder de alterar as variáveis do sistema.

email: admin@gmail.com

senha: 123456

Caso não esteja autenticado, ainda é possível utilizar a aplicação na forma mais básica que é a de buscar o valor de câmbio de algumas moedas. ex:

BRL -> USD ou EUR -> USD.

Quando está autenticado e é feito uma compra, o sistema registra a compra e envia um email de recibo para o email vinculado ao usuário, por isso é importante que utilize um email válido caso queira testar a feature de envio de recibo.

Também é possível reenviar o recibo por email através do modal de informações de compra que pode ser acessado, através do icone de "i" ao lado do valor após a compra.

Ao acessar a tela de perfil clicando no ícone do usuário no canto superior direito é possível ter acesso à dados de compras realizados anteriormente.

Como dito anteriormente, o Admin tem poder de fazer alterações nas configurações do app, alterando as variáveis do sistema, as variáveis são:

- % da taxa de pagamento por boleto
- % da taxa de pagamento por cartão
- Valor mínimo para taxa de compra
- % da taxa de valor mínimo
- Email da empresa

Apesar da última opção ser um possibilidade, não é recomendado por agora pois o email registrado por padrão(diegoleandro2002@gmail.com) é o email registrado no provedor de email e se alterado irá quebrar a feature de recibo por email.