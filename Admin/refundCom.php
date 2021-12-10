<?php
include('DBconnection.php');
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('location:index.php');
}else{
    $id=$_SESSION['admin_id'];
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<title>AllDrive - Refund Complete</title>
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
if(!empty($_GET['rID']))
    {
        $refund_id = $_GET['rID'];
		$null = "update refund SET customer_recieve = '1' WHERE refund_id = $refund_id";

		if ($conn->query($null))
		{
			echo "<script>
	            Swal.fire
	            ({
	                icon: 'success',
	                title: 'Cash Given!',
	                text: 'Click OK to Return.',
	                confirmButtonText: 'OK',
	                confirmButtonColor: '#31bfb1',
	                allowOutsideClick: false,
	            })
	            .then((result) => 
	            {
	            if (result.isConfirmed) 
	            {
	                window.location.href = 'refund.php#completed';
	            }
	            })
	        </script>";
		}
		else
		{
			echo '<script>
	    	if (window.confirm("Invalid Data...")) 
			{
				window.location.href="refund.php";
			};
	    	</script>'; 
		}
    }
    else
	{
		echo '<script>
	    	if (window.confirm("Invalid Data...")) 
			{
				window.location.href="refund.php";
			};
	    	</script>'; 
	}
	?>
</body>
</html>