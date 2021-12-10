<!DOCTYPE html>
<html>
	<head>
		<?php
		session_start();
		if (!isset($_SESSION['driver_id'])) {
             header('location:Dlogin.php');
        }else{
        	$id=$_SESSION['driver_id'];
        }
        include('DBconnection.php');
        ?>

		<title>Driver-Dashboard</title>

		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="icon" type="image/png" href="images/icons/icon.png"/>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <link rel="stylesheet" href="Dashboard2.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="DPopM.js"></script>
        <script src="Dashboard2.js"></script>
        <script src="refundMSG.js"></script>
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
			       	<li><a href="Dashboard2.php">Dashboard</a></li>
			       	<li class="dropdown">
			       		<a href="#Bookings" class="dropdown-toggle"  data-toggle="dropdown">Bookings <span class="caret"></span></a>
				     	<ul class="dropdown-menu animated fadeInLeft" role="menu">
					      <div class="dropdown-header">All Bookings</div>
					      <li><a href="Dashboard2.php#Assigned" onClick="history.go(0)">Assigned</a></li>
					      <li><a href="Dashboard2.php#History" onClick="history.go(0)">History</a></li>
				      	</ul>
			      	</li>
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
		        					$sql = "select * from drivers where driver_id ='$id'";
						            $result = mysqli_query($conn, $sql);
									$row = mysqli_fetch_array($result);
		        					?>
		          					<h4 class="card-title">Welcome <?php echo $row["f_name"]; ?>.</h4>
		          					<h5>(Driver)</h5>
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

				<section id="Assigned" class="section">
					<br>
                	<div class="container emp-profile">
			            <form method="post">
			            	<div class="row">
			                	<div class="col-md-6">
			                        <div class="profile-head">
			                        	<h4>Assigned Bookings</h4>
			                        </div>
			                    </div>
			                </div>
			                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="Bookings-tab">
			                            	<div class="table-responsive table-borderless">
											<table class="table">
											  	<thead>
											      		<tr>
											        		<th scope="col"></th>
											        		<th scope="col">Vehicle Name</th>
											        		<th scope="col">Pickup Date/Time</th>
											        		<th scope="col">Pickup Location</th>
											      		</tr>
											    	</thead>
											    	<?php
											    	 	$sql3 = "select * from booking INNER JOIN payment ON payment.payment_id = booking.payment_id INNER JOIN vehicle ON vehicle.vehicle_id = booking.vehicle_id INNER JOIN locations ON locations.location_id = booking.location_id INNER JOIN customer ON customer.customer_id = booking.customer_id OR customer.login_id = booking.login_id where booking.driver_id ='$id' AND booking.pickup_status ='No' ORDER BY booking.book_id DESC;";
											            $result3 = mysqli_query($conn, $sql3);

											            if(mysqli_num_rows($result3) > 0)
											            {
											            	$num = 1;
											                while($onBooking = mysqli_fetch_array($result3))
                											{
											    	?>
												    <tbody>
												      	<tr class="accordion-toggle collapsed" id="accordion<?php echo $num ?>" data-toggle="collapse" data-parent="#accordion<?php echo $num ?>" href="#collapse<?php echo $num ?>">
															<td class="expand-button"></td>
															<td><?php echo $onBooking["vehicle_name"]; ?></td>
															<td><?php echo substr($onBooking["pickup_date"], 0, 10)?> / <?php echo $onBooking["pickup_time"]; ?></td>
															<td><?php echo $onBooking["location"]; ?></td>
														</tr>
														<tr class="hide-table-padding">
															<td></td>
															<td colspan="3">
															<div id="collapse<?php echo $num ?>" class="collapse in p-3">
																<hr>
																<div class="row">
																	<div class="col-6">Customer Name</div>
																	<div class="col-6">: <?php echo $onBooking["f_name"]; ?> <?php echo $onBooking["l_name"]; ?></div>
																</div>
																<div class="row">
																	<div class="col-6">Customer Mobile</div>
																	<div class="col-6">: 0<?php echo $onBooking["tel_no"]; ?></div>
																</div>
																<div class="row">
																	<?php
																		$start_date = $onBooking["pickup_date"];
																		$period = $onBooking["booked_period"]-1;
																        $return_date = date("Y-m-d", strtotime($start_date.'+  '.$period. 'days'));
																	?>
																	<div class="col-6">Estimated Return Date</div>
																	<div class="col-6">: <?php echo $return_date ?></div>
																</div>
																<div class="row">
																	<div class="col-6">Estimated Distance</div>
																	<div class="col-6">: <?php echo $onBooking["estimated_km"]; ?> KM</div>
																</div>
																<div class="row">
																    <div class="col-6">Trip</div>
																    <?php
																    if($onBooking["driver"] == 1)
																    {
																    	echo "<div class='col-6'>: &#10004;</div>";
																    }
																    else
																    {
																    	echo "<div class='col-6'>: &#10006</div>";
																    }
																    ?>
																</div>
																<div class="row">
																    <div class="col-6">Initial Payment</div>
																    <div class="col-6">: Rs.<?php echo $onBooking["total_lkr"]; ?></div>
																</div>
																<div class="row">
																    <div class="col-6">Invoice #</div>
																    <div class="col-6">: 
																    	<a href="printPDF.php?payment_id=<?php echo $onBooking["payment_id"]; ?>"target="_blank"><?php echo $onBooking["payment_id"]; ?></a>
																    </div>
																</div>
																<hr>
																<?php
																date_default_timezone_set("Asia/Dhaka");
																$d=strtotime($onBooking["pickup_date"]." ".$onBooking["pickup_time"]);
																$pDate=date("Y-m-d H:i", $d);
																$checkDate=date("Y-m-d H:i", strtotime("-30 minutes"));
																if ($checkDate>=$pDate)
																{
																?>
																<a href="#" onclick="confirm_message(<?php echo $onBooking["book_id"]; ?>)" class ="button">Submit</a>
																<a href="#" onclick="refund_message(<?php echo $onBooking["payment_id"]; ?>)" class ="button1">Cancel</a>
																<?php
																}
																?>
															</div></td>
														</tr>
												    </tbody>
												    <?php
												    		$num++;
															}
														}
														else
														{
															echo "
															<tbody>
															<td>There is no booking records.</td>
															</tbody>";
														}
												    ?>
											  	</table>
											</div>
			                            </div>
			            </form>
			        </div>

				</section>

				<section id="History" class="section">

					<br>
                	<div class="container emp-profile">
			            <form method="post">
			            	<div class="row">
			                	<div class="col-md-6">
			                        <div class="profile-head">
			                        	<h4>History</h4>
			                        </div>
			                    </div>
			                </div>
			                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="Bookings-tab">
			                            	<div class="table-responsive table-borderless">
											<table class="table">
											  	<thead>
											      		<tr>
											        		<th scope="col"></th>
											        		<th scope="col">Vehicle Name</th>
											        		<th scope="col">Pickup Date/Time</th>
											        		<th scope="col">Pickup Location</th>
											      		</tr>
											    	</thead>
											    	<?php
											    	 	$sql3 = "select * from booking INNER JOIN payment ON payment.payment_id = booking.payment_id INNER JOIN vehicle ON vehicle.vehicle_id = booking.vehicle_id INNER JOIN locations ON locations.location_id = booking.location_id INNER JOIN customer ON customer.customer_id = booking.customer_id OR customer.login_id = booking.login_id where booking.driver_id ='$id' AND booking.pickup_status ='Yes' ORDER BY booking.book_id DESC;";
											            $result3 = mysqli_query($conn, $sql3);

											            if(mysqli_num_rows($result3) > 0)
											            {
											            	$num = 1;
											                while($onBooking = mysqli_fetch_array($result3))
                											{
											    	?>
												    <tbody>
												      	<tr class="accordion-toggle collapsed" id="accordion<?php echo $num ?>" data-toggle="collapse" data-parent="#accordion<?php echo $num ?>" href="#collapse<?php echo $num ?>">
															<td class="expand-button"></td>
															<td><?php echo $onBooking["vehicle_name"]; ?></td>
															<td><?php echo substr($onBooking["pickup_date"], 0, 10)?> / <?php echo $onBooking["pickup_time"]; ?></td>
															<td><?php echo $onBooking["location"]; ?></td>
														</tr>
														<tr class="hide-table-padding">
															<td></td>
															<td colspan="3">
															<div id="collapse<?php echo $num ?>" class="collapse in p-3">
																<hr>
																<div class="row">
																	<div class="col-6">Customer Name</div>
																	<div class="col-6">: <?php echo $onBooking["f_name"]; ?> <?php echo $onBooking["l_name"]; ?></div>
																</div>
																<div class="row">
																	<div class="col-6">Customer Mobile</div>
																	<div class="col-6">: 0<?php echo $onBooking["tel_no"]; ?></div>
																</div>
																<div class="row">
																	<?php
																		$start_date = $onBooking["pickup_date"];
																		$period = $onBooking["booked_period"]-1;
																        $return_date = date("Y-m-d", strtotime($start_date.'+  '.$period. 'days'));
																	?>
																	<div class="col-6">Estimated Return Date</div>
																	<div class="col-6">: <?php echo $return_date ?></div>
																</div>
																<div class="row">
																	<div class="col-6">Estimated Distance</div>
																	<div class="col-6">: <?php echo $onBooking["estimated_km"]; ?> KM</div>
																</div>
																<div class="row">
																    <div class="col-6">Trip</div>
																    <?php
																    if($onBooking["driver"] == 1)
																    {
																    	echo "<div class='col-6'>: &#10004;</div>";
																    }
																    else
																    {
																    	echo "<div class='col-6'>: &#10006</div>";
																    }
																    ?>
																</div>
																<div class="row">
																    <div class="col-6">Initial Payment</div>
																    <div class="col-6">: Rs.<?php echo $onBooking["total_lkr"]; ?></div>
																</div>
																<div class="row">
																    <div class="col-6">Invoice #</div>
																    <div class="col-6">: 
																    	<a href="printPDF.php?payment_id=<?php echo $onBooking["payment_id"]; ?>"target="_blank"><?php echo $onBooking["payment_id"]; ?></a>
																    </div>
																</div>
																<div class="row">
																    <div class="col-6">Status</div>
																    <?php
																    if ($onBooking["return_id"]!=NULL)
																    {
																    ?>
																    	<div class="col-6">: Completed</div>
																    <?php
																    }
																    else
																    {
																    ?>
																    	<div class="col-6">: Ongoing</div>
																    <?php
																    }
																    ?>
																</div>
																<hr>
															</div></td>
														</tr>
												    </tbody>
												    <?php
												    		$num++;
															}
														}
														else
														{
															echo "
															<tbody>
															<td>There is no booking records.</td>
															</tbody>";
														}
												    ?>
											  	</table>
											</div>
			                            </div>
			            </form>
			        </div>
				</section>

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