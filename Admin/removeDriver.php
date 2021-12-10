<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<title>AllDrive - Remove Driver</title>
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
else
{
    $id=$_SESSION['admin_id'];
}
include('DBconnection.php');

$drivID = $_GET['drivID'];

$sql = "select * from drivers where driver_id ='$drivID'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
if ($row['driver_id']==$drivID) 
{
	$sql1 = "DELETE FROM drivers WHERE driver_id = $drivID;";
	if($conn->query($sql1))
	{
		echo "<script>
	            Swal.fire
	            ({
	                icon: 'success',
	                title: 'Driver Removed !',
	                text: 'Click OK to Return.',
	                confirmButtonText: 'OK',
	                confirmButtonColor: '#31bfb1',
	                allowOutsideClick: false,
	            })
	            .then((result) => 
	            {
	            if (result.isConfirmed) 
	            {
	                window.location.href = 'drivers.php';
	            }
	            })
	        </script>";
	}
	else
	{
		echo '<script>
	    if (window.confirm("Invalid Data...")) 
		{
			window.location.href="drivers.php";
		};
	    </script>'; 
	}
}
else
{
	echo '<script>
	if (window.confirm("Invalid Data...")) 
	{
		window.location.href="drivers.php";
	};
	</script>'; 
}
?>
</body>
</html>