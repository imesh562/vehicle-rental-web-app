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
        include('refundcode.php');

        // Fetching JSON
		$req_url = 'https://v6.exchangerate-api.com/v6/0820f7f6c3d3b40606fa7500/latest/LKR';
		$response_json = file_get_contents($req_url);

		// Continuing if we got a result
		if(false !== $response_json) {

		    // Try/catch for json_decode operation
		    try {

				// Decoding
				$response = json_decode($response_json);

				// Check for success
				if('success' === $response->result) {

					// YOUR APPLICATION CODE HERE, e.g.
					$rate = $response->conversion_rates->USD;

				}

		    }
		    catch(Exception $e) {
		        echo "API ERROR";
		    }

		}
        ?>

		<title>Refund Requests</title>

		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="icon" type="image/png" href="images/icons/icon.png"/>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <link rel="stylesheet" href="refund.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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

	        <nav class="menu">
	        	<a href="#refund"><i class="fa fa-money"> Refunds</i></a>
	        	<a href="#collect"><i class="fa fa-handshake-o"> Collect</i></a>
	        	<a href="#completed"><i class="fa fa-check"> Completed</i></a>
	        </nav>

	        <!-- Page Content -->
	        <div id="page-content-wrapper">
	            <button type="button" class="hamburger animated fadeInLeft is-closed" data-toggle="offcanvas">
	                <span class="hamb-top"></span>
	    			<span class="hamb-middle"></span>
					<span class="hamb-bottom"></span>
	            </button>
	            <div class="content">
		            <div class="container py-3">
		            	<section id="refund" class="section">
							<br>
		                	<div class="container emp-profile">
				            	<div class="row">
				                	<div class="col-md-6">
				                        <div class="profile-head">
				                        	<h4>Refund Requests</h4>
				                        </div>
				                    </div>
				                </div>
				                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="Bookings-tab">
				                    <div class="table-responsive table-borderless">
										<table class="table">
										  	<thead>
										      	<tr>
										        	<th scope="col"></th>
										        	<th scope="col">Customer Name</th>
										        	<th scope="col">Booked Date/Time</th>
										        	<th scope="col">Canceled Date/Time</th>
										      	</tr>
										    </thead>
										    <?php
										    	$sql3 = "select * from refund INNER JOIN customer ON customer.customer_id = refund.customer_id OR customer.login_id = refund.login_id where refund.admin_approval ='No' ORDER BY refund.refund_id DESC;";
										        $result3 = mysqli_query($conn, $sql3);

										        if(mysqli_num_rows($result3) > 0)
										        {
										            $num = 1;
										            while($refund = mysqli_fetch_array($result3))
	                								{
	                									$refundOBJ = new refund();
	                									$refundLKR = $refundOBJ->eligibleAmount($refund["booked_date"],$refund["dateStamp"],$refund["total_lkr"]);
	                									$refundUSD = $refundLKR*$rate;
	                									$refundUSD = round($refundUSD, 2);
											?>
											<tbody>
												<tr class="accordion-toggle collapsed" id="accordion<?php echo $num ?>" data-toggle="collapse" data-parent="#accordion<?php echo $num ?>" href="#collapse<?php echo $num ?>">
													<td class="expand-button"></td>
													<td><?php echo $refund["f_name"] ?> <?php echo $refund["l_name"];?></td>
													<td><?php echo substr($refund["booked_date"], 0, 10)?> / <?php echo date("H:i",strtotime($refund["booked_date"]));?></td>
													<td><?php echo substr($refund["dateStamp"], 0, 10)?> / <?php echo date("H:i",strtotime($refund["dateStamp"]));?></td>
												</tr>
												<tr class="hide-table-padding">
													<td></td>
													<td colspan="3">
													<div id="collapse<?php echo $num ?>" class="collapse in p-3">
														<hr>
														<div class="row">
															<div class="col-6">Payment</div>
															<div class="col-6">: Rs.<?php echo $refund["total_lkr"]; ?></div>
														</div>
														<div class="row">
															<div class="col-6">Invoice</div>
															<div class="col-6">: 
																<a href="printPDF.php?payment_id=<?php echo $refund["payment_id"]; ?>"target="_blank"><?php echo $refund["payment_id"]; ?></a>
															</div>
														</div>
														<div class="row">
															<div class="col-6">Eligible Refund LKR</div>
															<div class="col-6">: Rs.<?php echo $refundLKR; ?></div>
															<div class="col-6">Eligible Refund USD</div>
															<div class="col-6">: <?php echo $refundUSD; ?>$</div>
														</div>
														<div class="row">
															<div class="col-6">PayPal E-Mail</div>
															<div class="col-6">: <?php echo $refund["paying_email"]; ?></div>
														</div>
														<div class="row">
															<div class="col-6">Full Refund</div>
															<div class="col-6">
																<form action="submitRefund.php?refund_id=<?php echo $refund["refund_id"] ?>&refundLKR=<?php echo $refundLKR ?>&refundUSD=<?php echo $refundUSD ?>" method="post">
																: <input type="radio" id="fullR" name="fullR" value="1">
															</div>
														</div>
														<hr>
														<button type="submit" id="submit" class="checkout" >Confirm Refund</button>
														</form>
														<?php
														if ($refund["paying_email"]!="Cash")
														{
														?>
															<a href="https://www.sandbox.paypal.com/listing/transactions" target="_blank"><button type="submit" id="submit" class="checkout" >Redirect to Paypal</button></a>
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
				        	</div>
						</section>
					</div>
					<br>
					<section id="collect" class="section">
						<div class="upContain">
							<div class="row">
							    <div class="panel panel-primary filterable">
							        <div class="panel-heading">
							            <h3 class="panel-title">Authorized Refunds for Collecting.</h3>
							            <div class="pull-right">
							                <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
							            </div>
							        </div>
							        <br>
							        <table class="table">
							            <thead>
							                <tr class="filters">
							                    <th><input type="text" class="form-control" placeholder="Invoice #" disabled></th>
							                    <th><input type="text" class="form-control" placeholder="C Name" disabled></th>
							                    <th><input type="text" class="form-control" placeholder="C Mobile" disabled></th>
							                    <th><input type="text" class="form-control" placeholder="Booked Date/Time" disabled></th>
							                    <th><input type="text" class="form-control" placeholder="Canceled Date/Time" disabled></th>
							                    <th><input type="text" class="form-control" placeholder="Payment" disabled></th>
							                    <th><input type="text" class="form-control" placeholder="Eligible Refund" disabled></th>
							                    <th style="font-weight:700; font-size:18px">Confirm</th>
							                </tr>
							            </thead>
							            <tbody>
							            	<?php
							                    $sql4 = "select * from refund INNER JOIN customer ON customer.customer_id = refund.customer_id where refund.admin_approval ='Yes' AND refund.customer_recieve IS NULL ORDER BY refund.refund_id DESC;";
							                    $result4 = mysqli_query($conn, $sql4);
							                    if(mysqli_num_rows($result4) > 0)
							                    {
							                        while($row = mysqli_fetch_array($result4))
							                    	{
								                    ?>
									                    <tr>
									                        <td><a href="printPDF.php?payment_id=<?php echo $row["payment_id"]; ?>"target="_blank"><?php echo $row["payment_id"]; ?></a></td>
									                        <td><?php echo $row["f_name"]; ?> <?php echo $row["l_name"]; ?></td>
									                        <td>0<?php echo $row["tel_no"]; ?></td>
									                        <td><?php echo $row["booked_date"]; ?></td>
									                        <td><?php echo $row["dateStamp"]; ?></td>
									                        <td>Rs.<?php echo $row["total_lkr"]; ?></td>
									                        <td>Rs.<?php echo $row["refund_amount"]; ?></td>
									                        <td>
									                        	<center>
															        <a href="refundCom.php?rID=<?php echo $row["refund_id"]; ?>"><button class="checkout"><b>Confirm</b></button></a>
															    </center>
									                        </td>
									                    </tr>
							            		<?php
							                    	}
							                    }
							                    else
							                    {
							                    ?>
							                    <tr>
								                    <td>No Data</td>
								                </tr>
								                <?php
							                    }
							                    ?>
							            </tbody>
							        </table>
							    </div>
							</div>
						</div>
					</section>
					<section id="completed" class="section">
						<div class="upContain">
						    <div class="row">
						        <div class="panel panel-primary filterable">
						            <div class="panel-heading">
						                <h3 class="panel-title">Refunds History</h3>
						                <div class="pull-right">
						                    <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
						                </div>
						            </div>
						            <br>
						            <table class="table">
						                <thead>
						                    <tr class="filters">
							                    <th><input type="text" class="form-control" placeholder="Invoice #" disabled></th>
							                    <th><input type="text" class="form-control" placeholder="C Name" disabled></th>
							                    <th><input type="text" class="form-control" placeholder="C Mobile" disabled></th>
							                    <th><input type="text" class="form-control" placeholder="Booked Date/Time" disabled></th>
							                    <th><input type="text" class="form-control" placeholder="Canceled Date/Time" disabled></th>
							                    <th><input type="text" class="form-control" placeholder="Payment" disabled></th>
							                    <th><input type="text" class="form-control" placeholder="Eligible Refund" disabled></th>
						                    </tr>
						                </thead>
						                <tbody>

						            		<?php
						                        $sql5 = "select * from refund INNER JOIN customer ON customer.customer_id = refund.customer_id OR customer.login_id = refund.login_id where refund.admin_approval ='Yes' AND refund.customer_recieve IS NOT NULL ORDER BY refund.refund_id DESC;";
						                        $result5 = mysqli_query($conn, $sql5);
						                        if(mysqli_num_rows($result5) > 0)
						                        {
						                            while($row5 = mysqli_fetch_array($result5))
						                            {
						                    ?>
									                    <tr>
									                        <td><a href="printPDF.php?payment_id=<?php echo $row5["payment_id"]; ?>"target="_blank"><?php echo $row5["payment_id"]; ?></a></td>
									                        <td><?php echo $row5["f_name"]; ?> <?php echo $row5["l_name"]; ?></td>
									                        <td>0<?php echo $row5["tel_no"]; ?></td>
									                        <td><?php echo $row5["booked_date"]; ?></td>
									                        <td><?php echo $row5["dateStamp"]; ?></td>
									                        <td>Rs.<?php echo $row5["total_lkr"]; ?></td>
									                        <td>Rs.<?php echo $row5["refund_amount"]; ?></td>
									                    </tr>
						            			<?php
						                            }
						                        }
						                        else
						                        {
						                        ?>
						                        	<tr>
							                        <td>No Data</td>
							                    	</tr>
							                    <?php
						                        }
						                    ?>
						                </tbody>
						            </table>
						        </div>
						    </div>
						</div>
					</section>
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