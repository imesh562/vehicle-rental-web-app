<?php
    session_start();
    include('DBconnection.php');
    include ('LoginCheck.php');
    include('RegProcess.php');
    include('payment_id.php');
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

        <link rel="icon" href="Images/Common/icon.png">
        <title>AllDrive - Register</title>

        <link rel="stylesheet" href="Reg_pageStyle.css">
        <script src="PopM.js"></script>
        <link rel="stylesheet" href="indexStyle.css">
        <script src="Reg_pageJS.js"></script>

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
                        echo'
                        <div class="navbar-nav ml-auto action-buttons">
                            <div class="nav-item dropdown">
                                <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle mr-4" style="color:white">Login</a>
                                <div class="dropdown-menu action-form" id="login_drop">
                                    <form action="login.php?Page=Reg_page.php" method="post">
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
                        </div>';
                    }
                    else
                    {
                        echo
                        ('<div class="navbar-nav ml-auto action-buttons">
                        <a href="#" class="nav-item nav-link mr-4" style="color:white">View Profile</a>

                        <!-- Log Out Button -->
                            <div class="nav-item">
                                <a href="#" onclick = "log_out_message()" class="btn btn-log log-out-btn">Log Out</a>
                            </div>
                        </div>');
                    }
                ?>
            </div>
        </nav>

        <!-- Form Start -->

        <div class="signup-form">
            <br>
            <br>
            <form action="Reg_page.php" method="post">
                <h2>Register</h2>
                <p class="hint-text">Create your account. It's free and only takes a minute.</p>
                <div class="form-group">
                    <div class="row">
                        <div class="col"><input type="text" class="form-control" name="first_name" placeholder="First Name" required="required"></div>
                        <div class="col"><input type="text" class="form-control" name="last_name" placeholder="Last Name" required="required"></div>
                    </div>          
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" name="email" placeholder="E-mail" required="required">
                    <div id="msg_e">
                        <?php
                        if (isset($numMail) && $numMail == 1)
                        {
                            echo '<p> This E-Mail is already registered.</p>'; 
                        }?>
                    </div>
                </div>
                <div class="form-group">
                    <input type="tel" class="form-control" name="tel" placeholder="Mobile Number" maxlength="10" required="required" pattern="^\d{10}$">
                    <div id="msg_t">
                        <?php
                        if (isset($numTel) && $numTel == 1)
                        {
                            echo '<p> This Mobile Number is already registered.</p>'; 
                        }?>
                    </div>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="Address" placeholder="Address" minlength = "6" required="required">
                </div>
                <div class="form-group" autocomplete="off">
                    <input type="text" class="form-control" name="Username" placeholder="Username" minlength = "8" maxlength = "16" required="required">
                    <div id="msg_u">
                        <?php
                        if (isset($numUN) && $numUN == 1)
                        {
                            echo '<p> Username Already Taken.</p>'; 
                        }?>
                    </div>
                </div>
                <div class="form-group" autocomplete="off">
                    <input type="password" oninput ='check_pass();' class="form-control" id="password1" name="password" placeholder="Password" minlength = "8" maxlength = "16" required="required">
                </div>
                <div class="form-group">
                    <input type="password" oninput='check_pass();' class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password" minlength = "8" maxlength = "16" required="required">
                </div>
                <div class="form-group">
                    <button type="submit" id="submit" class="btn btn-success btn-lg btn-block" >Register Now</button>
                </div>
            </form>
            <div class="text-center">Already have an account? <a href="#" id="log_click">Login</a></div>
        </div>

        <?php
            if (!empty($_POST) && isset($numMail) && isset($numUN) && isset($numTel)) 
            {
                if(!empty($_POST['first_name'] && $_POST['last_name'] && $_POST['email'] && $_POST['tel'] && $_POST['Address'] && $_POST['Username'] && $_POST['password']))
                {
                    if( $numMail != 1 && $numUN != 1 && $numTel != 1)
                    {
                        $login_id = unique_num(10);
                        $customer_id = customer_id();

                        $sql = "INSERT INTO customer (customer_id, email, f_name, l_name, address, tel_no, login_id)
                        values ('$customer_id','$email','$first_name','$last_name','$Address','$tel','$login_id')";

                        $sql2 = "INSERT INTO customer_login (username, password, login_id)
                        values ('$Username','$password','$login_id')";
                        if ($conn->query($sql2) && $conn->query($sql))
                        {
                            mysqli_close($conn);
                            echo
                            "<script>
                                if( window.history.replaceState )
                                {
                                    window.history.replaceState( null, null, window.location.href );
                                }
                            </script>";
                            echo
                                "<script>
                                    Swal.fire
                                    ({
                                        icon: 'success',
                                        title: 'Registration Complete!',
                                        text: 'Click OK to Return Home Page.',
                                        confirmButtonText: 'OK',
                                        confirmButtonColor: '#31bfb1',
                                        confirmButtonUrl: 'index.php',
                                        showCloseButton: true,
                                        allowOutsideClick: false,
                                    })
                                    .then((result) => 
                                    {
                                        if (result.isConfirmed) 
                                        {
                                            window.location.href = 'index.php';
                                        }
                                    })
                                </script>";     
                        }
                        else
                        {
                            echo 
                                "<script>
                                    Swal.fire
                                    ({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: 'Something went wrong!',
                                        confirmButtonText: 'OK',
                                        confirmButtonColor: '#31bfb1',
                                        showCloseButton: true,
                                    })
                                </script>";
                        }
                    }
                }
                else
                {
                echo 
                    "<script>
                        Swal.fire
                        ({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#31bfb1',
                            showCloseButton: true,
                        })
                    </script>";
                }
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
                        <p><a href="https://mail.google.com/mail/?view=cm&fs=1&to=alldrivesrilanka@Gmail.com" target="_blank">alldrivesrilanka@Gmail</a></p>
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