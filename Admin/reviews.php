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

		<title>Manage Reviews</title>

		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="icon" type="image/png" href="images/icons/icon.png"/>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <link rel="stylesheet" href="reviewStyle.css">
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

	        <!-- Page Content -->
	        <div id="page-content-wrapper">
	            <button type="button" class="hamburger animated fadeInLeft is-closed" data-toggle="offcanvas">
	                <span class="hamb-top"></span>
	    			<span class="hamb-middle"></span>
					<span class="hamb-bottom"></span>
	            </button>
	            <div class="container">
	            	<section id="nReviews" class="section">

						<div class="upContain">
						    <div class="row">
						        <div class="panel panel-primary filterable">
						            <div class="panel-heading">
						                <h3 class="panel-title">New Reviews</h3>
						                <div class="pull-right">
						                    <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
						                </div>
						            </div>
						            <br>
						            <table class="table">
						                <thead>
						                    <tr class="filters">
						                        <th><input type="text" class="form-control" placeholder="Date" disabled></th>
						                        <th><input type="text" class="form-control" placeholder="Customer Name" disabled></th>
						                        <th><input type="text" class="form-control" placeholder="Vehicle Name" disabled></th>
						                        <th><input type="text" class="form-control" placeholder="Content" disabled></th>
						                        <th style="font-weight:700; font-size:18px">Confirm/Cancel</th>
						                    </tr>
						                </thead>
						                <tbody>

						            		<?php
						                        $sql2 = "select * from reviews INNER JOIN customer ON customer.login_id = reviews.login_id INNER JOIN vehicle ON vehicle.vehicle_id = reviews.vehicle_id where reviews.approval IS NULL ORDER BY reviews.review_id DESC;";
						                        $result2 = mysqli_query($conn, $sql2);
						                        if(mysqli_num_rows($result2) > 0)
						                        {
						                            while($row2 = mysqli_fetch_array($result2))
						                            {
						                    ?>
							                    <tr>
							                        <td><?php echo substr($row2["Date"], 0, 10) ?></td>
							                        <td><?php echo $row2["f_name"]; ?> <?php echo $row2["l_name"]; ?></td>
							                        <td><?php echo $row2["vehicle_name"]; ?></td>
							                        <td><?php echo $row2["content"]; ?></td>
							                        <td>
							                        	<center>
							                        		<a href="confirmReview.php?reviewID=<?php echo $row2["review_id"]; ?>" class ="btn-check"><i class="fa fa-check"></i></a>
							                        		<a href="#" onclick="cancelReview_button(<?php echo $row2["review_id"]; ?>)" class ="btn-close"><i class="fa fa-close"></i></a>
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
					<section id="hReviews" class="section">

						<div class="upContain">
						    <div class="row">
						        <div class="panel panel-primary filterable">
						            <div class="panel-heading">
						                <h3 class="panel-title">Review History</h3>
						                <div class="pull-right">
						                    <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
						                </div>
						            </div>
						            <br>
						            <table class="table">
						                <thead>
						                    <tr class="filters">
						                        <th><input type="text" class="form-control" placeholder="Date" disabled></th>
						                        <th><input type="text" class="form-control" placeholder="Customer Name" disabled></th>
						                        <th><input type="text" class="form-control" placeholder="Vehicle Name" disabled></th>
						                        <th><input type="text" class="form-control" placeholder="Content" disabled></th>
						                        <th><input type="text" class="form-control" placeholder="Status" disabled></th>
						                        <th style="font-weight:700; font-size:18px">Confirm/Cancel</th>
						                    </tr>
						                </thead>
						                <tbody>

						            		<?php
						                        $sql = "select * from reviews INNER JOIN customer ON customer.login_id = reviews.login_id INNER JOIN vehicle ON vehicle.vehicle_id = reviews.vehicle_id where reviews.approval IS NOT NULL ORDER BY reviews.review_id DESC;";
						                        $result = mysqli_query($conn, $sql);
						                        if(mysqli_num_rows($result) > 0)
						                        {
						                            while($row = mysqli_fetch_array($result))
						                            {
						                    ?>
							                    <tr>
							                        <td><?php echo substr($row["Date"], 0, 10) ?></td>
							                        <td><?php echo $row["f_name"]; ?> <?php echo $row["l_name"]; ?></td>
							                        <td><?php echo $row["vehicle_name"]; ?></td>
							                        <?php
							                        if ($row["approval"]==1) 
							                        {
							                        	echo "<td>Approved</td>";
							                        }
							                        elseif ($row["approval"]==0) 
							                        {
							                        	echo "<td>Cancelled</td>";
							                        }
							                        ?>
							                        <td><?php echo $row["content"]; ?></td>
							                        <td>
							                        	<center>
							                        		<?php
									                        if ($row["approval"]==1) 
									                        {
									                        ?>
									                        	<a href="#" onclick="cancelReview_button(<?php echo $row["review_id"]; ?>)" class ="btn-close"><i class="fa fa-close"></i></a>
									                        <?php
									                        }
									                        elseif ($row["approval"]==0) 
									                        {
									                        ?>
									                        	<a href="confirmReview.php?reviewID=<?php echo $row["review_id"]; ?>" class ="btn-check"><i class="fa fa-check"></i></a>
									                        <?php
									                        }
									                        ?>
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