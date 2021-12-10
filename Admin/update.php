<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<title>AllDrive - Driver Update</title>
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
	if (!isset($_SESSION['admin_id'])) 
	{
        header('location:index.php');
    }
    include('DBconnection.php');
    include('mail.php');
    $Bid = $_GET['bid'];

    $sql5 = "select * from booking where book_id ='$Bid'";
	$result5 = mysqli_query($conn, $sql5);
	$row5 = mysqli_fetch_array($result5);
	if ($row5['pickup_status']=='Yes') 
	{
		echo 
			"<script>
		        Swal.fire
		        ({
	  				icon: 'error',
	  				title: 'Oops...',
	  				text: 'Driver Already Accepted The Request.',
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
    	$null = "update booking SET driver_id = NULL WHERE book_id = $Bid";
		if ($conn->query($null))
		{
			$driver = "select * from booking INNER JOIN customer ON customer.customer_id = booking.customer_id OR customer.login_id = booking.login_id where book_id = '$Bid';";
            $dResult = mysqli_query($conn, $driver);
            $dData = mysqli_fetch_array($dResult);

			mailDriverUnassign($dData['payment_id'],$dData['f_name'],$dData['l_name'],$dData['email']);

			echo "<script>
	            Swal.fire
	            ({
	                icon: 'success',
	                title: 'Driver Unassigned !',
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
?>
</body>
</html>