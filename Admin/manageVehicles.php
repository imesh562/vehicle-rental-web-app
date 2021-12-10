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

		<title>Manage Vehicles</title>

		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="icon" type="image/png" href="images/icons/icon.png"/>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <link rel="stylesheet" href="MVehiclesCSS.css">
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
	            <div class="content">
	                <section id="addVehicles" class="section">
                	    <div class="addVehicles-form">
                            <br>
                            <br>
                            <form action="add_Vehicle.php" method="post" enctype="multipart/form-data">
                                <h2>Add New Vehicle</h2>
                                <p class="hint-text">Fill in the follwing details.</p>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="vehicle_name" placeholder="Vehicle Name" required="required">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col"><input type="text" class="form-control" name="vehicle_type" placeholder="Vehicle Type" required="required"></div>
                                        <div class="col"><h5>Upload Images</h5></div>
                                    </div> 
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col"><input type="text" class="form-control" name="license_no" placeholder="License #" required="required"></div>
                                        <div class="col"><input type="file" name="image_1" class="form-control" required="required" placeholder="Image 1"></div>
                                    </div> 
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col"><input type="number" class="form-control" name="day_price" placeholder="Price For a Day" required="required"></div>
                                        <div class="col"><input type="file" name="image_2" class="form-control" required="required" placeholder="Image 2"></div>
                                    </div> 
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col"><input type="number" class="form-control" name="km_price" placeholder="Price for a KM" required="required"></div>
                                        <div class="col"><input type="file" name="image_3" class="form-control" required="required" placeholder="Image 3"></div>
                                    </div> 
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="description_1" placeholder="Description-Line 1" required="required">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="description_2" placeholder="Description-Line 2" required="required">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="description_3" placeholder="Description-Line 3" required="required">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="description_4" placeholder="Description-Line 4" required="required">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="description_5" placeholder="Description-Line 5" required="required">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="description_6" placeholder="Description-Line 6" required="required">
                                </div>
                                <button type="submit" id="submit" class="btn btn-success btn-lg btn-block" >Submit</button>
                            </form>
                        </div>
	            	</section>
	            	<section id="VehiclesTable" class="section">
	            		<div class="upContain">
                            <div class="row">
                                <div class="panel panel-primary filterable">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">All Vehicles</h3>
                                        <div class="pull-right">
                                            <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                                        </div>
                                    </div>
                                    <br>
                                    <table class="table">
                                        <thead>
                                            <tr class="filters">
                                                <th><input type="text" class="form-control" placeholder="Vehicle Type" disabled></th>
                                                <th><input type="text" class="form-control" placeholder="Vehicle Name" disabled></th>
                                                <th><input type="text" class="form-control" placeholder="License #" disabled></th>
                                                <th><input type="text" class="form-control" placeholder="Day Price" disabled></th>
                                                <th><input type="text" class="form-control" placeholder="KM Price" disabled></th>
                                                <th style="font-weight:700; font-size:18px">Update/Remove</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $sql = "select * from vehicle order by vehicle_id DESC;";
                                                $result = mysqli_query($conn, $sql);
                                                if(mysqli_num_rows($result) > 0)
                                                {
                                                    while($row = mysqli_fetch_array($result))
                                                    {
                                            ?>
                                                <tr>
                                                    <td><?php echo $row["vehicle_type"]; ?></td>
                                                    <td><?php echo $row["vehicle_name"]; ?></td>
                                                    <td><?php echo $row["license_no"]; ?></td>
                                                    <td><?php echo $row["day_price"]; ?></td>
                                                    <td><?php echo $row["km_price"]; ?></td>
                                                    <td>
                                                        <center>
                                                            <a href="updateVeh.php?vehID=<?php echo $row["vehicle_id"]; ?>"><button class="btn-update"><i class="fa fa-refresh"></i></button></a>
                                                            <a href="#" onclick="remove_button(<?php echo $row["vehicle_id"]; ?>)" class ="btn-close"><i class="fa fa-close"></i></a>
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