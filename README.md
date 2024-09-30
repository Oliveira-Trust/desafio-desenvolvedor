<p>
    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQIAOtqQ5is5vwbcEn0ZahZfMxz1QIeAYtFfnLdkCXu1sqAGbnX" width="300">
 </p>
 
### Detalhamentos do Projeto

O projeto https://github.com/Oliveira-Trust/desafio-desenvolvedor/blob/master/vaga3.md foi executado em cerca de 5 horas de desenvolvimento utilizando Django, Django Rest API e MongoDB, na linguagem Python. 
Os itens foram cobertos, em sua maioria, com excecao do listado abaixo, devido ao dificuldades tecnicas de lidar com a api e desconhecimento tecnico para o realizar de forma satisfatoria. 
    ------Se não enviar nenhum parâmetro o resultado deve ser apresentado páginado.


#### Para executar o projeto:
Apos clonar o repositorio, sera necessario verificar a url do banco. 
O banco esta apontado para um server local aleatoio MongoClient("mongodb://192.168.1.29:27017/"), no arquivo mongo_utils, o que necessitara acerto para a realizacao dos testes. 

Apos essa configuracao: 

cd main_endpoint
python -m venv venv
source venv.bin.activate
python manage.py runserver

O endpoint de upload pode ser testado pelo navegador http://127.0.0.1:8000/ conforme imagem abaixo:


Os outros endpoints podem ser testados pelos comandos abaixo ou via postman (folder postman_collection):
curl --location 'http://127.0.0.1:8000/get_by_name/' \
--header 'Content-Type: application/json' \
--data '{
    "filename":"InstrumentsConsolidatedFile_20240927_3"
}'

curl --location 'http://127.0.0.1:8000/get_file_content/' \
--header 'Content-Type: application/json' \
--data '{
  "RptDt": "2024-09-27",
  "TckrSymb": "003H11"
}'

curl --location 'http://127.0.0.1:8000/get_by_name/' \
--header 'Content-Type: application/json' \
--data '{
    "filename":"InstrumentsConsolidatedFile_20240927_3"
}'


#### Sobre Autenticacao
O sistema esta utilizando a seguranca de autenticacao por secao, basica (user e senha enviada no request), ou token. 



Comentar os comandos:
@authentication_classes((SessionAuthentication, BasicAuthentication, TokenAuthentication))
@permission_classes((IsAuthenticated,))

Ou substituir por:
@permission_classes((AllowAny,))


### A Oliveira Trust:
A Oliveira Trust é uma das maiores empresas do setor Financeiro com muito orgulho, desde 1991, realizamos as maiores transações do mercado de Títulos e Valores Mobiliários.

Somos uma empresa em que valorizamos o nosso colaborador em primeiro lugar, sempre! Alinhando isso com a nossa missão "Promover a satisfação dos nossos clientes e o desenvolvimento pessoal e profissional da nossa equipe", estamos construindo times excepcionais em Tecnologia, Comercial, Engenharia de Software, Produto, Financeiro, Jurídico e Data Science.

Estamos buscando uma pessoa que seja movida a desafios, que saiba trabalhar em equipe e queira revolucionar o mercado financeiro!

Front-end? Back-end? Full Stack? Analista de dados? Queremos conhecer gente boa, que goste de colocar a mão na massa, seja responsável e queira fazer história!

#### O que você precisa saber para entrar no nosso time: 🚀
- Trabalhar com frameworks (Laravel, Lumen, Yii, Cake, Symfony ou outros...)
- Banco de dados relacional (MySql, MariaDB)
- Trabalhar com microsserviços

#### O que seria legal você saber também: 🚀
- Conhecimento em banco de dados não relacional;
- Conhecimento em docker;
- Conhecimento nos serviços da AWS (RDS, DynamoDB, DocumentDB, Elasticsearch);
- Conhecimento em metodologias ágeis (Scrum/Kanban);

#### Ao entrar nessa jornada com o nosso time, você vai: 🚀
- Trabalhar em uma equipe de tecnologia, em um ambiente leve e descontraído e vivenciar a experiência de mudar o mercado financeiro;
- Dress code da forma que você se sentir mais confortável;
- Flexibilidade para home office e horários;
- Acesso a cursos patrocinados pela empresa;

#### Benefícios 🚀
- Salário compatível com o mercado;
- Vale Refeição (CAJU);
- Vale Alimentação (CAJU);
- Vale Transporte ou Vale Combustível (CAJU);
- Plano de Saúde e Odontológico;
- Seguro de vida;
- PLR Semestral;
- Horário Flexível;
- Parcerias em farmácias

#### Local: 🚀
Barra da Tijuca, Rio de Janeiro, RJ

#### Conheça mais sobre nós! :sunglasses:
- Website (https://www.oliveiratrust.com.br/)
- LinkedIn (https://www.linkedin.com/company/oliveiratrust/)

A Oliveira Trust acredita na inclusão e na promoção da diversidade em todas as suas formas. Temos como valores o respeito e valorização das pessoas e combatemos qualquer tipo de discriminação. Incentivamos a todos que se identifiquem com o perfil e requisitos das vagas disponíveis que candidatem, sem qualquer distinção.

## Pronto para o desafio? 🚀🚀🚀🚀
https://github.com/Oliveira-Trust/desafio-desenvolvedor/blob/master/vaga3.md
