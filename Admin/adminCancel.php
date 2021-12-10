<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<title>AllDrive - Cancel Booking</title>
	<link rel="icon" href="Images/icons/icon.png">

	<style type="text/css">
		body 
		{
			background-color: #282C2F;
		}
	</style>
</head>
<body>
<?php
session_start();
		if (!isset($_SESSION['admin_id'])) {
             header('location:index.php');
        }else{
        	$id=$_SESSION['admin_id'];
        }
include('DBconnection.php');
$payID = $_GET['paymentID'];

    $sql5 = "select * from booking where payment_id ='$payID'";
	$result5 = mysqli_query($conn, $sql5);
	$row5 = mysqli_fetch_array($result5);

	if ($row5['pickup_status']!='No') 
	{
		echo 
			"<script>
		        Swal.fire
		        ({
	  				icon: 'error',
	  				title: 'Oops...',
	  				text: 'Driver Already Confirmed this booking.',
	  				confirmButtonColor: '#31bfb1',
	                allowOutsideClick: false,
				})
				.then((result) => 
	               	{
	                   	if (result.isConfirmed) 
	                   	{
	                       	window.location.href = 'booking.php#Upcoming';
	                   	}
	            	})
		    </script>";
	}
	else
	{
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
		    $login_id=$row1['login_id'];
		    $customer_id=$row1['customer_id'];


			$delbook="DELETE FROM payment WHERE payment_id ='$payID'";

			$sql = "INSERT INTO refund (login_id,total_lkr,total_usd,paying_email,booked_date,payment_id,vehicle_id,customer_id)
			        values ('$login_id','$total_lkr','$total_usd','$paying_email','$booked_date','$payID','$vehicle_id','$customer_id')";

			if ($conn->query($sql) && $conn->query($delbook))
			{
				echo "<script>
	            Swal.fire
	            ({
	                icon: 'success',
	                title: 'Added to Refunds!',
	                text: 'Click OK to Return.',
	                confirmButtonText: 'OK',
	                confirmButtonColor: '#31bfb1',
	                allowOutsideClick: false,
	            })
	            .then((result) => 
	            {
	            if (result.isConfirmed) 
	            {
	                window.location.href = 'booking.php#Upcoming';
	            }
	            })
	        </script>";
			}
		}
		else
		{
			echo '<script>
		    	if (window.confirm("Invalid Data...")) 
				{
					window.location.href="booking.php#Upcoming";
				};
		    	</script>'; 
		}
	}
?>
</body>
</html>