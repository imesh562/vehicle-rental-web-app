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
        $vehID = $_GET['vehID'];
        ?>

		<title>Update Vehicles</title>

		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="icon" type="image/png" href="images/icons/icon.png"/>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <link rel="stylesheet" href="MVehiclesCSS.css">
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
	                <section id="addVehicles" class="section">
                	    <div class="addVehicles-form">
                            <br>

                            <?php
                                $sql = "select * from vehicle where vehicle_id = '$vehID' limit 1;";
                                $result = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_array($result);
                            ?>

                            <br>
                            <form action="update_VehCode.php?vehID=<?php echo $row["vehicle_id"]; ?>" method="post" enctype="multipart/form-data">
                                <h2>Update Vehicle</h2>
                                <p class="hint-text">Update the follwing details.</p>
                                <div class="form-group">
                                    <div class="row">
                                        <p>Vehicle Name</p>
                                        <div class="col"><input type="text" class="form-control" name="vehicle_name" placeholder="Vehicle Name" value="<?php echo $row["vehicle_name"]; ?>" required="required"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <p>Vehicle Type</p>
                                        <div class="col"><input type="text" class="form-control" name="vehicle_type" placeholder="Vehicle Type" value="<?php echo $row["vehicle_type"]; ?>" required="required"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <p>License #</p>
                                        <div class="col"><input type="text" class="form-control" name="license_no" placeholder="License #" value="<?php echo $row["license_no"]; ?>" required="required"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <p>Price For a Day (Rs.)</p>
                                        <div class="col"><input type="number" class="form-control" name="day_price" placeholder="Price For a Day" value="<?php echo $row["day_price"]; ?>" required="required"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <p>Price for a KM (Rs.)</p>
                                        <div class="col"><input type="number" class="form-control" name="km_price" placeholder="Price for a KM" value="<?php echo $row["km_price"]; ?>" required="required"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    Description
                                    <input type="text" class="form-control" name="description_1" placeholder="Description-Line 1" value="<?php echo $row["description_1"]; ?>" required="required">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="description_2" placeholder="Description-Line 2" value="<?php echo $row["description_2"]; ?>" required="required">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="description_3" placeholder="Description-Line 3" value="<?php echo $row["description_3"]; ?>" required="required">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="description_4" placeholder="Description-Line 4" value="<?php echo $row["description_4"]; ?>" required="required">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="description_5" placeholder="Description-Line 5" value="<?php echo $row["description_5"]; ?>" required="required">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="description_6" placeholder="Description-Line 6" value="<?php echo $row["description_6"]; ?>" required="required">
                                </div>
                                <button type="submit" id="submit" class="btn btn-success btn-lg btn-block" >Submit</button>
                            </form>
                        </div>
	            	</section>
	            	<section id="ServiceVehicle" class="section">
	            		<br><br><br><br>
                        <div class="addVehicles-form">
                                <form action="service.php?vehID=<?php echo $row["vehicle_id"]; ?>" method="post">

                                    <H4 class="hint">Fill Out Following Information For a Vehicle Service reservation.</H4>
                                    <br>
                                    <?php
                                        $sql = "select * from booking where vehicle_id ='$vehID'";
                                        $result = mysqli_query($conn, $sql);
                                        if(mysqli_num_rows($result) > 0)
                                        {
                                            while ($row = mysqli_fetch_array($result)) 
                                            {
                                                $bookedDates = $row["booked_period"];
                                                $bookedDates = $bookedDates +1;
                                                ?>
                                                    <script>
                                                        var disableddates = new Array();
                                                        for (var i = 0; i < <?php echo $bookedDates ?>; i++)
                                                        {
                                                            let date = new Date("<?php echo $row["pickup_date"]; ?>");
                                                            date.setDate(date.getDate() + i);

                                                            dbdate = date.toISOString();
                                                            disableddates [i] = [dbdate];
                                                        }

                                                            var greydates = greydates + disableddates.toString();
                                                            console.log(greydates);

                                                            function DisableSpecificDates(Pickdate) {
                                                                var string = jQuery.datepicker.formatDate('yy-mm-dd', Pickdate);
                                                                return [greydates.indexOf(string) == -1];
                                                            }

                                                            $(function() {
                                                            $("#Pickdate").datepicker({
                                                                minDate:1,
                                                                maxDate:31,
                                                                dateFormat: 'yy-mm-dd',
                                                                beforeShowDay: DisableSpecificDates,
                                                                onSelect: function(date)
                                                                {

                                                                    var selectedDate = new Date(date);
                                                                    var startdate = new Date(selectedDate.getTime());
                                                                    var msecsInADay = 86400000;
                                                                    var enddate = new Date(selectedDate.getTime() + (msecsInADay * 6));

                                                                   //Set Minimum Date of EndDatePicker After Selected Date of StartDatePicker
                                                                    $("#Returndate").datepicker( "option", "minDate", startdate );
                                                                    $("#Returndate").datepicker( "option", "maxDate", enddate );
                                                                }
                                                            });
                                                            });

                                                            $(function() {
                                                            $("#Returndate").datepicker({
                                                                minDate:1,
                                                                maxDate:31,
                                                                dateFormat: 'yy-mm-dd',
                                                                beforeShowDay: DisableSpecificDates
                                                            });
                                                            });
                                                    </script>
                                        <?php
                                            }
                                        }
                                        else
                                        {
                                            ?>
                                            <script>
                                            $(function() {
                                            $("#Pickdate").datepicker({
                                                minDate:1,
                                                maxDate:31,
                                                dateFormat: 'yy-mm-dd',
                                                onSelect: function(date)
                                                {

                                                    var selectedDate = new Date(date);
                                                    var startdate = new Date(selectedDate.getTime());
                                                    var msecsInADay = 86400000;
                                                    var enddate = new Date(selectedDate.getTime() + (msecsInADay * 6));

                                                    //Set Minimum Date of EndDatePicker After Selected Date of StartDatePicker
                                                    $("#Returndate").datepicker( "option", "minDate", startdate );
                                                    $("#Returndate").datepicker( "option", "maxDate", enddate );
                                                }
                                            });
                                            });

                                            $(function() {
                                            $("#Returndate").datepicker({
                                                minDate:1,
                                                maxDate:31,
                                                dateFormat: 'yy-mm-dd',
                                            });
                                            });
                                            </script>
                                        <?php
                                        }
                                        ?>

                                        <script>
                                            $(document).ready(function(){
                                                $('#Picktime').timepicker({
                                                    minTime: '06:00 AM',
                                                    maxTime: '08:00 PM',
                                                });
                                            });
                                        </script>
                                    <center>
                                        <div class="form-group">
                                            <label for="Pickdate">Select a Service Date : </label>
                                            <input autocomplete="off" type="text" id="Pickdate" name="Pickdate" required="required">
                                        </div>

                                        <div class="form-group">
                                            <label for="Returndate">Select a Return Date : </label>
                                            <input autocomplete="off" type="text" id="Returndate" name="Returndate" required="required">
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" id="submit" class="btn btn-success btn-lg" >Submit</button>
                                        </div>
                                    </center>
                                </form>
                        </div>
                        <br>
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