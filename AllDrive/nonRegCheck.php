<?php
    session_start();
    $bookingInfo = $_SESSION['arr'];
    $paymentInfo = $_SESSION['arr2'];

    $_SESSION['arr2'] = $paymentInfo;
    $_SESSION['arr'] = $bookingInfo;

    include('DBconnection.php');
    include ('LoginCheck.php');
    include('payment_id.php');
    $Vid = $_GET['Vid'];
    $VidLink ="?Vid=$Vid";

    if(!empty($_POST['firstname'] && $_POST['lastname'] && $_POST['email'] && $_POST['tel'] && $_POST['address']))
    {
        $f_name = $_POST['firstname'];
        $l_name = $_POST['lastname'];
        $email = $_POST['email'];
        $tel = $_POST['tel'];
        $address = $_POST['address'];

        $userInfo=array($f_name,$l_name,$email,$tel,$address);
        $_SESSION['arr3'] = $userInfo;
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

        <script src="PopM.js"></script>
        <link rel="icon" href="Images/Common/icon.png">
        <title>Checkout</title>

        <link rel="stylesheet" href="UserinfoStyle.css">
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
                                    <form action="login.php?Page=SelectVehicle.php'.$VidLink.'" method="post">
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

<!-- Checkout Fill -->
                <div class="col-md-4" style="margin:0 auto;">
                	<div class="container">
						<br><h4>Total Price <span class="price" style="color:black"><i class="fa fa-shopping-cart"></i></span></h4><br>
						<p>Rent For Days :</a> <span class="price">Rs.<?php echo $paymentInfo[0]; ?></span></p>
						<p>Rent For Distance :</a> <span class="price">Rs.<?php echo $paymentInfo[1]; ?></span></p>
						<p>Rent For Driver :</a> <span class="price">Rs.<?php echo $paymentInfo[2]; ?></span></p>
		      			<hr>
		      			<p>Total <span class="price" style="color:black"><b>Rs.<?php echo $bookingInfo[7]; ?></b></span></p>
                        <hr>
                        <p>Total in USD <span class="price" style="color:black"><b><?php echo $bookingInfo[8]; ?>$</b></span></p>
                        <hr>
                        <p><center>By confirming payment you are agreeing to our <a href="terms.php" target="_blank">Terms and Conditions.</a></center></p>
                        <div id="paypal-button-container"></div>
		    		</div>
		  		</div>
                <br><br>
                <div class="text-center">
                    <img src="Images/banner.jpg" class="rounded" alt="banner" style = "width:95%; max-width:700px">
                </div>';

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
                    <a href="terms.php"> T&C</a>
                    </p>
                    <p class="name"> AllDrive &copy; 2020</p>
                </div>
            </footer>
        </div>
        <script
        src="https://www.paypal.com/sdk/js?client-id=AVREeYMBt8XIn7aeaaH6OEUMeiWcveqNgpwWzeOCq0YIJAiKomOXLI4--U8EVTRM6rdFRfzfuOeRDKxL&disable-funding=credit,card">
        </script>
        <script>
            paypal.Buttons({
                style:{
                    color:'blue',
                    shape:'pill'
                },
                createOrder:function(data,actions){
                    return actions.order.create({
                        purchase_units:[{
                            amount:{
                                value:'<?php echo $bookingInfo[8]; ?>'
                            }
                        }]
                    });
                },
                onApprove:function(data,actions){
                    return actions.order.capture().then(function(details){
                        var status =(details.status)
                        if(status=="COMPLETED")
                        {
                            var payEmail = (details.payer.email_address)
                            window.location.href="success.php?mail="+payEmail;
                        }
                        else
                        {
                            Swal.fire
                            ({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something Went Wrong.',
                                confirmButtonColor: '#31bfb1',
                                allowOutsideClick: false,
                            })
                                .then((result) => 
                            {
                                if (result.isConfirmed) 
                                {
                                    window.location.href = "SelectVehicle.php?Vid=<?php echo($Vid) ?>";
                                }
                            })
                        }

                    })
                },onCancel:function(data){
                    window.location.href="SelectVehicle.php?Vid=<?php echo($Vid) ?>"
                }
            }).render('#paypal-button-container');
        </script>
    </body>
</html>