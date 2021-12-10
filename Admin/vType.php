<?php
    session_start();
    if (!isset($_SESSION['admin_id'])) 
        {
            header('location:index.php');
        }
        else
        {
            $id=$_SESSION['admin_id'];
        }
    include('DBconnection.php');
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

		<link rel="stylesheet" href="vType.css">

		<script src="vType.js"></script>
        <script src="PopM.js"></script>
    	<link rel="icon" href="images/Common/icon.png">
    	<title>Admin - Category</title>

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

        <!-- Category Cards Start -->

            <div class="container-lg d-flex justify-content-center">
                    <div class="col-md-12">
                        <div class = "categories">
        			        <br>
                			<br>
                			<div class="title h3 text-center" style="color:white">Select Vehicle Category For Booking.</div>
                			<br>
                			<br>
                        	<figure class="snip1560">
                  				<img src="images/Categories/Luxury2.png" alt="cars-image" />
                  				<figcaption>
                    				<h2>Luxury <span>Cars</span></h2>
                    				<h3>Book Now</h3>
                  				</figcaption>
                  				<a href="Vehicles.php?Category=Luxury Car" class="link"></a>
                			</figure>
                            <figure class="snip1560">
                                <img src="images/Categories/Wedding2.png" alt="Wedding_cars-image" />
                                <figcaption>
                                    <h2>Wedding <span>Cars</span></h2>
                                    <h3>Book Now</h3>
                                </figcaption>
                                <a href="Vehicles.php?Category=Wedding Car" class="link"></a>
                            </figure>
                            <figure class="snip1560">
                                <img src="images/Categories/sedan2.png" alt="Sedan_cars-image" />
                                <figcaption>
                                    <h2>Sedan <span>Cars</span></h2>
                                    <h3>Book Now</h3>
                                </figcaption>
                                <a href="Vehicles.php?Category=Sedan Car" class="link"></a>
                            </figure>
                			<figure class="snip1560">
                                <img src="images/Categories/bike2.png" alt="Bikes-image" />
                			  	<figcaption>
                			    	<h2>Motor <span>Bikes</span></h2>
                			    	<h3>Book Now</h3>
                			  	</figcaption>
                			  	<a href="Vehicles.php?Category=Motor Bike" class="link"></a>
                			</figure>
                			<figure class="snip1560">
                                <img src="images/Categories/tuk2.png" alt="Tuks-image" />
                  				<figcaption>
                    				<h2>Tuk <span>Tuks</span></h2>
                    				<h3>Book Now</h3>
                  				</figcaption>
                  			<a href="Vehicles.php?Category=Tuk Tuk" class="link"></a>
                			</figure>
                			<figure class="snip1560">
                                <img src="images/Categories/heavy2.png" alt="Heavy-image" />
                			  	<figcaption>
                			    	<h2>Heavy <span>Vehicles</span></h2>
                			    	<h3>Book Now</h3>
                			  	</figcaption>
                			  	<a href="Vehicles.php?Category=Heavy Vehicle" class="link"></a>
                			</figure>
                			<figure class="snip1560">
                                <img src="images/Categories/van2.png" alt="Vans-image" />
                  				<figcaption>
                    				<h2>Vans</h2>
                    				<h3>Book Now</h3>
                  				</figcaption>
                  			<a href="Vehicles.php?Category=Van" class="link"></a>
                			</figure>
                			<figure class="snip1560">
                                <img src="images/Categories/bus2.png" alt="Busses-image" />
                			  	<figcaption>
                			    	<h2>Busses</h2>
                			    	<h3>Book Now</h3>
                			  	</figcaption>
                			  	<a href="Vehicles.php?Category=Bus" class="link"></a>
                			</figure>
                			<figure class="snip1560">
                                <img src="images/Categories/jeep2.png" alt="Jeeps-image" />
                  				<figcaption>
                    				<h2>Jeeps</h2>
                    				<h3>Book Now</h3>
                  				</figcaption>
                  			<a href="Vehicles.php?Category=Jeep" class="link"></a>
                			</figure>
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