<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <title>AllDrive - Assign Driver</title>
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
    ignore_user_abort(true);
    session_start();
    if (!isset($_SESSION['admin_id'])) 
    {
        header('location:index.php');
    }
    $Bid = $_GET['bid'];
    include('DBconnection.php');
    include('mail.php');
    if (!empty($_POST))
    {
		$DID=$_POST['driver'];
		$assignD = "update booking SET driver_id = $DID WHERE book_id = $Bid";
		if ($conn->query($assignD))
		{
            $driver = "select * from booking INNER JOIN customer ON customer.customer_id = booking.customer_id OR customer.login_id = booking.login_id where book_id = '$Bid';";
            $dResult = mysqli_query($conn, $driver);
            $dData = mysqli_fetch_array($dResult);

            $driverName = "select * from drivers where driver_id = '".$dData['driver_id']."';";
            $dResultName = mysqli_query($conn, $driverName);
            $dDataName = mysqli_fetch_array($dResultName);

            mailDriverAssign($dData['payment_id'],$dData['f_name'],$dData['l_name'],$dData['email'],$dDataName['f_name']);

			echo "<script>
                Swal.fire
                ({
                    icon: 'success',
                    title: 'Driver Assigned !',
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
    else
    {
        echo '<script>
            if (window.confirm("Invalid Data...")) 
            {
                window.location.href="booking.php#Upcoming";
            };
            </script>'; 
    }
?>
</body>
</html>