<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<title>AllDrive - Submit Review</title>
	<link rel="icon" href="images/icons/icon.png">

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
include('DBconnection.php');
include ('LoginCheck.php');

$book_id = $_GET['book_id'];
$vehicle_id = $_GET['vehicle_id'];
$user_data = check_login($conn);
$id = $user_data['login_id'];

if(!empty($_POST['comment']))
{
	$comment = $_POST['comment'];

	$null = "INSERT INTO reviews (content,booking_id,vehicle_id,login_id) values ('$comment','$book_id','$vehicle_id','$id');";

	if($conn->query($null))
	{
		$sql2 = "select * from reviews where booking_id = '$book_id';";
		$result2 = mysqli_query($conn, $sql2);

		if(mysqli_num_rows($result2) > 0)
		{
			$reviewData = mysqli_fetch_array($result2);
			$review_id = $reviewData["review_id"];
			$sql3 ="update booking SET review_id = '$review_id' WHERE book_id = '$book_id';";
            if ($conn->query($sql3))
            {
            	echo "<script>
	            Swal.fire
	            ({
	                icon: 'success',
	                title: 'Review Sumbited !',
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
            else
			{
				echo '<script>
			        if (window.confirm("Invalid Data...")) 
			        {
			            window.location.href="profile.php";
			        };
			        </script>'; 
			}
		}
		else
		{
			echo '<script>
		        if (window.confirm("Invalid Data...")) 
		        {
		            window.location.href="profile.php";
		        };
		        </script>'; 
		}
	}
	else
	{
		echo '<script>
	        if (window.confirm("Invalid Data...")) 
	        {
	            window.location.href="profile.php";
	        };
	        </script>'; 
	}
}
else
{
	echo '<script>
        if (window.confirm("Invalid Data...")) 
        {
            window.location.href="profile.php";
        };
        </script>'; 
}
?>
</body>
</html>