<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<title>AllDrive - Driver</title>
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
	if (!isset($_SESSION['driver_id'])) {
        header('location:Dlogin.php');
    }else{
    	$id=$_SESSION['driver_id'];
    }
include('DBconnection.php');
$bookID = $_GET['bookID'];

    $sql5 = "select * from booking where book_id ='$bookID'";
	$result5 = mysqli_query($conn, $sql5);
	$row5 = mysqli_fetch_array($result5);
	if ($row5['driver_id']!=$id) 
	{
		echo 
			"<script>
		        Swal.fire
		        ({
	  				icon: 'error',
	  				title: 'Oops...',
	  				text: 'You are not assigned for this booking.',
	  				confirmButtonColor: '#31bfb1',
	                allowOutsideClick: false,
				})
				.then((result) => 
	               	{
	                   	if (result.isConfirmed) 
	                   	{
	                       	window.location.href = 'Dashboard2.php#Assigned';
	                   	}
	            	})
		    </script>";
	}
	else
	{
		$sql1 = "UPDATE booking SET pickup_status = 'Yes' WHERE book_id=$bookID";
		if ($conn->query($sql1))
			{
			echo "<script>
	            Swal.fire
	            ({
	                icon: 'success',
	                title: 'Booking Confirmed !',
	                text: 'Click OK to Return.',
	                confirmButtonText: 'OK',
	                confirmButtonColor: '#31bfb1',
	                allowOutsideClick: false,
	            })
	            .then((result) => 
	            {
	            if (result.isConfirmed) 
	            {
	                window.location.href = 'Dashboard2.php#Assigned';
	            }
	            })
	        </script>";
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