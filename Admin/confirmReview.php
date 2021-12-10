<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<title>AllDrive - Confirm Review</title>
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
$reviewID = $_GET['reviewID'];

if(isset($reviewID))
{
	$null = "UPDATE reviews 
	SET 
    approval = '1'
    WHERE
    review_id = '$reviewID';";

	if($conn->query($null))
	{
		echo "<script>
	            Swal.fire
	            ({
	                icon: 'success',
	                title: 'Review Approved !',
	                text: 'Click OK to Return.',
	                confirmButtonText: 'OK',
	                confirmButtonColor: '#31bfb1',
	                allowOutsideClick: false,
	            })
	            .then((result) => 
	            {
	            if (result.isConfirmed) 
	            {
	                window.location.href = 'reviews.php';
	            }
	            })
	        </script>";
	}
	else
	{
		echo '<script>
	        if (window.confirm("Invalid Data...")) 
	        {
	            window.location.href="reviews.php";
	        };
	        </script>'; 
	}
}
else
{
	echo '<script>
        if (window.confirm("Invalid Data...")) 
        {
            window.location.href="reviews.php";
        };
        </script>'; 
}
?>
</body>
</html>