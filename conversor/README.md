# Projeto: CONVERSOR DE MOEDAS

### A aplicação está configurada para rodar via docker e utiliza npm:

## Pré-requisitos:

```markdown
# Docker

# NodeJs
```

## Instruções:

1. Abrir o terminal certificando-se de estar no diretório **`conversor`** que é o diretório da aplicação.

-   Digitar no terminal:

```markdown
# sudo chmod -R 777 /storage
```

3. Subir a aplicação executando os comandos abaixo no terminal:

-   Digitar no terminal:

```markdown
# docker compose up -d

# npm run dev (É necessário ter instalado em sua máquina o node e o npm).
```

4. Acessar o container do PHP no docker e rodar as migrations e seeders:

-   Digitar no terminal:

```markdown
# docker exec -it conversor_php /bin/bash

# php artisan migrate

# php artisan db:seed
```

5. Abrir o navegador e digitar o seguinte endereço para acessar a aplicação:

```markdown
# http://localhost:8000
```

# Para uso do sistema:

> O sistema possui uma área administrativa para a atualização das taxas que serão utilizadas no cálculo da conversão da moeda.

1. Para fazer login utilize os dados abaixo:

```markdown
# E-mail: admin@teste.com

# Senha: teste123
```
