# Desafio Técnico

## Tecnologias Utilizadas

### Backend

- Laravel
- Jetstream (para autenticação)
- JWT-Auth (para autenticação JWT)
- Redis (para cache)
- MySQL (como banco de dados relacional)

### Frontend

- Vue.js (integrado via Vite)
- Vuetify.js (componentes UI)
- Tailwind CSS (utilizado em conjunto com Vuetify.js)
- SCSS (para estilos customizados)
- Blade (em algumas paginas principalmente do jetstream)
- CSS

## Instalação

Siga os passos abaixo para configurar e executar o projeto localmente:


### Pré-requisitos
- Ambiente Docker Compose

### Clone o repositório
```bash
git clone https://github.com/cassiuslc/desafio-desenvolvedor-Cassius-Leon.git
cd desafio-desenvolvedor-Cassius-Leon
```

### Troque para a branch develop
```bash
git checkout develop
```

### Construa os containers Docker
```bash
docker-compose up -d --build
```

### Acesse o console do Docker PHP e instale as dependências
```bash
docker-compose exec php bash
composer setup
```
### Algumas vezes o windows pode apresentar problemas de permissoes neste caso dentro do php bash
```bash
chown -R www-data:www-data /var/www
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
chmod -R 775 /var/www/storage /var/www/bootstrap/cache
```
## O Desafio:
O usuário precisa informar 3 informações em tela, moeda de destino, valor para conversão e forma de pagamento. A nossa moeda nacional BRL será usada como moeda base na conversão.

### As Regras de négocio:
- Moeda de origem BRL;
- Informar uma moeda de compra que não seja BRL (exibir no mínimo 2 opções);
- Valor da Compra em BRL (deve ser maior que R$ 1.000,00 e menor que R$ 100.000,00)
- Formas de pagamento (taxas aplicadas no valor da compra e aceitar apenas as opções abaixo)
  - Para pagamentos em boleto, taxa de 1,45%
  - Para pagamentos em cartão de crédito, taxa de 7,63%
- Aplicar taxa de 2% pela conversão para valores abaixo de R$ 3.000,00 e 1% para valores maiores que R$ 3.000,00, 
essa taxa deve ser aplicada apenas no valor da compra e não sobre o valor já com a taxa de forma de pagamento.

### Exemplos de entrada:
- Moeda de origem: BRL (default)
- Moeda de destino:
  - Exemplo: USD, BTC, ...
- Valor para conversão:
  - Exemplo: 5.000,00, 1.000,00, 70.000,00, ...
- Forma de pagamento:
  - Boleto ou Cartão de Crédito

## Links Importantes

- [Mailpit](http://localhost:8025/)
- [Login](http://localhost:8080/login)
- [Registro](http://localhost:8080/register)
- [Horizon](http://localhost:8080/horizon/dashboard)
- [Swagger](http://localhost:8080/api/documentation#/)
- [Repositório no GitHub](https://github.com/cassiuslc/desafio-desenvolvedor-Cassius-Leon)
