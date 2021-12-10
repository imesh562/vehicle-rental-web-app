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
        ?>

		<title>Admin-Dashboard</title>

		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="icon" type="image/png" href="images/icons/icon.png"/>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <link rel="stylesheet" href="Dashboard1.css">
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
	            <div class="container py-3">
		  		<!-- Card Start -->
		  			<div class="card">
		    			<div class="row ">
		      				<div class="col-md-7 px-3">
		        				<div class="card-block px-6">
		        					<?php
		        					$sql = "select * from admin where admin_id ='$id'";
						            $result = mysqli_query($conn, $sql);
									$row = mysqli_fetch_array($result);
		        					?>
		          					<h4 class="card-title">Welcome <?php echo $row["name"]; ?>.</h4>
		          					<h5>(<?php echo $row["post"];?>)</h5>
		          					<br>
		        				</div>
		      				</div>
			      			<!-- Carousel start -->
			      			<div class="col-md-5">
			        			<div id="CarouselTest" class="carousel slide" data-ride="carousel">
						          	<ol class="carousel-indicators">
						            	<li data-target="#CarouselTest" data-slide-to="0" class="active"></li>
						         	</ol>
			          				<div class="carousel-inner">
			            				<div class="carousel-item active">
			              					<img class="d-block" src="images/anime1.gif" alt="anime" style="width: 100%; height: auto;">
			            				</div>
				          			</div>
				        		</div>
				      		</div>
		      				<!-- End of carousel -->
		    			</div>
		  			</div>
				</div>
				<div class="container">
					<br>
					<h1 class="display-4">Overall Information</h1>
					<br>
				    <div class="row">
					    <div class="col-md-4">
						    <div class="card-counter users">
						    	<?php
							    	$sql1 = "select * from customer_login";
						            $result1 = mysqli_query($conn, $sql1);
									$n_Users = mysqli_num_rows($result1);
					            ?>
						        <i class="fa fa-users"></i>
						        <span class="count-numbers"><?php echo $n_Users; ?></span>
						        <span class="count-name">Registered Users</span>
						    </div>
					    </div>

					    <div class="col-md-4">
					      	<div class="card-counter vehicles">
					      		<?php
							    	$sql2 = "select * from vehicle";
						            $result2 = mysqli_query($conn, $sql2);
									$n_vehicle = mysqli_num_rows($result2);
					            ?>
						        <i class="fa fa-taxi"></i>
						        <span class="count-numbers"><?php echo $n_vehicle; ?></span>
						        <span class="count-name">Total Vehicles</span>
						    </div>
					    </div>

					    <div class="col-md-4">
					      	<div class="card-counter drivers">
					      		<?php
							    	$sql3 = "select * from drivers";
						            $result3 = mysqli_query($conn, $sql3);
									$n_drivers = mysqli_num_rows($result3);
					            ?>
						        <i class="fa fa-id-card-o"></i>
						        <span class="count-numbers"><?php echo $n_drivers; ?></span>
						        <span class="count-name">Total Drivers</span>
					      	</div>
					    </div>
				  	</div>
				  	<br>
				  	<h1 class="display-4">Booking Information</h1>
				  	<br>
				    <div class="row">
					    <div class="col-md-4">
					      	<div class="card-counter comBookings">
					      		<?php
							    	$sql4 = "select * from vehicle_return";
						            $result4 = mysqli_query($conn, $sql4);
									$n_comBook = mysqli_num_rows($result4);
					            ?>
						        <i class="fa fa-check-square-o"></i>
						        <span class="count-numbers"><?php echo $n_comBook; ?></span>
						        <span class="count-name">Completed Bookings</span>
					      	</div>
						</div>

						<div class="col-md-4">
					      	<div class="card-counter onBookings">
					      		<?php
							    	$sql5 = "select * from booking where pickup_status = 'Yes' and service IS NULL and return_id IS NULL";
						            $result5 = mysqli_query($conn, $sql5);
									$n_onBook = mysqli_num_rows($result5);
					            ?>
						        <i class="fa fa-spinner"></i>
						        <span class="count-numbers"><?php echo $n_onBook; ?></span>
						        <span class="count-name">Ongoing Bookings</span>
					      	</div>
						</div>

						<div class="col-md-4">
					      	<div class="card-counter upBookings">
					      		<?php
							    	$sql6 = "select * from booking where pickup_status = 'No' and service IS NULL";
						            $result6 = mysqli_query($conn, $sql6);
									$n_upBook = mysqli_num_rows($result6);
					            ?>
						        <i class="fa fa-calendar"></i>
						        <span class="count-numbers"><?php echo $n_upBook; ?></span>
						        <span class="count-name">Upcoming Bookings</span>
					      	</div>
						</div>
					</div>
					<div class="row ">
						<div class="container emp-profile">
							<form action="Dashboard1.php" method="post">
								<div class="row">
				                	<div class="col-md-6">
				                        <div class="profile-head">
				                        	<h4>AllDrive Analysis</h4>
				                        </div>
				                    </div>
				                </div>
				                <br>
							  	<label for="startDate"><b>Start date:</b></label>
							  	<input type="date" id="startDate" name="startDate" value="2021-06-01" min="2021-06-01" max="<?php echo date('Y-m-d'); ?>">
							  	<label for="endDate"><b>End date:</b></label>
							  	<input type="date" id="endDate" name="endDate" value="<?php echo date('Y-m-d'); ?>" min="2021-06-01" max="<?php echo date('Y-m-d'); ?>">
							  	<input type="submit">
							  	<br><br>

							  	<?php
							  		$totalbooking = 0;
						    		$totalRefund = 0;
						    		$numBooks = 0;
						    		$numRefunds = 0;
									if (!empty($_POST))
				    					{
				    						$startDate=$_POST['startDate'];
				        					$endDate=$_POST['endDate']." "."23:59:59";

				        					$report = "select * from booking INNER JOIN payment ON payment.payment_id = booking.payment_id INNER JOIN vehicle_return ON vehicle_return.return_id = booking.return_id where pickup_status ='Yes' AND booking.return_id IS NOT NULL and service IS NULL AND booked_date between '$startDate' and '$endDate' order by booking.book_id DESC;";
											$resultReport = mysqli_query($conn, $report);

											$notPickup = "select * from booking INNER JOIN payment ON payment.payment_id = booking.payment_id where return_id IS NULL and service IS NULL AND booked_date between '$startDate' and '$endDate' order by booking.book_id DESC;";
											$notPickupReport = mysqli_query($conn, $notPickup);

											$refund = "select * from refund where dateStamp between '$startDate' and '$endDate' order by refund_id DESC;";
											$refundReport = mysqli_query($conn, $refund);

											if(mysqli_num_rows($resultReport) > 0)
											{
												$numBooks = mysqli_num_rows($resultReport);
												while($reportData = mysqli_fetch_array($resultReport))
										        {
										            $totalbooking += $reportData['total_lkr'] + ($reportData['balance']);
										        }
											}

											if(mysqli_num_rows($notPickupReport) > 0)
											{
												$numBooks += mysqli_num_rows($notPickupReport);
												while($notPickupData = mysqli_fetch_array($notPickupReport))
										        {
										            $totalbooking += $notPickupData['total_lkr'];
										        }
											}

											if(mysqli_num_rows($refundReport) > 0)
											{
												while($refundData = mysqli_fetch_array($refundReport))
										        {
										        	$numBooks += 1;
										        	$totalbooking += $refundData['total_lkr'];
										        	if ($refundData['admin_approval']=="Yes")
										        	{
										        		$numRefunds +=1;
										        		$totalRefund += $refundData['refund_amount'];
										        	}
										        }
											}
				        				}
								?>

							  				<div class="row">
						                        <div class="col-md-3">
						                            <label>Total Number Of Bookings </label>
						                        </div>
						                        <div class="col-md-6">
						                            <p>: <?php echo $numBooks ?></p>
						                        </div>
						                    </div>

							  				<div class="row">
						                        <div class="col-md-3">
						                            <label>Total Number Of Refunds </label>
						                        </div>
						                        <div class="col-md-6">
						                            <p>: <?php echo $numRefunds ?></p>
						                        </div>
						                    </div>

							  				<div class="row">
						                        <div class="col-md-3">
						                            <label>Earnings From Bookings </label>
						                        </div>
						                        <div class="col-md-6">
						                            <p>: Rs.<?php echo $totalbooking ?></p>
						                        </div>
						                    </div>
			                    
							  				<div class="row">
						                        <div class="col-md-3">
						                            <label>Pay Outs From Refunds </label>
						                        </div>
						                        <div class="col-md-6">
						                            <p>: Rs.<?php echo $totalRefund ?></p>
						                        </div>
						                    </div>

								  			<div class="row">
						                        <div class="col-md-3">
						                            <label>Total Profit </label>
						                        </div>
						                        <div class="col-md-6">
						                            <p>: Rs.<?php echo $totalbooking - $totalRefund ?></p>
						                        </div>
						                    </div>
							</form>
						</div>
					</div>
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