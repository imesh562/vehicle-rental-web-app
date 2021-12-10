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

        <script src="termsjs.js"></script>
        <script src="PopM.js"></script>
        <link rel="icon" href="Images/Common/icon.png">
        <title>T&C</title>

        <link rel="stylesheet" href="termsStyle.css">

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
                                    <form action="login.php?Page=terms.php" method="post">
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

        <div class="container">
            <center><h1 style="color:#33cabb;">Terms & Conditions</h1></center><br>
            <div class="how-section1">
                <div class="row">
                    <div class="col-md-6 how-img">
                        <img src="Images/Terms/keys.png" class="rounded-circle img-fluid" alt=""/>
                    </div>
                    <div class="col-md-6">
                        <h4>Vehicle Rental Policy</h4>
                        <p class="text-muted"><ul type="cricle">
                            <li>A vehicle can only be rented for a maximum of seven days.</li>
                            <li>When renting a vehicle you have to pay for the estimated distance and days.</li>
                            <li>One of our employee will give you the vehicle keys at the pickup location.</li>
                            <li>When vehicle is booked with a driver extra cost is added to the payment.</li>
                            <li>Assigned driver can be changed on request of the customer.</li>
                            <li>Includes releveant tax payments.</li>
                        </ul>
                        </p>	
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h4>Vehicle Return Policy</h4>
                        <p class="text-muted"><ul type="cricle">
                            <li>When returning a vehicle if the estimated distance given by you is underestimated, You have to pay the balance accordingly.</li>
                            <li>When returning a vehicle if the estimated distance given by you is overestimated, We will pay you the balance accordingly</li>
                            <li>When returning a vehicle if the estimated days given by you is underestimated, You have to pay the balance accordingly.</li>
                            <li>When returning a vehicle if the estimated days given by you is overestimated, We will pay you the balance accordingly</li>
                            </ul>
                        </p>
                    </div>
                    <div class="col-md-6 how-img">
                        <img src="Images/Terms/cashkeys.png" class="rounded-circle img-fluid" alt=""/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 how-img">
                            <img src="Images/Terms/cash.png" class="rounded-circle img-fluid" alt=""/>
                    </div>
                    <div class="col-md-6">
                        <h4>Vehicle Refund Policy</h4>
                        <p class="text-muted"><ul type="cricle">
                        <li>If a booked vehicle is canceled within six hours, the full amount will be refunded.</li>
                        <li>You will get a 90% refund when a booking is canceled within  24 hours thereafter.</li>
                        <li>You will get a 75% refund when a booking is canceled on the following days.</li>
                        <li>For non registered customers can cancel a booking and request a refund by calling our hotline.</li>
                        <li>A refund will be only given when a customer request a refund or failed to show up at the pickup.</li>
                        </ul>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h4>Vehicle Damage Policy</h4>
                        <p class="text-muted"><ul type="cricle">
                            <li>If the customers reckless driving caused damages to the vehicle or third parties, Customer have to pay for the damages.</li>
                            <li>The customer has to pay for the damages valued by our inspector, Until the damages have been inspected by a certified technician if needed.</li>
                        </ul>
                        </p>
                    </div>
                    <div class="col-md-6 how-img">
                        <img src="Images/Terms/tow.png" class="rounded-circle img-fluid" alt=""/>
                    </div>
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