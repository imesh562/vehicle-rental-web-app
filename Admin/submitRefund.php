<?php
include('DBconnection.php');
include('mail.php');
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('location:index.php');
}else{
    $id=$_SESSION['admin_id'];
}
$refund_id = $_GET['refund_id'];
$refundLKR = $_GET['refundLKR'];
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<title>AllDrive - Refund Approved</title>
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
if(!empty($_POST['fullR']))
    {
        $fullRefund = $_POST['fullR'];
    }
    else
    {
    	$fullRefund = 0;
    }
$sql = "select * from refund INNER JOIN customer ON customer.customer_id = refund.customer_id OR customer.login_id = refund.login_id  where refund.refund_id = $refund_id;";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

if($fullRefund == 1 && $row['paying_email'] != 'Cash')//with full Refund for online customers
{
	$total_lkr = $row['total_lkr'];
	$null = "update refund SET admin_approval = 'Yes' WHERE refund_id = $refund_id";
	$null1 = "update refund SET refund_amount = '$total_lkr' WHERE refund_id = $refund_id";
	$null2 = "update refund SET customer_recieve = '1' WHERE refund_id = $refund_id";

		if ($conn->query($null) && $conn->query($null1) && $conn->query($null2))
		{
			mailRefundOnline($row['payment_id'],$row['f_name'],$row['l_name'],$row['email']);
			echo "<script>
	            Swal.fire
	            ({
	                icon: 'success',
	                title: 'Approved!',
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
else if ($fullRefund == 0 && $row['paying_email'] != 'Cash') //without full Refund for online customers
{
	$total_lkr = $refundLKR;
	$null = "update refund SET admin_approval = 'Yes' WHERE refund_id = $refund_id";
	$null1 = "update refund SET refund_amount = '$total_lkr' WHERE refund_id = $refund_id";
	$null2 = "update refund SET customer_recieve = '1' WHERE refund_id = $refund_id";

		if ($conn->query($null) && $conn->query($null1) && $conn->query($null2))
		{
			mailRefundOnline($row['payment_id'],$row['f_name'],$row['l_name'],$row['email']);
			echo "<script>
	            Swal.fire
	            ({
	                icon: 'success',
	                title: 'Approved!',
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
else if($fullRefund == 1 && $row['paying_email'] == 'Cash')//with full Refund for offline customers
{
	$total_lkr = $row['total_lkr'];
	$null = "update refund SET admin_approval = 'Yes' WHERE refund_id = $refund_id";
	$null1 = "update refund SET refund_amount = '$total_lkr' WHERE refund_id = $refund_id";

		if ($conn->query($null) && $conn->query($null1))
		{
			mailRefund($row['payment_id'],$row['f_name'],$row['l_name'],$row['email']);
			echo "<script>
	            Swal.fire
	            ({
	                icon: 'success',
	                title: 'Approved!',
	                text: 'Click OK to Return.',
	                confirmButtonText: 'OK',
	                confirmButtonColor: '#31bfb1',
	                allowOutsideClick: false,
	            })
	            .then((result) => 
	            {
	            if (result.isConfirmed) 
	            {
	                window.location.href = 'refund.php#collect';
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
else if($fullRefund == 0 && $row['paying_email'] == 'Cash')//without full Refund for offline customers
{
	$null = "update refund SET admin_approval = 'Yes' WHERE refund_id = $refund_id";
	$null1 = "update refund SET refund_amount = '$refundLKR' WHERE refund_id = $refund_id";

		if ($conn->query($null) && $conn->query($null1))
		{
			mailRefund($row['payment_id'],$row['f_name'],$row['l_name'],$row['email']);
			echo "<script>
	            Swal.fire
	            ({
	                icon: 'success',
	                title: 'Approved!',
	                text: 'Click OK to Return.',
	                confirmButtonText: 'OK',
	                confirmButtonColor: '#31bfb1',
	                allowOutsideClick: false,
	            })
	            .then((result) => 
	            {
	            if (result.isConfirmed) 
	            {
	                window.location.href = 'refund.php#collect';
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