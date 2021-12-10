<?php
session_start();
$payID = $_GET['paymentID'];
include('DBconnection.php');
include ('LoginCheck.php');

$user_data = check_login($conn);
$id = $user_data['login_id'];

$sql1 = "select * from payment where payment_id ='$payID'";
$result1 = mysqli_query($conn, $sql1);

if(mysqli_num_rows($result1) > 0)
{
	$sql2 = "select * from booking where payment_id ='$payID'";
	$result2 = mysqli_query($conn, $sql2);

	$row = mysqli_fetch_array($result1);
	$row1 = mysqli_fetch_array($result2);

	$total_lkr=$row["total_lkr"];
	$total_usd=$row["total_usd"];
	$paying_email=$row["paying_email"];
	$booked_date=$row1['booked_date'];
	$vehicle_id=$row1['vehicle_id'];

	$delbook="DELETE FROM payment WHERE payment_id ='$payID'";

	$sql = "INSERT INTO refund (login_id,total_lkr,total_usd,paying_email,booked_date,payment_id,vehicle_id)
			values ('$id','$total_lkr','$total_usd','$paying_email','$booked_date','$payID','$vehicle_id')";

	if ($conn->query($sql) && $conn->query($delbook))
	{
	header("Location: profile.php");
	exit();
	}
}
else
{
	echo '<script>
    	if (window.confirm("Invalid Data...")) 
		{
			window.location.href="profile.php";
		};
    	</script>'; 
}
?>