<?php
    ignore_user_abort(true);
    session_start();
    if (!isset($_SESSION['admin_id'])) 
    {
        header('location:index.php');
    }
    include('DBconnection.php');
    include('payment_id.php');
    $Vid = $_GET['Vid'];
    $VidLink ="?Vid=$Vid";

	if (!empty($_POST))
    {

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

        $date=$_POST['Pickdate'];
        $Returndate=$_POST['Returndate'];
        $time=$_POST['Picktime'];
        $location=$_POST['location'];
        $distance=$_POST['distance'];
	    $driver = isset($_POST['driver'][1]) ? 1 : 0;

        $start_date = strtotime($date); 
        $end_date = strtotime($Returndate); 
        $days=1+($end_date - $start_date)/60/60/24;

	    $sql = "select * from vehicle where vehicle_id ='$Vid'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0)
        {
            $row = mysqli_fetch_array($result);

            $day_price=$row['day_price'];
            $km_price=$row['km_price'];
        }

        $priceDay=$days*$day_price;
	    $priceDis=$distance*$km_price;
	    if($driver==1)
	    {
	    	$priceDriv=1300*$days;
	    }
	    else
	    {
	    	$priceDriv=0;
	    }
	    $totalLKR=($priceDay+$priceDis+$priceDriv);
        $totalUSD=($priceDay+$priceDis+$priceDriv)*$rate;
        $USDround=round($totalUSD,2);
	    $bookingInfo=array($date,$time,$location,$days,$distance,$driver,$Vid,$totalLKR,$USDround);

        $paymentInfo=array($priceDay,$priceDis,$priceDriv);

        $_SESSION['arr'] = $bookingInfo;
        $_SESSION['arr2'] = $paymentInfo;

    }
?>
<!DOCTYPE html>
<html>
<head>
	<!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald:300,400|Roboto:300,400,700">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Varela+Round">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

        <link rel="icon" href="images/Common/icon.png">
        <title>Admin - Checkout</title>
        <script src="UserinfoJS.js"></script>
        <script src="PopM.js"></script>

        <link rel="stylesheet" href="UserinfoStyle.css">
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

<!-- Checkout Fill -->

            <div class="container-lg">
		        <div class="row">
		  			<div class="col-75">
		    			<div class="container">
		      				<form action="nonRegCheck.php" method="post">
		      
		        				<div class="row">
		          					<div class="col-50">
		            					<h3>Enter Your Information</h3><br>
		            					<label for="fname"><i class="fa fa-user"></i> Full Name</label>
		            					<input type="text" id="f_name" name="firstname" placeholder="First name" required="required">
		            					<input type="text" id="l_name" name="lastname" placeholder="Last name" required="required">
		           						<label for="email"><i class="fa fa-envelope"></i> Email</label>
		            					<input type="email" id="email" name="email" placeholder="E-Mail" required="required">
		            					<label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
		            					<input type="text" id="adr" name="address" placeholder="Address" required="required">
		            					<label for="tel"><i class="fa fa-phone"></i> Mobile Number</label>
		            					<input type="tel" id="tel" name="tel" placeholder="Mobile Number" maxlength="10" required="required" pattern="^\d{10}$">
		          					</div>
		        				</div>
                                <button type="submit" id="submit" class="checkout" >Confirm Booking</button>
		      				</form>
		    			</div>
		  			</div>
		  			<div class="col-25">
		    			<div class="container">
						    <br><h4>Total Price <span class="price" style="color:black"><i class="fa fa-shopping-cart"></i></span></h4><br>
						    <p>Rent For Days :</a> <span class="price">Rs.<?php echo $priceDay ?></span></p>
						   	<p>Rent For Distance :</a> <span class="price">Rs.<?php echo $priceDis ?></span></p>
						   	<p>Rent For Driver :</a> <span class="price">Rs.<?php echo $priceDriv ?></span></p>
		      				<hr>
		      				<p>Total <span class="price" style="color:black"><b>Rs.<?php echo $totalLKR ?></b></span></p>
                            <hr>
                            <p>Total in USD <span class="price" style="color:black"><b><?php echo $USDround ?>$</b></span></p>
		    			</div>
		  			</div>
				</div>
			</div>

            <div class="text-center">
                <br><br><br>
                    <img src="images/banner.jpg" class="rounded" alt="banner" style = "width:95%; max-width:700px">
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