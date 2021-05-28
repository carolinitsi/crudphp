<?php
//identificação para a chamada da classe

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

if (isset($_POST['enviar'])) 
{
	
$nome = $_POST['nome'];

$email = $_POST['email'];

$mensagem = $_POST['mensagem'];

$email_resposta = $_POST['email_resposta'];


require "PHPMailer/src/PHPMailer.php";
require "PHPMailer/src/SMTP.php";


// instanciando a classe
$mail = new PHPMailer();

// habilitando SMTP	
$mail->isSMTP();

// habilitando tranferêcia segura 
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

// Pode ser: 0 = não exibe erros, 1 = exibe erros e mensagens, 2 = apenas mensagens	

$mail->SMTPDebug = 0; // Debug

// habilitando autenticação	
$mail->SMTPAuth = true;

// Configurações para utilização do SMTP do Gmail 

$mail->Host = 'smtp.gmail.com';
$mail->Port = 587; // porta gmail
$mail->SMTPOptions = [
     'ssl' => [
         'verify_peer' => false,
         'verify_peer_name' => false,
         'allow_self_signed' => true,
    ]
];

$mail->Username = 'contato.modarocker@gmail.com'; ////Usuário para autenticação 
$mail->Password = 'lizy1998'; //senha autenticação

// Remetente da mensagem - sempre usar o mesmo usuário da autenticação  
$mail->setFrom('contato.modarocker@gmail.com','Adm Site');

// Endereço de destino do email
$mail->addAddress($email, $nome );

$mail->CharSet = "utf-8";

// Endereço para resposta
	
$mail->addReplyTo($email_resposta);

// Assunto e Corpo do email
$mail->Subject = 'Teste de SMTP';

$mail->Body = $mensagem;

// Enviando o email
if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo $mensagem." E-mail SMTP enviado com sucesso para " . $email . " Enviado por: ".$email_resposta ;
}


}


?>

 <head>

 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

 <title>Envio de email pela classe PHPMailer</title>


 </head>

 <body>

<form action="formulario_email.php" method="post" name="frm_contato">

Informe o nome do destinatário: 

<input type="text" name="nome"> <br />

 

Informe o E-mail do destinatário: 

<input type="text" name="email"> <br />


Informe o E-mail para resposta: 

<input type="text" name="email_resposta"> <br />


Escreva uma Mensagem: 

<textarea name="mensagem" rows="5" cols="50"></textarea> <br />



<input type="submit" name="enviar" value="ENVIAR" />

</form>


