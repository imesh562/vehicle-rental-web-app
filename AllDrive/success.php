<?php
    include('DBconnection.php');
    include ('LoginCheck.php');
    include('payment_id.php');
    include('invoice.php');
    include('mail.php');
	ignore_user_abort(true);
	session_start();
	$user_data = check_login($conn);
	$bookingInfo = $_SESSION['arr'];
	$paymentInfo = $_SESSION['arr2'];
	if ($user_data == 0) 
    {
		$userInfo = $_SESSION['arr3'];
	}
	$payEmail = $_GET['mail'];

	if ($user_data == 0 && !empty($bookingInfo[0] && $bookingInfo[1] && $bookingInfo[2] && $bookingInfo[3] && $bookingInfo[4] && $bookingInfo[6] && $bookingInfo[7] && $bookingInfo[8] && $userInfo[0] && $userInfo[1] && $userInfo[2] && $userInfo[3] && $userInfo[4])) 
    {
        $bookingInfo[9]=$payEmail;
        $bookingInfo[10] = payment_id(6);
        $bookingInfo[11] = customer_id();
        
        $sql3 = "INSERT INTO booking (location_id, pickup_date, pickup_time, booked_period, estimated_km, driver, customer_id, vehicle_id, payment_id)
                    values ('$bookingInfo[2]','$bookingInfo[0]','$bookingInfo[1]','$bookingInfo[3]','$bookingInfo[4]','$bookingInfo[5]','$bookingInfo[11]','$bookingInfo[6]','$bookingInfo[10]')";

        $sql = "INSERT INTO customer (customer_id, email, f_name, l_name, address, tel_no)
                    values ('$bookingInfo[11]','$userInfo[2]','$userInfo[0]','$userInfo[1]','$userInfo[4]','$userInfo[3]')";

        $sql2 = "INSERT INTO payment (payment_id, total_lkr, total_usd, paying_email)
                    values ('$bookingInfo[10]','$bookingInfo[7]','$bookingInfo[8]', '$bookingInfo[9]')";

                    mysqli_query($conn, $sql);
                    mysqli_query($conn, $sql2);  
                    mysqli_query($conn, $sql3);

                    billOut($bookingInfo,$userInfo,$paymentInfo);
                    mailReceipt($bookingInfo[10],$userInfo[0],$userInfo[1],$userInfo[2]);

                    unset($_SESSION["arr"]);
                    unset($_SESSION["arr3"]);
                    unset($_SESSION["arr2"]);
    }
    else if (!empty($bookingInfo[0] && $bookingInfo[1] && $bookingInfo[2] && $bookingInfo[3] && $bookingInfo[4] && $bookingInfo[6] && $bookingInfo[7] && $bookingInfo[8]))
    {
    	$id = $user_data['login_id'];
		$bookingInfo[9]=$id;
        $bookingInfo[10]= payment_id(6);
        $bookingInfo[11] = $payEmail;
        $sql = "INSERT INTO booking (location_id, pickup_date, pickup_time, booked_period, estimated_km, driver, login_id, vehicle_id, payment_id)
                    values ('$bookingInfo[2]','$bookingInfo[0]','$bookingInfo[1]','$bookingInfo[3]','$bookingInfo[4]','$bookingInfo[5]','$bookingInfo[9]','$bookingInfo[6]','$bookingInfo[10]')";

        $sql2 = "INSERT INTO payment (payment_id, total_lkr, total_usd, paying_email)
                    values ('$bookingInfo[10]','$bookingInfo[7]','$bookingInfo[8]', '$bookingInfo[11]')";

        $sql3 = "select * from customer where login_id ='$id' limit 1;";

                    mysqli_query($conn, $sql2);
                    mysqli_query($conn, $sql);
                    mysqli_query($conn, $sql3);
                    $result3 = mysqli_query($conn, $sql3);
					$row3 = mysqli_fetch_array($result3);

        			$userInfo=array($row3['f_name'],$row3['l_name'],$row3['email'],$row3['tel_no'],$row3['address']);

                    billOut($bookingInfo,$userInfo,$paymentInfo);
                    mailReceipt($bookingInfo[10],$userInfo[0],$userInfo[1],$userInfo[2]);

                    unset($_SESSION["arr"]);
                    unset($_SESSION["arr3"]);
                    unset($_SESSION["arr2"]);
    }
    else
    {
    	echo '<script>
    	if (window.confirm("Invalid Data...")) 
		{
			window.location.href="index.php";
		};
    	</script>'; 
    }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

	<title>Payment</title>
	<link rel="icon" href="Images/Common/icon.png">

	<style type="text/css">
		body 
		{
			background-image: url("Images/Common/backg.jpg");
			background-repeat: no-repeat;
			background-attachment: fixed;
			background-position: center top;
		}
	</style>
	<link rel="icon" href="Images/Common/icon.png">
</head>
<body>
	<?php
	if ($user_data == 0) 
	{
		echo "<script>
			Swal.fire
		   	({
		       	icon: 'success',
		       	title: 'Payment Successfull!',
		       	text: 'Click OK to Return.',
		       	confirmButtonText: 'OK',
		       	confirmButtonColor: '#31bfb1',
		       	allowOutsideClick: false,
		   	})
		   	.then((result) => 
		   	{
		       	if (result.isConfirmed) 
		       	{
		           window.location.href = 'index.php';
		       	}
		   	})
		</script>";
	}
	else
	{
		echo "<script>
			Swal.fire
		   	({
		       	icon: 'success',
		       	title: 'Payment Successfull!',
		       	text: 'Click OK to Return.',
		       	confirmButtonText: 'OK',
		       	confirmButtonColor: '#31bfb1',
		       	allowOutsideClick: false,
		   	})
		   	.then((result) => 
		   	{
		       	if (result.isConfirmed) 
		       	{
		           window.location.href = 'profile.php';
		       	}
		   	})
		</script>";
	}
	?>
	
</body>
</html>
