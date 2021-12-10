<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<title>AllDrive - Vehicle Update</title>
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
    $vehID = $_GET['vehID'];

    $date=$_POST['Pickdate'];
    $Returndate=$_POST['Returndate'];

    $start_date = strtotime($date); 
    $end_date = strtotime($Returndate); 
    $days=($end_date - $start_date)/60/60/24;

	$null = "INSERT INTO booking (location_id, pickup_date, booked_period, estimated_km, vehicle_id, service)
            values ('1','$date','$days','0','$vehID','1')";

	if ($conn->query($null))
	{
		echo 
		"<script>
	        Swal.fire
	        ({
	            icon: 'success',
	            title: 'Dates Assigned !',
	            text: 'Click OK to Return.',
	            confirmButtonText: 'OK',
	            confirmButtonColor: '#31bfb1',
	            allowOutsideClick: false,
	        })
	        .then((result) => 
	        {
	        if (result.isConfirmed) 
	        {
	            window.location.href = 'manageVehicles.php';
	        }
	        })
		</script>";
	}
	else
	{
		echo '<script>
    	if (window.confirm("Invalid Data...")) 
		{
			window.location.href="manageVehicles.php";
		};
    	</script>'; 
	}
?>
</body>
</html>