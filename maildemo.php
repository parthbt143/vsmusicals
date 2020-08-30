<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';


$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
   
    $mail->SMTPDebug = 0;

	$mail->isSMTP();
	$mail->Host = 'smtp.gmail.com';
	$mail->SMTPAuth = true;
	$mail->Username = 'iosvsm@gmail.com';                 // SMTP username
         $mail->Password = 'vsM@18799'; 
	$mail->SMTPSecure = 'tls';
	$mail->Port = 587;

	$mail->SMTPOptions = array(
	    'ssl' => array(
	        'verify_peer' => false,
	        'verify_peer_name' => false,
	        'allow_self_signed' => true
	    )
	);
    
    

    //Recipients
    $mail->setFrom('iosvsm@gmail.com', 'VS Musicals');
    $mail->addAddress('parthbt143@gmail.com', 'Parth');     // Add a recipient
    
 
    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}