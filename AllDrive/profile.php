<?php
    session_start();
    include('DBconnection.php');
    include ('LoginCheck.php');
?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald:300,400|Roboto:300,400,700">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Varela+Round">

        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

        <script src="profileJS.js"></script>
        <script src="PopM.js"></script>
        <script src="refundMSG.js"></script>
        <link rel="icon" href="Images/Common/icon.png">
        <title>AllDrive - Profile</title>

        <link rel="stylesheet" href="profileStyle.css">

    </head>
    <body>

        <!-- Navigation Bar -->

        <nav class="navbar navbar-expand-lg navbar-light bg-light navbar sticky-top">
            <a href="index.php" class="navbar-brand">All<b>Drive</b></a>       
            <button type="button" class="navbar-toggler ml-auto custom-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div id="navbarCollapse" class="collapse navbar-collapse justify-content-start">
                <div class="navbar-nav">
                    <a href="index.php" class="nav-item nav-link active" style="color:white">Home</a>
                    <a href="vType.php" class="nav-item nav-link" style="color:white">Vehicles</a>         
                    <a href="about.php" class="nav-item nav-link" style="color:white">About</a>
                    <a href="contact.php" class="nav-item nav-link" style="color:white">Contact</a>
                    <a href="terms.php" class="nav-item nav-link" style="color:white">T&C</a>
                </div>

                <!-- Login Drop Down Menu -->
                <!-- Login_Check -->
                <?php
                $user_data = check_login($conn);
                    if ($user_data == 0) 
                    {
                        echo('
                        <div class="navbar-nav ml-auto action-buttons">
                            <div class="nav-item dropdown">
                                <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle mr-4" style="color:white">Login</a>
                                <div class="dropdown-menu action-form">
                                    <form action="login.php?Page=index.php" method="post">
                                        <p class="hint-text">Enter Your Login Details</p>
                                        <div class="form-group">
                                            <input autocomplete="off" type="text" class="form-control" name="LogUsername" placeholder="Username" required="required">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="Logpassword" placeholder="Password" required="required">
                                        </div>
                                        <input type="submit" class="btn btn-primary btn-block" value="Login">
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Sign Up Button -->
                        <div class="nav-item">
                            <a href="Reg_page.php" class="btn btn-primary sign-up-btn">Sign up</a>
                        </div>');
                    }
                    else
                    {
                        echo
                        ('<div class="navbar-nav ml-auto action-buttons">
                        <!-- Log Out Button -->
                            <div class="nav-item">
                                <a href="#" onclick = "log_out_message()" class="btn btn-log log-out-btn">Log Out</a>
                            </div>
                        </div>');
                    }
                ?>
            </div>
        </nav>

        <div class="container py-3">
  		<!-- Card Start -->
  			<div class="card">
    			<div class="row ">
      				<div class="col-md-7 px-3">
        				<div class="card-block px-6">
        					<?php
        					$user_data = check_login($conn);
							$id = $user_data['login_id'];
        					$sql = "select * from customer where login_id ='$id'";
				            $result = mysqli_query($conn, $sql);
							$row = mysqli_fetch_array($result);
        					?>
          					<h4 class="card-title">Welcome <?php echo $row["f_name"]; ?> <?php echo $row["l_name"]; ?>.</h4>
          					<p class="card-text">
            					You can Manage, View and Edit Personal information from this page.
          					</p>
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
	              					<img class="d-block" src="Images/Common/anime.gif" alt="">
	            				</div>
		          			</div>
		        		</div>
		      		</div>
      				<!-- End of carousel -->
    			</div>
  			</div>
		</div>

<!-- User Information -->

		<?php
		$user_data = check_login($conn);
		$id = $user_data['login_id'];

            $sql = "select * from customer where login_id ='$id'";
            $result = mysqli_query($conn, $sql);

            $sql1 = "select * from customer_login where login_id ='$id'";
            $result1 = mysqli_query($conn, $sql1);

            if(mysqli_num_rows($result) > 0 && mysqli_num_rows($result1) > 0)
            {
                $row = mysqli_fetch_array($result);
                $row1 = mysqli_fetch_array($result1);         
                ?>
                <br>
                	<div class="container emp-profile">
			                <div class="row">
			                	<div class="col-md-8">
			                        <div class="profile-head">
			                        	<h4>User Details</h4>
			                            <h5>
			                                <?php echo $row["f_name"]; ?> <?php echo $row["l_name"]; ?>
			                            </h5>
			                            <ul class="nav nav-tabs" id="myTab" role="tablist">
			                                <li class="nav-item">
			                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
			                                </li>
			                                <li class="nav-item">
			                                    <a class="nav-link" id="Bookings-tab" data-toggle="tab" href="#Bookings" role="tab" aria-controls="Bookings" aria-selected="false">On-Going Bookings</a>
			                                </li>
			                                <li class="nav-item">
			                                    <a class="nav-link" id="completed-tab" data-toggle="tab" href="#completed" role="tab" aria-controls="completed" aria-selected="false">Completed Bookings</a>
			                                </li>
			                                <li class="nav-item">
			                                    <a class="nav-link" id="refund-tab" data-toggle="tab" href="#refund" role="tab" aria-controls="refund" aria-selected="false">Refund Requests</a>
			                                </li>
			                            </ul>
			                        </div>
			                    </div>
			                </div>
			                <div class="row">
			                	<div class="col-md-8">
			                        <div class="tab-content home-tab" id="myTabContent">
			                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
			                                        <div class="row">
			                                            <div class="col-md-6">
			                                                <label>User Name</label>
			                                            </div>
			                                            <div class="col-md-6">
			                                                <p><?php echo $row1["username"]; ?></p>
			                                            </div>
			                                        </div>
			                                        <div class="row">
			                                            <div class="col-md-6">
			                                                <label>Name</label>
			                                            </div>
			                                            <div class="col-md-6">
			                                                <p><?php echo $row["f_name"]; ?> <?php echo $row["l_name"]; ?></p>
			                                            </div>
			                                        </div>
			                                        <div class="row">
			                                            <div class="col-md-6">
			                                                <label>Email</label>
			                                            </div>
			                                            <div class="col-md-6">
			                                                <p><?php echo $row["email"]; ?></p>
			                                            </div>
			                                        </div>
			                                        <div class="row">
			                                            <div class="col-md-6">
			                                                <label>Phone</label>
			                                            </div>
			                                            <div class="col-md-6">
			                                                <p><?php echo $row["tel_no"]; ?></p>
			                                            </div>
			                                        </div>
			                                        <div class="row">
			                                            <div class="col-md-6">
			                                                <label>Address</label>
			                                            </div>
			                                            <div class="col-md-6">
			                                                <p><?php echo $row["address"]; ?></p>
			                                            </div>
			                                        </div>
			                                    <!--<div class="row">
				                                        <div class="col-md-6">
									                        <input type="submit" class="profile-edit-btn" name="btnAddMore" value="Edit Profile"/>
									                    </div>
									                </div>-->
			                            </div>
			                            <div class="tab-pane fade" id="Bookings" role="tabpanel" aria-labelledby="Bookings-tab">
			                            	<div class="table-responsive table-borderless">
											  	<table class="table">
											    	<thead>
											      		<tr>
											        		<th scope="col"></th>
											        		<th scope="col">Vehicle Name</th>
											        		<th scope="col">Booked Date</th>
											        		<th scope="col">Pickup Date</th>
											      		</tr>
											    	</thead>
											    	<?php
											    	 	$sql3 = "select * from booking INNER JOIN payment ON payment.payment_id = booking.payment_id INNER JOIN vehicle ON vehicle.vehicle_id = booking.vehicle_id INNER JOIN locations ON locations.location_id = booking.location_id where booking.login_id ='$id' AND booking.return_id IS NULL ORDER BY booking.book_id DESC;";
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
															<td><?php echo substr($onBooking["booked_date"], 0, 10); ?></td>
															<td><?php echo $onBooking["pickup_date"]; ?></td>
														</tr>
														<tr class="hide-table-padding">
															<td></td>
															<td colspan="3">
															<div id="collapse<?php echo $num ?>" class="collapse in p-3">
																<hr>
																<div class="row">
																	<div class="col-6">Pickup Location</div>
																	<div class="col-6">: <?php echo $onBooking["location"]; ?></div>
																</div>
																<div class="row">
																	<div class="col-6">Pickup Time</div>
																	<div class="col-6">: <?php echo $onBooking["pickup_time"]; ?></div>
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
																    <div class="col-6">Driver</div>
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
																    <div class="col-6">: <a href="printPDF.php?payment_id=<?php echo $onBooking["payment_id"]; ?>"target="_blank"><?php echo $onBooking["payment_id"]; ?></a></div>
																</div>
																<?php
																	if ($onBooking["driver_id"]==NULL)
																	{
																		?>
																		<div class="row">
																			<div class="col-6">Driver Name</div>
																			<div class="col-6">: Driver Not Assigned Yet</div>
																		</div>
																		<?php
																	}
																	else
																	{
																		$driver = "select * from drivers where driver_id = '".$onBooking["driver_id"]."';";
																		$dResult = mysqli_query($conn, $driver);
																		$dData = mysqli_fetch_array($dResult);
																		?>
																		<div class="row">
																			<div class="col-6">Driver Name</div>
																			<div class="col-6">: <?php echo $dData["f_name"]; ?></div>
																		</div>
																		<?php
																	}
																?>
																<div class="row">
																    <div class="col-6">Status</div>
																    <?php
																    if ($onBooking["pickup_status"]=='No')
																    {
																    ?>
																    	<div class="col-6">: Pending</div>
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
																<?php
																    if ($onBooking["pickup_status"]=='No')
																    {
																    ?>
																    	<a href="#" onclick="refund_message(<?php echo $onBooking["payment_id"]; ?>)" class ="button">Cancel and Request a Refund</a>
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
			                            <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
			                            	<div class="table-responsive table-borderless">
											  	<table class="table">
											    	<thead>
											      		<tr>
											        		<th scope="col"></th>
											        		<th scope="col">Vehicle Name</th>
											        		<th scope="col">Booked Date</th>
											        		<th scope="col">Pickup Date</th>
											      		</tr>
											    	</thead>
											    	<?php
											    	 	$sql2 = "select * from booking INNER JOIN payment ON payment.payment_id = booking.payment_id INNER JOIN vehicle_return ON vehicle_return.return_id = booking.return_id INNER JOIN vehicle ON vehicle.vehicle_id = booking.vehicle_id INNER JOIN locations ON locations.location_id = booking.location_id where booking.login_id ='$id' AND booking.return_id IS NOT NULL ORDER BY booking.book_id DESC;";
											            $result2 = mysqli_query($conn, $sql2);

											            if(mysqli_num_rows($result2) > 0)
											            {
											            	$number = 1;
											                while($bookingData = mysqli_fetch_array($result2))
                											{
											    	?>
												    <tbody>
												      	<tr class="accordion-toggle collapsed" id="accordion<?php echo $number ?>" data-toggle="collapse" data-parent="#accordion<?php echo $number ?>" href="#collapse<?php echo $number ?>">
															<td class="expand-button"></td>
															<td><?php echo $bookingData["vehicle_name"]; ?></td>
															<td><?php echo substr($bookingData["booked_date"], 0, 10); ?></td>
															<td><?php echo $bookingData["pickup_date"]; ?></td>
														</tr>
														<tr class="hide-table-padding">
															<td></td>
															<td colspan="3">
															<div id="collapse<?php echo $number ?>" class="collapse in p-3">
																<hr>
																<div class="row">
																	<div class="col-6">Pickup Location</div>
																	<div class="col-6">: <?php echo $bookingData["location"]; ?></div>
																</div>
																<div class="row">
																	<div class="col-6">Pickup Time</div>
																	<div class="col-6">: <?php echo $bookingData["pickup_time"]; ?></div>
																</div>
																<div class="row">
																	<div class="col-6">Estimated Distance</div>
																	<div class="col-6">: <?php echo $bookingData["estimated_km"]; ?> KM</div>
																</div>
																<div class="row">
																    <div class="col-6">Driven Distance</div>
																    <div class="col-6">: <?php echo $bookingData["driven_km"]; ?> KM</div>
																</div>
																<div class="row">
																    <div class="col-6">Returned Date</div>
																    <div class="col-6">: <?php echo substr($bookingData["return_date"], 0, 10); ?></div>
																</div>
																<div class="row">
																    <div class="col-6">Driver</div>
																    <?php
																    if($bookingData["driver"] == 1)
																    {
																    	echo "<div class='col-6'>: &#10004;</div>";
																    }
																    else
																    {
																    	echo "<div class='col-6'>: &#10006</div>";
																    }
																    ?>
																</div>
																<?php
																	if ($bookingData["driver_id"]==NULL)
																	{
																		?>
																		<div class="row">
																			<div class="col-6">Driver Name</div>
																			<div class="col-6">: Driver Not Assigned Yet</div>
																		</div>
																		<?php
																	}
																	else
																	{
																		$driver = "select * from drivers where driver_id = '".$bookingData["driver_id"]."';";
																		$dResult = mysqli_query($conn, $driver);
																		$dData = mysqli_fetch_array($dResult);
																		?>
																		<div class="row">
																			<div class="col-6">Driver Name</div>
																			<div class="col-6">: <?php echo $dData["f_name"]; ?></div>
																		</div>
																		<?php
																	}
																?>
																<div class="row">
																    <div class="col-6">Initial Payment</div>
																    <div class="col-6">: Rs.<?php echo $bookingData["total_lkr"]; ?></div>
																</div>
																<div class="row">
																    <div class="col-6">Invoice</div>
																    <div class="col-6">: <a href="printPDF.php?payment_id=<?php echo $bookingData["payment_id"]; ?>"target="_blank"><?php echo $bookingData["payment_id"]; ?></a></div>
																</div>
																<div class="row">
																    <div class="col-6">Balance on Return</div>
																    <div class="col-6">: Rs.<?php echo $bookingData["balance"]; ?></div>
																</div>
																<div class="row">
																    <div class="col-6">Return Invoice</div>
																    <div class="col-6">: <a href="printFinal.php?$rID=<?php echo $bookingData["return_id"]; ?>"target="_blank"><?php echo $bookingData["return_id"]; ?></a></div>
																</div>
																<div class="row">
																    <div class="col-6">Payment Status</div>
																    <div class="col-6">: <?php echo $bookingData["payment_status"]; ?></div>
																</div>
																<hr>
																<?php
																$sql4 = "select * from reviews where booking_id = '".$bookingData["book_id"]."';";
																$result4 = mysqli_query($conn, $sql4);

																if(mysqli_num_rows($result4) > 0)
																{
																	$reviewData = mysqli_fetch_array($result4);
																}
																if ($bookingData["review_id"]==NULL) 
																{
																?>
																	<div class="container">
																	<div class="row" style="margin-top:40px;">
																		<div class="col-md-12">
																    	<div class="well well-sm">
																            <div class="text-center">
																                <a class="btn btn-success btn-green" href="#reviews-anchor" id="open-review-box">Leave a Review</a>
																            </div>
																        
																            <div class="row" id="post-review-box" style="display:none;">
																                <div class="col-md-12">
																                    <form action="addReview.php?book_id=<?php echo $bookingData["book_id"]; ?>&vehicle_id=<?php echo $bookingData["vehicle_id"]; ?>" method="post">
																                        <input id="ratings-hidden" name="rating" type="hidden"> 
																                        <textarea class="form-control animated" cols="50" id="new-review" name="comment" placeholder="Enter your review here..." rows="5" required="required" autocomplete="off"></textarea>
																                        <div class="text-right">
																                            <a class="button3" id="close-review-box" style="display:none; margin-right: 10px;">Cancel</a>
																                            <button class="button2" type="submit">Save</span></button>
																                        </div>
																                    </form>
																                </div>
																            </div>
																        </div> 
																         
																		</div>
																	</div>
																</div>
																<?php
																}
																elseif ($bookingData["review_id"]!=NULL && $reviewData["approval"]==NULL) 
																{
																?>
																	<div class="row">
																    	<div class="col-6">Review Status</div>
																    	<div class="col-6">: Pending</div>
																	</div>
																<?php
																}
																elseif ($bookingData["review_id"]!=NULL && $reviewData["approval"]==0) 
																{
																?>
																	<div class="row">
																    	<div class="col-6">Review Status</div>
																    	<div class="col-6">: Cancelled</div>
																	</div>
																<?php
																}
																elseif ($bookingData["review_id"]!=NULL && $reviewData["approval"]==1) 
																{
																?>
																	<div class="row">
																    	<div class="col-6">Review Status</div>
																    	<div class="col-6">: Approved</div>
																	</div>
																<?php
																}
																?>
																
															</div></td>
														</tr>
												    </tbody>
												    <?php
												    		$number++;
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
			                            <div class="tab-pane fade" id="refund" role="tabpanel" aria-labelledby="refund-tab">
			                            	<div class="table-responsive table-borderless">
											  	<table class="table">
											    	<thead>
											      		<tr>
											        		<th scope="col"></th>
											        		<th scope="col">Vehicle Name</th>
											        		<th scope="col">Booked Date</th>
											        		<th scope="col">Cancelled Date</th>
											      		</tr>
											    	</thead>
											    	<?php
											    	 	$sql5 = "select * from refund INNER JOIN vehicle ON vehicle.vehicle_id = refund.vehicle_id where refund.login_id ='$id' ORDER BY refund.refund_id DESC;";
											            $result5 = mysqli_query($conn, $sql5);

											            if(mysqli_num_rows($result5) > 0)
											            {
											            	$number = 1;
											                while($refundData = mysqli_fetch_array($result5))
                											{
											    	?>
												    <tbody>
												      	<tr class="accordion-toggle collapsed" id="accordion<?php echo $number ?>" data-toggle="collapse" data-parent="#accordion<?php echo $number ?>" href="#collapse<?php echo $number ?>">
															<td class="expand-button"></td>
															<td><?php echo $refundData["vehicle_name"]; ?></td>
															<td><?php echo substr($refundData["booked_date"], 0, 10); ?></td>
															<td><?php echo substr($refundData["dateStamp"], 0, 10); ?></td>
														</tr>
														<tr class="hide-table-padding">
															<td></td>
															<td colspan="3">
															<div id="collapse<?php echo $number ?>" class="collapse in p-3">
																<hr>
																<div class="row">
																	<div class="col-6">Payment</div>
																	<div class="col-6">: Rs.<?php echo $refundData["total_lkr"]; ?></div>
																</div>
																<div class="row">
																	<div class="col-6">Invoice #</div>
																	<div class="col-6">: <a href="printPDF.php?payment_id=<?php echo $refundData["payment_id"]; ?>"target="_blank"><?php echo $refundData["payment_id"]; ?></a></div>
																</div>
																<div class="row">
																	<div class="col-6">Refund Status</div>
																	<?php
																    if($refundData["admin_approval"] != "No")
																    {
																    	echo "<div class='col-6'>: &#10004;</div>";
																    }
																    else
																    {
																    	echo "<div class='col-6'>: &#10006</div>";
																    }
																    ?>
																</div>
																<hr>
															</div></td>
														</tr>
												    </tbody>
												    <?php
												    		$number++;
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
			                        </div>
			                	</div>
			            	</div>         
			        </div>
                <?php
	        }
	        else
	        {
                echo
                '<br><br><br><br><br><br><br><div class="title h3 text-center" style="color:white">Sorry No User Data Available At The Moment.</div>
                <br><br><br><br><br><br><br><br><br><br><br><br>';
	        }
				?>
            
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
                    <p class="menu">
                    <a href="index.php"> Home</a> |
                    <a href="vType.php"> Vehicles</a> |
                    <a href="about.php"> About</a> |
                    <a href="contact.php"> Contact</a> |
                    <a href="terms.php"> T&C</a> |
                    <a href="../Admin/index.php"> Administration</a>
                    </p>
                    <p class="name"> AllDrive &copy; 2020</p>
                </div>
            </footer>
        </div>
    </body>
</html>