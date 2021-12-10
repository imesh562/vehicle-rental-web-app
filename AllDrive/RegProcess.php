<?php
if (!empty($_POST))
    {

        $first_name=$_POST['first_name'];
        $last_name=$_POST['last_name'];
        $email=$_POST['email'];
        $tel=$_POST['tel'];
        $Address=$_POST['Address'];
        $Username=$_POST['Username'];
        $password=$_POST['password'];
        $password=md5($password);

        $uname_chk="select * from customer_login where username ='$Username'";
        $resultUN = mysqli_query($conn, $uname_chk);
        $numUN = mysqli_num_rows($resultUN);

        $email_chk="select * from customer where email ='$email' AND login_id <> 'NULL' ";
        $resultMail = mysqli_query($conn, $email_chk);
        $numMail = mysqli_num_rows($resultMail);

        $tel_chk="select * from customer where tel_no ='$tel' AND login_id <> 'NULL'";
        $resultTel = mysqli_query($conn, $tel_chk);
        $numTel = mysqli_num_rows($resultTel);
    }

function unique_num($length)
{
    include('DBconnection.php');

    $text = "";
    if($length < 5)
    {
        $length = 5;
    }

    $len = rand(4,$length);

    for ($i=0; $i < $len; $i++) 
    { 
        $text .= rand(0,9);
    }

    $logID_chk="select * from customer_login where login_id ='$text'";
    $resultID = mysqli_query($conn, $logID_chk);
    $numID = mysqli_num_rows($resultID);

    if($numID>1)
    {
        unique_num(10);
    }
    else
    {
        return $text;
    }
}
?>