A proposta do teste, que é calcular a cotação de dois pares de moedas é atendida pelo microserviço de nome 'exchange'. Foi desenvolvido duas estrategias de cotação tomando como base os metodos de pagamentos.

Objetivo inicial do desenvolvimento era considerar o serviço 'exchange' apenas como um gateway para todas as possiveis funcionalidades da aplicação, mas a ideia se mostrou inviavel pela falta de tempo.

Foi implementado um serviço de mensageria SNS da AWS para gerar comunicação entre os serviço. 
A aplicação que mais se beneficia como o SNS, nesse contexto, é a de notificação que gerencia os sockets dos usuario da aplicação front-end.

A aplicação pode ser acessada em 'produção' pelo link:

http://38.242.143.41:8085/

O cliente solicita uma cotação e aguarda receber o resultado por um socket apos o processamento terminar.

Podemos tambem gerar uma cotação via api com os seguintes comando:

curl '38.242.143.41:8085/api/sync/?method=billet&amount=3000&source=BRL&target=EUR'

O tempo impossibilitou integrar a api de autenticação, implementar um cqrs e os testes.



