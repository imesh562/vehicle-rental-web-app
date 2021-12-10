<?php
include('invoice2.php');

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
$returnInfo = $_SESSION['arr'];
$billInfo = $_SESSION['arr2'];
$rID=0;

	$sql1 = "INSERT INTO vehicle_return (book_id,driven_km, balance, payment_status) values ('$returnInfo[0]','$returnInfo[1]','$returnInfo[2]','Completed');";

    $sql2 = "select * from vehicle_return where book_id ='$returnInfo[0]';";

    mysqli_query($conn, $sql1);
    $result2 = mysqli_query($conn, $sql2);
	$return = mysqli_fetch_array($result2);
	$rID=$return['return_id'];

	$sql3 = "UPDATE booking SET return_id = '$rID' WHERE book_id=$returnInfo[0];";

    mysqli_query($conn, $sql3);

    billOut($returnInfo,$billInfo,$rID);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <title>Success</title>
    <link rel="icon" href="images/Common/icon.png">

    <style type="text/css">
        body 
        {
            background-image: url("images/Common/backg.jpg");
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center top;
        }
    </style>
</head>
<body>
<script>
        Swal.fire
        ({
            icon: 'success',
            title: 'Confirmed Successfully!',
            text: 'Press Button to Print and Redirect.',
            confirmButtonText: 'Print',
            confirmButtonColor: '#31bfb1',
            allowOutsideClick: false,
        })
        .then((result) => 
        {
            if (result.isConfirmed) 
            {
                reDir();
                window.open("printFinal.php?$rID=<?php echo $rID; ?>");
            }
        })
</script>
</body>
</html>

<script>
function reDir() {
  setTimeout(function () {
     window.onbeforeunload = null;
     window.location.href = 'booking.php#Ongoing';
  }, 10);
}
</script>