<?php
if (!isset($_SESSION['admin_id'])) 
{
    header('location:index.php');
}
else
{
    $id=$_SESSION['admin_id'];
}
include('DBconnection.php');

if (!empty($_POST))
    {
        $f_name=$_POST['f_name'];
        $tel_no=$_POST['tel_no'];
        $address=$_POST['address'];
        $Username=$_POST['Username'];
        $password=$_POST['password'];
        $password=md5($password);

        $uname_chk="select * from drivers where username ='$Username'";
        $resultUN = mysqli_query($conn, $uname_chk);
        $numUN = mysqli_num_rows($resultUN);

        $tel_chk="select * from drivers where tel_no ='$tel_no'";
        $resultTel = mysqli_query($conn, $tel_chk);
        $numTel = mysqli_num_rows($resultTel);
    }

?>

