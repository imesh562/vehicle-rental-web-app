<?php
	session_start();
	include('DBconnection.php');
	include ('LoginCheck.php');
	$page = $_GET['Page'];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<title>AllDrive - Log In</title>
	<link rel="icon" href="Images/Common/icon.png">

	<style type="text/css">
		body 
		{
			background-image: url("Images/Common/backg.jpg");
			background-repeat: no-repeat;
			background-attachment: fixed;
			background-position: center top;
		}
	</style>
</head>
<body>
	<?php

	    if ($_SERVER['REQUEST_METHOD'] == "POST")
	    {
	    	$user_name = $_POST['LogUsername'];
	    	$Password = $_POST['Logpassword'];

	    	//read DB
	    	$logquery = "select * from customer_login where username ='$user_name' limit 1";
	    	$result = mysqli_query($conn,$logquery);

	    	if ($result)
	    	{
	    		if($result && mysqli_num_rows($result) > 0)
				{
					$user_data = mysqli_fetch_assoc($result);

					if($user_data['password']==md5($Password))
					{
						$id = $_SESSION['login_id'] = $user_data['login_id'];

						echo
						"<script>
	                        Swal.fire
	                        ({
	                            icon: 'success',
	                            title: 'Login Successfull!',
	                            text: 'Click OK to Return.',
	                            confirmButtonText: 'OK',
	                            confirmButtonColor: '#31bfb1',
	                            allowOutsideClick: false,
	                        })
	                        .then((result) => 
	                        {
	                            if (result.isConfirmed) 
	                            {
	                                window.location.href = '$page';
	                            }
	                        })
	                    </script>";
					}
					else
	    			{
		    			echo 
						"<script>
		                    Swal.fire
		                    ({
	  							icon: 'error',
	  							title: 'Oops...',
	  							text: 'Please Enter Correct Password.',
	  							confirmButtonColor: '#31bfb1',
	                            allowOutsideClick: false,
							})
							.then((result) => 
	                        {
	                            if (result.isConfirmed) 
	                            {
	                                window.location.href = 'index.php';
	                            }
	                        })
		                </script>";
	    			}
	    		}
	    		else
	    		{
	    			echo
					"<script>
	                    Swal.fire
	                    ({
  							icon: 'error',
  							title: 'Oops...',
  							text: 'Please Enter Correct Username.',
  							confirmButtonColor: '#31bfb1',
	                        allowOutsideClick: false,
						})
						.then((result) => 
	                        {
	                            if (result.isConfirmed) 
	                            {
	                                window.location.href = 'index.php';
	                            }
	                        })
	                </script>";
	    		}
	    	}
	    }
	?>
</body>
</html>