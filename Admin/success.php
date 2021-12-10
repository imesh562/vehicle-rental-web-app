<?php
    include('DBconnection.php');
    include('payment_id.php');
	ignore_user_abort(true);
	session_start();
	if (!isset($_SESSION['admin_id'])) 
	{
        header('location:index.php');
    }
	$bookingInfo = $_SESSION['arr'];
	$userInfo = $_SESSION['arr3'];

	if (!empty($bookingInfo[0] && $bookingInfo[1] && $bookingInfo[2] && $bookingInfo[3] && $bookingInfo[4] && $bookingInfo[6] && $bookingInfo[7] && $bookingInfo[8] && $userInfo[0] && $userInfo[1] && $userInfo[2] && $userInfo[3] && $userInfo[4])) 
    {
        $bookingInfo[9] = payment_id(6);
        $bookingInfo[10] = customer_id();
        
        $sql3 = "INSERT INTO booking (location_id, pickup_date, pickup_time, booked_period, estimated_km, driver, customer_id, vehicle_id, payment_id)
                    values ('$bookingInfo[2]','$bookingInfo[0]','$bookingInfo[1]','$bookingInfo[3]','$bookingInfo[4]','$bookingInfo[5]','$bookingInfo[10]','$bookingInfo[6]','$bookingInfo[9]')";

        $sql = "INSERT INTO customer (customer_id, email, f_name, l_name, address, tel_no)
                    values ('$bookingInfo[10]','$userInfo[2]','$userInfo[0]','$userInfo[1]','$userInfo[4]','$userInfo[3]')";

        $sql2 = "INSERT INTO payment (payment_id, total_lkr, total_usd)
                    values ('$bookingInfo[9]','$bookingInfo[7]','$bookingInfo[8]')";

                    mysqli_query($conn, $sql);
                    mysqli_query($conn, $sql2);  
                    mysqli_query($conn, $sql3);
                    unset($_SESSION["arr"]);
                    unset($_SESSION["arr3"]);
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
			background-image: url("images/Common/backg.jpg");
			background-repeat: no-repeat;
			background-attachment: fixed;
			background-position: center top;
		}
	</style>
	<link rel="icon" href="images/Common/icon.png">
</head>
<body>
	<script>
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
		        window.location.href = 'Dashboard1.php';
		    }
		})
	</script>
</body>
</html>
