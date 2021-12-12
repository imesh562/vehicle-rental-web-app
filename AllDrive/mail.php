<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';
function mailReceipt($payment_id,$f_name,$l_name,$email) 
{
//Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = ''; //Add SMTP username
    $mail->Password   = ''; //Add SMTP password
    $mail->SMTPSecure = 'TLS';         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587 ;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('alldrivesrilanka@gmail.com', 'AllDrive Kandy');
    $mail->addAddress($email, $f_name." ".$l_name);     //Add a recipient

    //Attachments
    $mail->addAttachment('../Admin/bills/'.$payment_id.'.pdf');        //Add attachments

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Thanks '.$f_name.' For Choosing Us.';
    $mail->Body    = '  <center>
                            <div class="jumbotron text-center">
                                <h1 class="display-3">Thank You!</h1>
                                <p class="lead"><strong>This is the Receipt for your Booking.</strong></p>
                                <hr>
                                <p class="lead"><strong>AllDrive Kandy.</strong></p>
                            </div>
                        </center>';
    $mail->AltBody = 'This is the Receipt for your Booking.';

    $mail->send();
    echo '1';
} catch (Exception $e) {
    echo "0";
}
}
?>
