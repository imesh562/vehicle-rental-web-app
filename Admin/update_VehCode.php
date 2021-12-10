<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<title>AllDrive - Update Vehicle</title>
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
include('DBconnection.php');
$vehID = $_GET['vehID'];

if(!empty($_POST['vehicle_name']) && !empty($_POST['vehicle_type']) && !empty($_POST['license_no']) && !empty($_POST['day_price']) && !empty($_POST['km_price']) && !empty($_POST['description_1']) && !empty($_POST['description_2']) && !empty($_POST['description_3']) && !empty($_POST['description_4']) && !empty($_POST['description_5']) && !empty($_POST['description_6']))
{
	$vehicle_name = $_POST['vehicle_name'];
	$vehicle_type = $_POST['vehicle_type'];
	$license_no = $_POST['license_no'];
	$day_price = $_POST['day_price'];
	$km_price = $_POST['km_price'];
	$description_1 = $_POST['description_1'];
	$description_2 = $_POST['description_2'];
	$description_3 = $_POST['description_3'];
	$description_4 = $_POST['description_4'];
	$description_5 = $_POST['description_5'];
	$description_6 = $_POST['description_6'];

	$null = "UPDATE vehicle 
	SET 
    vehicle_type = '$vehicle_type',
    vehicle_name = '$vehicle_name',
    license_no = '$license_no',
    day_price = '$day_price',
    km_price = '$km_price',
    description_1 = '$description_1',
    description_2 = '$description_2',
    description_3 = '$description_3',
    description_4 = '$description_4',
    description_5 = '$description_5',
    description_6 = '$description_6' 
    WHERE
    vehicle_id = '$vehID';";

	if($conn->query($null))
	{
		echo "<script>
	            Swal.fire
	            ({
	                icon: 'success',
	                title: 'Vehicle Updated !',
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