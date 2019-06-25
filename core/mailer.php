<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);                              
try {
    
    $mail->SMTPDebug = 1;                          
    $mail->isSMTP();                                      
    $mail->Host = 'mail.donjuerguero.com';  
    $mail->SMTPAuth = true;                               
    $mail->Username = 'soporte@donjuerguero.com';                 
    $mail->Password = 'donjuerguero';                           
    $mail->SMTPSecure = 'tls';                             
    $mail->Port = 587;                                    
	$mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );
    $mail->setFrom('soporte@donjuerguero.com', 'Local Sucre');
    $mail->addAddress('donjuerguero@gmail.com', 'Jose Pando');   
    $mail->addReplyTo('soporte@donjuerguero.com', 'Mailer');
    $mail->isHTML(true);                                 
    $mail->Subject = 'Ventas de Sucre';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
?>