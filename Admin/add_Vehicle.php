<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<title>AllDrive - Add Vehicle</title>
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

if(file_exists($_FILES['image_1']['tmp_name']) && file_exists($_FILES['image_2']['tmp_name']) && file_exists($_FILES['image_3']['tmp_name']) && !empty($_POST['vehicle_name']) && !empty($_POST['vehicle_type']) && !empty($_POST['license_no']) && !empty($_POST['day_price']) && !empty($_POST['km_price']) && !empty($_POST['description_1']) && !empty($_POST['description_2']) && !empty($_POST['description_3']) && !empty($_POST['description_4']) && !empty($_POST['description_5']) && !empty($_POST['description_6']))
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

	$imgname1=$_FILES['image_1']['name'];
	$imgname2=$_FILES['image_2']['name'];
	$imgname3=$_FILES['image_3']['name'];

	$filename[0]=$_FILES['image_1']['tmp_name'];
	$filename[1]=$_FILES['image_2']['tmp_name'];
	$filename[2]=$_FILES['image_3']['tmp_name'];

	$extension[0] = (pathinfo($imgname1,PATHINFO_EXTENSION));
	$extension[1] = (pathinfo($imgname2,PATHINFO_EXTENSION));
	$extension[2] = (pathinfo($imgname3,PATHINFO_EXTENSION));

	for ($i=0; $i < 3; $i++) 
	{ 
		$randomno=rand(0,100000);
		$rename = 'Upload'.date('Ymd').$randomno.'_'.$i;
		$newname[$i]=$rename.'.'.$extension[$i];

		move_uploaded_file($filename[$i], '../AllDrive/Images/Vehicles/'.$newname[$i]);
	}

	$null = "INSERT INTO vehicle (vehicle_type, vehicle_name, license_no, availability, day_price, km_price, description_1, description_2, description_3, description_4, description_5, description_6,  img1, img2, img3) values ('$vehicle_type','$vehicle_name', '$license_no','1', '$day_price', '$km_price', '$description_1', '$description_2', '$description_3', '$description_4', '$description_5', '$description_6', '$newname[0]', '$newname[1]', '$newname[2]');";

	if($conn->query($null))
	{
		echo "<script>
	            Swal.fire
	            ({
	                icon: 'success',
	                title: 'Vehicle Added !',
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