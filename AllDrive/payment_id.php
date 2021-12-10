<?php
function payment_id($length)
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

    $logID_chk="select * from payment where payment_id ='$text'";
    $resultID = mysqli_query($conn, $logID_chk);
    $numID = mysqli_num_rows($resultID);

    if($numID>1)
    {
        payment_id(6);
    }
    else
    {
        return $text;
    }
}

function customer_id()
{
    include('DBconnection.php');

    $customerID_chk="select * from customer order by customer_id desc limit 1";
    $resultID = mysqli_query($conn, $customerID_chk);
    $row = mysqli_fetch_array($resultID);

    if($row <  1)
    {
        $customer_id=1;
        return $customer_id;
    }
    else
    {
        $customer_id = $row["customer_id"];
        $customer_id = $customer_id +1;
        return $customer_id;
    }
}
?>