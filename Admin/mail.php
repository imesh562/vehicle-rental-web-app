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

function mailRefund($payment_id,$f_name,$l_name,$email) 
{
//Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'alldrivesrilanka@gmail.com';                     //SMTP username
    $mail->Password   = 'HND@2019';                               //SMTP password
    $mail->SMTPSecure = 'TLS';         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587 ;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('alldrivesrilanka@gmail.com', 'AllDrive Kandy');
    $mail->addAddress($email, $f_name." ".$l_name);     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Your Refund Has Been Authorized.';
    $mail->Body    = '  <center>
                            <div class="jumbotron text-center">
                                <h1 class="display-3">Thank You!</h1>
                                <p class="lead"><strong>Your requested refund for invoice number :'.$payment_id.' has been accepted.</strong></p>
                                <p class="lead"><strong>Please visit our AllDrive HQ in kandy to get your refund.</strong></p>
                                <hr>
                                <p class="lead"><strong>AllDrive Kandy.</strong></p>
                            </div>
                        </center>';
    $mail->AltBody = 'Your Refund Has Been Authorized.';

    $mail->send();
    echo '1';
} catch (Exception $e) {
    echo "0";
}
}

function mailRefundOnline($payment_id,$f_name,$l_name,$email) 
{
//Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'alldrivesrilanka@gmail.com';                     //SMTP username
    $mail->Password   = 'HND@2019';                               //SMTP password
    $mail->SMTPSecure = 'TLS';         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587 ;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('alldrivesrilanka@gmail.com', 'AllDrive Kandy');
    $mail->addAddress($email, $f_name." ".$l_name);     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Your Refund Has Been Authorized.';
    $mail->Body    = '  <center>
                            <div class="jumbotron text-center">
                                <h1 class="display-3">Thank You!</h1>
                                <p class="lead"><strong>Your requested refund for invoice number :'.$payment_id.' has been accepted.</strong></p>
                                <p class="lead"><strong>Please check your PayPal Balance.</strong></p>
                                <hr>
                                <p class="lead"><strong>AllDrive Kandy.</strong></p>
                            </div>
                        </center>';
    $mail->AltBody = 'Your Refund Has Been Authorized.';

    $mail->send();
    echo '1';
} catch (Exception $e) {
    echo "0";
}
}

function mailDriverAssign($payment_id,$f_name,$l_name,$email,$driverName) 
{
//Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);



try {
    //Server settings
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'alldrivesrilanka@gmail.com';                     //SMTP username
    $mail->Password   = 'HND@2019';                               //SMTP password
    $mail->SMTPSecure = 'TLS';         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587 ;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('alldrivesrilanka@gmail.com', 'AllDrive Kandy');
    $mail->addAddress($email, $f_name." ".$l_name);     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Driver Has been Assigned For Your Booking.';
    $mail->Body    = '  <center>
                            <div class="jumbotron text-center">
                                <h1 class="display-3">Thank You!</h1>
                                <p class="lead"><strong>Driver has been assigned for your invoice number :'.$payment_id.'.</strong></p>
                                <p class="lead"><strong>Driver Name : '.$driverName.'.</strong></p>
                                <hr>
                                <p class="lead"><strong>AllDrive Kandy.</strong></p>
                            </div>
                        </center>';
    $mail->AltBody = 'Driver Has been Assigned For Your Booking.';

    $mail->send();
    echo '1';
} catch (Exception $e) {
    echo "0";
}
}

function mailDriverUnassign($payment_id,$f_name,$l_name,$email) 
{
//Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);



try {
    //Server settings
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'alldrivesrilanka@gmail.com';                     //SMTP username
    $mail->Password   = 'HND@2019';                               //SMTP password
    $mail->SMTPSecure = 'TLS';         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587 ;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('alldrivesrilanka@gmail.com', 'AllDrive Kandy');
    $mail->addAddress($email, $f_name." ".$l_name);     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Driver Has been Assigned For Your Booking.';
    $mail->Body    = '  <center>
                            <div class="jumbotron text-center">
                                <h1 class="display-3">Thank You!</h1>
                                <p class="lead"><strong>Previously assigned driver has been unassigned for your invoice number :'.$payment_id.'.</strong></p>
                                <p class="lead"><strong>We will inform your new Driver in future.</strong></p>
                                <hr>
                                <p class="lead"><strong>AllDrive Kandy.</strong></p>
                            </div>
                        </center>';
    $mail->AltBody = 'Driver Has been Assigned For Your Booking.';

    $mail->send();
    echo '1';
} catch (Exception $e) {
    echo "0";
}
}
?>
