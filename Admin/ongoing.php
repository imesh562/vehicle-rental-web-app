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
        $distance=$_POST['distance'];
        $fees=$_POST['damages'];
        $days=$_POST['days'];
        $bid = $_GET['bid'];
        ?>

		<title>Vehicle Return</title>

		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="icon" type="image/png" href="images/icons/icon.png"/>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <link rel="stylesheet" href="ongoing.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="PopM.js"></script>
        <script src="Dashboard1.js"></script>

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
	            <div class="box">
	            	<?php
	            		if (!empty($_POST))
    					{
    						$sql = "select * from booking INNER JOIN payment ON payment.payment_id = booking.payment_id INNER JOIN vehicle ON vehicle.vehicle_id = booking.vehicle_id where booking.book_id ='$bid'ORDER BY booking.book_id DESC;";
							$result = mysqli_query($conn, $sql);

							if(mysqli_num_rows($result) > 0)
							{
								$newPay = mysqli_fetch_array($result);

								if ($newPay['driver']==1)
								{
									$driverPay=$newPay['booked_period']*1300;
								}
								else
								{
									$driverPay=0;
								}

								$initial_PayLKR=$newPay['total_lkr'];
								$new_Dis = ($newPay['km_price']*$distance);
								$newest_Total = ($days*$newPay['day_price'])+$driverPay+$new_Dis+$fees;
								$balance=$initial_PayLKR-$newest_Total;
								$rentDays=$days*$newPay['day_price'];

								$returnInfo=array($bid,$distance,$balance);
								$billInfo=array($initial_PayLKR,$new_Dis,$driverPay,$rentDays,$fees,$newest_Total);
								$_SESSION['arr'] = $returnInfo;
								$_SESSION['arr2'] = $billInfo;
							?>
							<!-- Checkout Fill -->
			                <div class="col-md-4" style="margin:0 auto;">
			                	<div class="container">
									<br><h4>Final Payment <span class="price" style="color:black"><i class="fa fa-shopping-cart"></i></span></h4><br>
									<p>Rent for Distance : (<?php echo $distance; ?>*<?php echo $newPay['km_price'] ?>)<span class="price">Rs.<?php echo $new_Dis; ?></span></p>
									<p>Rent for Days : (<?php echo $days; ?>*<?php echo $newPay['day_price'] ?>)<span class="price">Rs.<?php echo $rentDays; ?></span></p>
									<p>Rent for Driver :<span class="price">Rs.<?php echo $driverPay; ?></span></p>
									<p>Extra fees :<span class="price">Rs.<?php echo $fees; ?></span></p>
					      			<hr>
					      			<p>Final Total :<span class="price" style="color:black"><b>Rs.<?php echo $newest_Total; ?></b></span></p>
					      			<p>Initial Payment :<span class="price">Rs.<?php echo $initial_PayLKR; ?></span></p>
			                        <hr>
			                        <p>Balance :<b><span class="price">Rs.<?php echo ($balance); ?></span></b></p>
			                        <button type="submit" onclick="return_Message()" id="submit" class="checkout" >Confirm Booking</button>
					    		</div>
					  		</div>
			                <br><br>
			                <div class="text-center">
			                    <img src="Images/banner.jpg" class="rounded" alt="banner" style = "width:95%; max-width:700px">
			                </div>
							<?php
							}
							else
							{
								echo "Booking Not Available.";
							}
    					}
    					else
    					{
    						echo "Booking Not Available.";
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
<script type="text/javascript">
function return_Message()
    {
        Swal.fire
    ({
        title: "Are you sure?",
        text: "You Want To Confirm?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#31bfb1",
        cancelButtonColor: "#e60000",
        confirmButtonText: "Yes",
        allowOutsideClick: false,
    }).
    then((result) => 
    {
        if (result.isConfirmed) 
        {
            window.location.href = "v_Return.php";
        }
    })
    }
</script>