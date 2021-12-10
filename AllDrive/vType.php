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

		<link rel="stylesheet" href="vType.css">

		<script src="vType.js"></script>
    	<script src="PopM.js"></script>
    	<link rel="icon" href="Images/Common/icon.png">
    	<title>AllDrive - Vehicles</title>

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
                        echo
                        ('<div class="navbar-nav ml-auto action-buttons">
                            <div class="nav-item dropdown">
                                <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle mr-4" style="color:white">Login</a>
                                <div class="dropdown-menu action-form">
                                    <form action="login.php?Page=vType.php" method="post">
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
                        <a href="profile.php" class="nav-item nav-link mr-4" style="color:white">View Profile</a>

                        <!-- Log Out Button -->
                            <div class="nav-item">
                                <a href="#" onclick = "log_out_message()" class="btn btn-log log-out-btn">Log Out</a>
                            </div>
                        </div>');
                    }
                ?>
            </div>
        </nav>

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
          				<img src="Images/Categories/Luxury2.png" alt="cars-image" />
          				<figcaption>
            				<h2>Luxury <span>Cars</span></h2>
            				<h3>Book Now</h3>
          				</figcaption>
          				<a href="Vehicles.php?Category=Luxury Car" class="link"></a>
        			</figure>
                    <figure class="snip1560">
                        <img src="Images/Categories/Wedding2.png" alt="Wedding_cars-image" />
                        <figcaption>
                            <h2>Wedding <span>Cars</span></h2>
                            <h3>Book Now</h3>
                        </figcaption>
                        <a href="Vehicles.php?Category=Wedding Car" class="link"></a>
                    </figure>
                    <figure class="snip1560">
                        <img src="Images/Categories/sedan2.png" alt="Sedan_cars-image" />
                        <figcaption>
                            <h2>Sedan <span>Cars</span></h2>
                            <h3>Book Now</h3>
                        </figcaption>
                        <a href="Vehicles.php?Category=Sedan Car" class="link"></a>
                    </figure>
        			<figure class="snip1560">
                        <img src="Images/Categories/bike2.png" alt="Bikes-image" />
        			  	<figcaption>
        			    	<h2>Motor <span>Bikes</span></h2>
        			    	<h3>Book Now</h3>
        			  	</figcaption>
        			  	<a href="Vehicles.php?Category=Motor Bike" class="link"></a>
        			</figure>
        			<figure class="snip1560">
                        <img src="Images/Categories/tuk2.png" alt="Tuks-image" />
          				<figcaption>
            				<h2>Tuk <span>Tuks</span></h2>
            				<h3>Book Now</h3>
          				</figcaption>
          			<a href="Vehicles.php?Category=Tuk Tuk" class="link"></a>
        			</figure>
        			<figure class="snip1560">
                        <img src="Images/Categories/heavy2.png" alt="Heavy-image" />
        			  	<figcaption>
        			    	<h2>Heavy <span>Vehicles</span></h2>
        			    	<h3>Book Now</h3>
        			  	</figcaption>
        			  	<a href="Vehicles.php?Category=Heavy Vehicle" class="link"></a>
        			</figure>
        			<figure class="snip1560">
                        <img src="Images/Categories/van2.png" alt="Vans-image" />
          				<figcaption>
            				<h2>Vans</h2>
            				<h3>Book Now</h3>
          				</figcaption>
          			<a href="Vehicles.php?Category=Van" class="link"></a>
        			</figure>
        			<figure class="snip1560">
                        <img src="Images/Categories/bus2.png" alt="Busses-image" />
        			  	<figcaption>
        			    	<h2>Busses</h2>
        			    	<h3>Book Now</h3>
        			  	</figcaption>
        			  	<a href="Vehicles.php?Category=Bus" class="link"></a>
        			</figure>
        			<figure class="snip1560">
                        <img src="Images/Categories/jeep2.png" alt="Jeeps-image" />
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