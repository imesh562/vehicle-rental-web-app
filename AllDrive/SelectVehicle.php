<?php
    session_start();
    include('DBconnection.php');
    include ('LoginCheck.php');
    $Vid = $_GET['Vid'];
    $VidLink ="?Vid=$Vid";
?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald:300,400|Roboto:300,400,700">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Varela+Round">

        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

        <link href="http://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="http://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>

        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
        <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

        <script src="SelectVJS.js"></script>
        <script src="PopM.js"></script>
        <link rel="icon" href="Images/Common/icon.png">
        <title>AllDrive</title>

        <link rel="stylesheet" href="SelectVStyle.css">

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

        <?php
            $sql = "select * from vehicle where vehicle_id ='$Vid'";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0)
            {
                $row = mysqli_fetch_array($result);
        ?>

        <div class="container">
            <div class="row">
                <div class ="col-md-7">
                    <div id="custCarousel" class="carousel slide" data-ride="carousel" align="center">
                        <!-- slides -->
                        <div class="carousel-inner">
                            <div class="carousel-item active"> <img src="Images/Vehicles/<?php echo $row["img1"]; ?>" alt="Hills"> </div>
                            <div class="carousel-item"> <img src="Images/Vehicles/<?php echo $row["img2"]; ?>" alt="Hills"> </div>
                            <div class="carousel-item"> <img src="Images/Vehicles/<?php echo $row["img3"]; ?>" alt="Hills"> </div>
                        </div> <!-- Left right --> <a class="carousel-control-prev" href="#custCarousel" data-slide="prev"> <span class="carousel-control-prev-icon"></span> </a> <a class="carousel-control-next" href="#custCarousel" data-slide="next"> <span class="carousel-control-next-icon"></span> </a> <!-- Thumbnails -->
                        <ol class="carousel-indicators list-inline">
                            <li class="list-inline-item active"> <a id="carousel-selector-0" class="selected" data-slide-to="0" data-target="#custCarousel"> <img src="Images/Vehicles/<?php echo $row["img1"]; ?>" class="img-fluid"> </a> </li>
                            <li class="list-inline-item"> <a id="carousel-selector-1" data-slide-to="1" data-target="#custCarousel"> <img src="Images/Vehicles/<?php echo $row["img2"]; ?>" class="img-fluid"> </a> </li>
                            <li class="list-inline-item"> <a id="carousel-selector-2" data-slide-to="2" data-target="#custCarousel"> <img src="Images/Vehicles/<?php echo $row["img3"]; ?>" class="img-fluid"> </a> </li>
                        </ol>
                    </div>
                </div>
                <div class ="col-md-5">
                    <h2><?php echo $row["vehicle_name"]; ?></h2>
                    <p>
                        <ul>
                            <li><?php echo $row["description_1"]; ?></li>
                            <li><?php echo $row["description_2"]; ?></li>
                            <li><?php echo $row["description_3"]; ?></li>
                            <li><?php echo $row["description_4"]; ?></li>
                            <li><?php echo $row["description_5"]; ?></li>
                            <li><?php echo $row["description_6"]; ?></li>
                        </ul>
                    </p>
                    <p class="day_price">Rental For a Day : Rs <?php echo $row["day_price"]; ?>/=</p>
                    <p class="km_price">Price for an 1km : Rs <?php echo $row["km_price"]; ?>/=</p>
                </div>
            </div>
            <br><br><br><br>
            <div class="row">
                <div class ="col-md-3">
                </div>
                <div class ="col-md-6">
                    <form action="Userinfo.php<?php echo $VidLink ?>" method="post">

                        <H5 class="hint">Fill Out Following Information For a Booking.</H5>

                        <?php
                            $sql = "select * from booking where vehicle_id ='$Vid'";
                            $result = mysqli_query($conn, $sql);
                            if(mysqli_num_rows($result) > 0)
                            {
                                while ($row = mysqli_fetch_array($result)) 
                                {
                                    $bookedDates = $row["booked_period"];
                                    $bookedDates = $bookedDates;
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

                        <div class="form-group">
                            <label for="Pickdate">Select a Pickup Date : </label>
                            <input autocomplete="off" type="text" id="Pickdate" name="Pickdate" required="required">
                        </div>

                        <div class="form-group">
                            <label for="Returndate">Select a Return Date : </label>
                            <input autocomplete="off" type="text" id="Returndate" name="Returndate" required="required">
                        </div>

                        <div class="form-group">
                            <label for="Picktime">Select a Pickup Time : </label>
                            <input autocomplete="off" type="text" id="Picktime" name="Picktime" required="required">
                        </div>

                        <div class="form-group">
                            <label for="Location">Select a Pickup Location : </label>
                            <?php
                            $sql = "select * from locations;";
                            $result = mysqli_query($conn, $sql);
                            ?>
                            <select name="location" id="location">
                            <?php
                            while($ri = mysqli_fetch_array($result))
                            {
                            echo "<option value=" .$ri['location_id'] . ">" . $ri['location'] . "</option>";
                            }
                            echo "</select> ";
                            ?>
                        </div>

                        <div class="form-group">
                            <label for="distance">Estimated Rental Distance(KM) : </label>
                            <input type="number" id="distance" name="distance" min="10" max="2000" required="required">
                        </div>

                        <div class="form-group">
                            <label for="driver">With a Driver : </label>
                            <input type="checkbox" name="driver[1]">
                        </div>

                        <div class="form-group">
                            <button type="submit" id="submit" class="btn btn-success btn-lg" >Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <br>
        </div>
        <?php
            }
        ?>

        <div class="container">
            <div class="row">
                <div class ="col-md-5">
                    <h3>User Reviews.</h3>
                </div>
                <?php
                $sql2 = "select * from reviews INNER JOIN customer ON customer.login_id = reviews.login_id where vehicle_id = '$Vid' AND approval = '1';";
                $result2 = mysqli_query($conn, $sql2);

                if(mysqli_num_rows($result2) > 0)
                {
                    while($row2 = mysqli_fetch_array($result2))
                    {
                ?>
                    <div class="reviews">
                        <div class="row blockquote review-item">
                            <div class="col-md-3 text-center">
                                <img class="rounded-circle reviewer" src="http://standaloneinstaller.com/upload/avatar.png">
                                <div class="caption">
                                    <small>by <?php echo $row2['f_name'];?> <?php echo $row2['l_name'];?></a></small>
                                </div>
                            </div>
                            <div class="col-md-9">
                              <br>
                              <p class="review-text"><?php echo $row2['content'];?></p>
                              <small class="review-date"><?php echo substr($row2['Date'], 0,10);?></small>
                            </div>                          
                        </div>  
                    </div>
                <?php
                    }
                }
                else
                {
                    echo "<center><h6>No Reviews Yet.</h6></center>";
                }
                
                ?>
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