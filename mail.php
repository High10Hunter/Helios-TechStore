<?php

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/Exception.php';
// require 'PHPMailer/src/OAuth.php';
// require 'PHPMailer/src/OAuthTokenProvider.php';
require 'PHPMailer/src/POP3.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function send_mail($email, $name, $title, $content)
{
    $mail = new PHPMailer(false);

    try {
        //Server settings
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;
        $mail->SMTPSecure = "tls";                              //Enable SMTP authentication
        $mail->Username   = 'daiquy2903@gmail.com';                     //SMTP username
        $mail->Password   = 'outfit-sample-crushed6';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;

        $mail->CharSet = "UTF-8";                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('daiquy2903@gmail.com', 'Helios TechShop');
        $mail->addAddress($email, $name);     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $title;
        $mail->Body    = $content;

        $mail->send();
    } catch (Exception $e) {
        echo "Không thể gửi được mail: {$mail->ErrorInfo}";
    }
}
