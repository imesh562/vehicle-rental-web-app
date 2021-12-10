<!DOCTYPE html>
<html>
	<head>
		<?php
		session_start();
		if (!isset($_SESSION['admin_id'])) {
             header('location:index.php');
        }else{
        	$id=$_SESSION['admin_id'];
        }
        include('DBconnection.php');
        $drivID = $_GET['drivID'];
        ?>

		<title>Update Driver</title>

		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="icon" type="image/png" href="images/icons/icon.png"/>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <link rel="stylesheet" href="driversCSS.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

        <link href="http://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="http://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>

        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
        <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

        <script src="PopM.js"></script>
        <script src="Dashboard1.js"></script>
        <script src="tableJS.js"></script>
	</head>
	<body>
		<div id="wrapper">
   			<div class="overlay"></div>
    
	    	<nav class="navbar navbar-inverse fixed-top" id="sidebar-wrapper" role="navigation">
	     		<ul class="nav sidebar-nav">
	       			<div class="sidebar-header">
	       				<div class="sidebar-brand">
	         				<a href="#">All<b>Drive</b></a>
	         			</div>
	         		</div>
			       	<li><a href="Dashboard1.php">Dashboard</a></li>
			       	<li class="dropdown">
			       		<a href="#Bookings" class="dropdown-toggle"  data-toggle="dropdown">Bookings <span class="caret"></span></a>
				     	<ul class="dropdown-menu animated fadeInLeft" role="menu">
					      <div class="dropdown-header">All Bookings</div>
					      <li><a href="vType.php"> Add New</a></li>
					      <li><a href="booking.php#Upcoming">Upcoming</a></li>
					      <li><a href="booking.php#Ongoing">Ongoing</a></li>
					      <li><a href="booking.php#Completed">Completed</a></li>
				      	</ul>
			      	</li>
			      	<li><a href="refund.php">Refund Requests</a></li>
			      	<li><a href="reviews.php">Manage Reviews</a></li>
			      	<li><a href="manageVehicles.php">Manage Vehicles</a></li>
			      	<li><a href="drivers.php">Manage Drivers</a></li>
			      	<li><a href="customers.php">View Customers</a></li>
			      	<li><a href="about.php">  About Us</a></li>
			      	<li><a href="#LogOut" onclick = "log_out_message()"> Log Out</a></li>
	      		</ul>
	  		</nav>
	        <!-- /#sidebar-wrapper -->

	        <!-- Page Content -->
	        <div id="page-content-wrapper">
	            <button type="button" class="hamburger animated fadeInLeft is-closed" data-toggle="offcanvas">
	                <span class="hamb-top"></span>
	    			<span class="hamb-middle"></span>
					<span class="hamb-bottom"></span>
	            </button>
	            <div class="content">
	                <section id="addDrivers" class="section">
                	    <div class="addDrivers-form">
                            <br>

                            <?php
                                $sql = "select * from drivers where driver_id = '$drivID' limit 1;";
                                $result = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_array($result);
                            ?>

                            <?php
                            if (!empty($_POST))
                                {
                                    $f_name=$_POST['f_name'];
                                    $tel_no=$_POST['tel_no'];
                                    $address=$_POST['address'];
                                    $Username=$_POST['Username'];
                                    $driver_id=$row["driver_id"];

                                    $uname_chk="SELECT * FROM drivers where username ='$Username' Except SELECT * FROM drivers WHERE driver_id = $driver_id";
                                    $resultUN = mysqli_query($conn, $uname_chk);
                                    $numUN = mysqli_num_rows($resultUN);

                                    $tel_chk="SELECT * FROM drivers where tel_no ='$tel_no' Except SELECT * FROM drivers WHERE driver_id = $driver_id";
                                    $resultTel = mysqli_query($conn, $tel_chk);
                                    $numTel = mysqli_num_rows($resultTel);
                                }
                            ?>

                            <br>
                            <form action="updateDriver.php?drivID=<?php echo $row["driver_id"]; ?>" method="post" enctype="multipart/form-data">
                                <h2>Update Driver</h2>
                                <p class="hint-text">Update the follwing details.</p>
                                <div class="form-group">
                                    <p>Driver Name</p>
                                    <input type="text" class="form-control" name="f_name" placeholder="Driver Name" value="<?php echo $row["f_name"]; ?>" required="required">
                                </div>
                                <div class="form-group">
                                    <p>Mobile Number</p>
                                    <input type="tel" class="form-control" name="tel_no" placeholder="Mobile Number" value="0<?php echo $row["tel_no"]; ?>" maxlength="10" required="required" pattern="^\d{10}$">
                                    <div id="msg_t">
                                        <?php
                                            if (isset($numTel) && $numTel == 1)
                                        {
                                            echo '<p style="color: red"> This Mobile Number is already registered.</p>'; 
                                        }?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <p>Address</p>
                                    <input type="text" class="form-control" name="address" value="<?php echo $row["address"]; ?>" placeholder="Address" required="required">
                                </div>
                                <div class="form-group">
                                    <p>Username</p>
                                    <input type="text" class="form-control" name="Username" value="<?php echo $row["username"]; ?>" placeholder="Username" minlength = "8" maxlength = "16" required="required">
                                    <div id="msg_u">
                                        <?php
                                        if (isset($numUN) && $numUN == 1)
                                        {
                                            echo '<p style="color: red"> Username Already Taken.</p>'; 
                                        }?>
                                    </div>
                                </div>
                                <button type="submit" id="submit" class="btn btn-success btn-lg btn-block" >Submit</button>
                            </form>
                            <br>
                            <a href="PWDriver.php?drivID=<?php echo $row["driver_id"]; ?>" style="text-decoration: none;"><button class="btn btn-success btn-lg btn-block" style="background-color: #ff5050;">Change Password</button></a>
                        </div>
	            	</section>
                    <?php
                    if (!empty($_POST) && isset($numUN) && isset($numTel)) 
                    {
                        if(!empty($_POST['f_name'] && $_POST['tel_no'] && $_POST['address'] && $_POST['Username']))
                        {
                            if($numUN != 1 && $numTel != 1)
                            {

                                $sql3 ="UPDATE drivers 
                                        SET 
                                        f_name = '$f_name',
                                        tel_no = '$tel_no',
                                        address = '$address',
                                        username = '$Username'
                                        WHERE
                                        driver_id = '$driver_id';";

                                if ($conn->query($sql3))
                                {
                                    mysqli_close($conn);
                                        echo
                                            "<script>
                                                Swal.fire
                                                ({
                                                    icon: 'success',
                                                    title: 'Driver Details Updated !',
                                                    text: 'Click OK to Return.',
                                                    confirmButtonText: 'OK',
                                                    confirmButtonColor: '#31bfb1',
                                                    allowOutsideClick: false,
                                                })
                                                .then((result) => 
                                                {
                                                if (result.isConfirmed) 
                                                {
                                                    window.location.href = 'drivers.php';
                                                }
                                                })
                                            </script>";  
                                }
                                else
                                {
                                    echo '<script>
                                            if (window.confirm("Invalid Data...")) 
                                            {
                                                window.location.href="drivers.php";
                                            };
                                            </script>'; 
                                }
                            }
                        }
                        else
                        {
                            echo '<script>
                                    if (window.confirm("Invalid Data...")) 
                                    {
                                        window.location.href="drivers.php";
                                    };
                                    </script>'; 
                        }
                    }
                    ?>
				</div>

			<!-- Start of Footer -->

            <div>
                <footer class="footer">
                    <div class="footer-left col-md-4 col-sm-6">
                        <p class="about">
                            <span> About AllDrive</span>AllDrive is a member of the Rent A Car Association (RACA) Sri Lanka, recognised by the Automobile Association (AA) of Sri Lanka and is a Sri Lanka Tourist Board approved transport provider.
                            <br>
                            We take pride in being able to offer the highest levels of service in the industry.
                        </p>
                        <div class="icons">
                            <a href="https://web.facebook.com/AllDrive-103548621726091" target="_blank"><i class="fa fa-facebook"></i></a>
                            <a href="https://twitter.com/SriDrive" target="_blank"><i class="fa fa-twitter"></i></a>
                            <a href="https://www.instagram.com/alldrivesrilanka" target="_blank"><i class="fa fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="footer-center col-md-4 col-sm-6">
                        <div>
                            <i class="fa fa-map-marker"></i>
                            <p><span> 271, Aladeniya Road ,</span> Peradeniya ,Sri Lanka</p>
                            </div>
                        <div>
                            <i class="fa fa-phone"></i>
                            <p> (+94) 0812 410 194</p>
                        </div>
                        <div>
                            <i class="fa fa-envelope"></i>
                            <p><a href="https://mail.google.com/mail/?view=cm&fs=1&to=alldrivesrilanka@Gmail.com" target="_blank"> alldrivesrilanka@Gmail</a></p>
                        </div>
                    </div>
                    <div class="footer-right col-md-4 col-sm-6">
                        <h2> All<span>Drive</span></h2>
                        <p class="name"> AllDrive &copy; 2020</p>
                    </div>
                </footer>
            </div>              
	        </div>
	    </div>
	</body>
</html>