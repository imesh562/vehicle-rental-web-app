<?php
	if (isset($_SESSION['admin_id']))
	{
		header('location:Dashboard1.php');
	}
	session_start();
	include('DBconnection.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<title>AllDrive - Admin Log In</title>
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

	    if ($_SERVER['REQUEST_METHOD'] == "POST")
	    {
	    	$user_name = $_POST['username'];
	    	$Password = $_POST['pass'];

	    	//read DB
	    	$logquery = "select * from admin where username ='$user_name' limit 1";
	    	$result = mysqli_query($conn,$logquery);

	    	if ($result)
	    	{
	    		if($result && mysqli_num_rows($result) > 0)
				{
					$user_data = mysqli_fetch_assoc($result);

					if($user_data['password']==md5($Password))
					{
						$id = $_SESSION['admin_id'] = $user_data['admin_id'];

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
	                                window.location.href = 'Dashboard1.php';
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