<?php

namespace App\Api\V1\Services;

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailService extends PHPMailer {

    private $assunto;
    private $corpo;
    public $destino;
    private $emailReposta;

    function __construct(){
        //Server settings
        $this->SMTPDebug  = 0;                           // Enable verbose debug output
        $this->isSMTP();                                 // Set mailer to use SMTP
        $this->Host       = 'smtp.gmail.com';            // Specify main and backup SMTP servers
        $this->SMTPAuth   = true;                        // Enable SMTP authentication
        $this->Username   = 'aquidornne@gmail.com';      // SMTP username
        $this->Password   = '__EXEMPLO__';               // SMTP password
        $this->Port       = 587;                         // TCP port to connect 
        $this->SMTPSecure = 'tls';
        $this->IsHTML(TRUE);

        $this->setFrom('aquidornne@gmail.com', 'Sistema Processo Seletivo Oliveira Trust');

        $mail = new PHPMailer();
    }

    function enviarEmail(){
        $this->addAddress($this->destino);              // Add a recipient
        $this->addReplyTo((!empty($this->emailReposta) ? $this->emailReposta : $this->Username), "Resposta");

        // Content
        $this->isHTML(true);                           // Set email format to HTML
        $this->Subject = $this->assunto;
        $this->Body    = $this->corpo;

        $this->send();
    }

    public function setAssunto($assunto){
        $this->assunto = $assunto;
    }

    public function getAssunto(){
        return $this->assunto;
    }

    public function setCorpo($corpo){
        $this->corpo = $corpo;
    }

    public function getCorpo(){
        return $this->corpo;
    }

    public function setDestino($destino){
        $this->destino = $destino;
    }

    public function getDestino(){
        return $this->destino;
    }

    public function setEmailReposta($emailReposta){
        $this->emailReposta = $emailReposta;
    }

    public function getEmailReposta(){
        return $this->emailReposta;
    }
}