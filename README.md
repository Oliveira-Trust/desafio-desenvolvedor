### PROJETO DE TESTE PARA COVERSÃO DE MOEDAS FEITO EM PHP/Laravel:
Conversão da nossa moeda nacional para uma moeda estrangeira, aplicando algumas taxas e regras, no final da conversão o resultado deverá ficar em tela de forma detalhada.

### Regras:
- Moeda de origem BRL;
- Informar uma moeda de compra que não seja BRL (exibir no mínimo 2 opções);
- Valor da Compra em BRL (deve ser maior que R$ 1.000,00 e menor que R$ 100.000,00);
- Formas de pagamento (taxas aplicadas no valor da compra e aceitar apenas as opções abaixo):
- - Para pagamentos em boleto, taxa de 1,45%
- -  Para pagamentos em cartão de crédito, taxa de 7,63%
- Aplicar taxa de 2% pela conversão para valores abaixo de R$ 3.000,00 e 1% para valores maiores que R$ 3.000,00, essa taxa deve ser aplicada apenas no valor da compra e não sobre o valor já com a taxa de forma de pagamento.

#### PASSOS PARA CONFIGURAÇÃO: 🚀
* Versão do php utilizada: 7.3
* Necessário ter o node e o composer instalados
- Rodar o comando: php artisan key:generate;
- Rodar o npm install && npm run dev para rodar algumas dependencias de auteticação;
- Rodar o composer update;
- Criar um banco de dados vazio e inserir os dados de acesso no .env;
- Rodas as migrations e seeds : php artisan migrate:fresh --seed (são importantes);
- Incluir no .env a seguintes variáveis: (URL_API_SERVICE = "https://economia.awesomeapi.com.br")

#### MAIS INFORMAÇÕES: 🚀
* Para acessar a área administrativa o login padrão é: admin@conversor.com e senha: admin123456
* Os usuários podem fazer um cadastro normalmente e realizar o login

#### Principais implementações: 🚀
- Cotação das moedas
- Autenticação de usuários
- Histórico de cotações feita pelo usuário
- Painel administrativo para configuração de parâmetros;
- Atualização em tempo real da cotação;
- Controle ACL

## Meu Contato 🚀🚀🚀
https://www.linkedin.com/in/adson-souza-21b1493a/
