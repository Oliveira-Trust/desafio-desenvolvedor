# Desafio Oliveira Trust
Aplicação Web desenvolvida para aplicação ao processo seletivo para o cargo de Desenvolvedor Backend Sênior.

O desenvolvimento foi realizado de acordo com as instruções passadas na [descrição do desafio](https://github.com/Oliveira-Trust/desafio-desenvolvedor/blob/master/vaga.md)

## Versões utilizadas para rodar a aplicação
PHP     | Laravel   |Composer   |Sail   |Mysql  |Redis  |Docker   | Bootstrap
|-      | -         |-          |-      |-      |-      |-        |-
8.2.4   | 10.10     |2.5.7      |1.18   |8.0.1  |7.0.11 |20.10.21 | 5.3.0

## Sobre da aplicação
+ O ambiente de desenvolvimento foi criado com a utilização do [Laravel Sail](https://laravel.com/docs/10.x/sail)
+ É necessário configurar o SMPT no .env para que o envio do e-mail seja realizado.
+ Fiz uso de um Observer para detectar a criação de uma nova cotação no banco de dados, disparando o e-mail sempre que uma cotação for realizada.
+ A classe do e-mail está implementando o ShouldQueue, tornando desnecessário o uso de um Job para enfileirar os envios.
+ A rota de configuração de Taxas é acessível apenas por usuários administradores, portanto deve-se logar como um administrador para visualizar o link de acesso "Configurações" no menu de navegação.
+ Utilizei o pacote o [Laravel Modules](https://docs.laravelmodules.com/) para organização do projeto em Módulos.
+ Certifique-se de criar um usuário com um e-mail existente, para receber as mensagens de cotação.
+ Meu foco principal é no backend, o frontend foi desenvolvido para mostrar que também consigo trabalhar nessa parte caso seja necessário.
+ Para a componentização do frontend utilizei o [Laravel Blade](https://laravel.com/docs/10.x/blade)

## Credencial de acesso administrador
E-mail                 | Senha 
|-                     | -        
admin@desafio.com.br   | 12345678
