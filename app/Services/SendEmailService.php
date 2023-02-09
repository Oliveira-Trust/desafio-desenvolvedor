<?php

namespace App\Services;

use GuzzleHttp\Client;

/**
 * Classe SendEmailService
 *
 * Esta classe é responsável por enviar e-mails utilizando API.
 */
class SendEmailService
{


     /**
      * Método sendEmail
      *
      * Este método é responsável por enviar um e-mail para um destinatário específico, a partir dos dados
      * informados na variável $data.
      *
      * @param array $data Dados para envio do e-mail, contendo: nome do destinatário, endereço de e-mail do
      * destinatário, assunto do e-mail, mensagem a ser enviada e título do remetente do e-mail.
      *
      * @return boolean Retorna verdadeiro se o e-mail foi enviado com sucesso, caso contrário retorna falso.
      */
     public function sendEmail(array $data)
     {

          // Recupera os dados para envio do e-mail a partir da variável $data.
          $name = $data['name'];
          $email = $data['email'];;
          $subjectMatter = $data['subjectMatter'];;
          $message = $data['message'];
          $titleSenderEmail = $data['titleSenderEmail'];


          // Define a URL da API.
          $url = "https://api.sendinblue.com/v3/smtp/email";

          // Inicializa a biblioteca cURL.
          $curl = curl_init($url);

          // Configura a requisição cURL para envio de dados via método POST.
          curl_setopt($curl, CURLOPT_URL, $url);
          curl_setopt($curl, CURLOPT_POST, true);
          curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

          // Define as informações do cabeçalho da requisição, incluindo a API Key.
          $headers = array(
               "accept: application/json",
               "api-key:" . $this->getApiKeyMyServe() . "",
               "content-type: application/json",
          );
          curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

          // Define o corpo da requisição, que inclui os dados para envio do e-mail.
          $data = <<<DATA

{
     "sender": {
          "name": "%title_sender_email%",
          "email": "paulofullstack@hotmail.com"
     },
     "to": [
          {
               "email": "%email_customer%",
               "name": "%name_customer%"
          }
     ],     
     "htmlContent": "<!DOCTYPE html> <html> <body><br><h4>Bem vindo(a) %name_customer%</h4><h3> %message%</h3> </body> </html>",
     "textContent": "Criador por Paulo Renato Dev",
     "subject": "%subject_matter%",
     "tags": [
          "tag1"
     ]
}

DATA;

          // Realiza a substituição dos placeholders na string $data
          $data = str_replace("%email_customer%", $email, $data);
          $data = str_replace("%name_customer%", $name, $data);
          $data = str_replace("%message%", $message, $data);
          $data = str_replace("%subject_matter%", $subjectMatter, $data);
          $data = str_replace("%title_sender_email%", $titleSenderEmail, $data);

          // Configura a opção CURL para enviar a string $data
          curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

          // Desativa a verificação SSL
          curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
          curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

          // Realiza a requisição CURL
          $resp = curl_exec($curl);
          curl_close($curl);
          $result = json_decode($resp, true);

          // Verifica se a mensagem foi enviada com sucesso
          if ($result['messageId']) {
               return true;
          }

          // Retorna false em caso de falha
          return false;
     }

     /**
      * Pega 'api_key' no meu servidor pessoal
      */
     public function getApiKeyMyServe()
     {
          $client = new Client();
          $response = $client->get('https://phpgold.com.br/api/api-key-sendinblue');
          $data = json_decode($response->getBody(), true);
          return $data['api_key'];
     }
}
