<!DOCTYPE html>
<html>
<head>

	<?php
		session_start();
		if (!isset($_SESSION['admin_id'])) {
             header('location:index.php');
        }
        include('DBconnection.php');
    ?>

	<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Admin - Bookings</title>

	<link rel="icon" type="image/png" href="images/icons/icon.png"/>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="PopM.js"></script>

	<link rel="stylesheet" href="bookingCss.css">
	<script src="bookingJS.js"></script>
	<script src="cancel_button.js"></script>
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

	        <nav class="menu">
	        	<a href="#Upcoming"><i class="fa fa-circle-o-notch"> Upcoming</i></a>
	        	<a href="#Ongoing"><i class="fa fa-spinner"> Ongoing</i></a>
	        	<a href="#Completed"><i class="fa fa-check"> Completed</i></a>
	        </nav>
	        <!-- Page Content -->
	        <div id="page-content-wrapper">
	            <button type="button" class="hamburger animated fadeInLeft is-closed" data-toggle="offcanvas">
	                <span class="hamb-top"></span>
	    			<span class="hamb-middle"></span>
					<span class="hamb-bottom"></span>
	            </button>

				<div class="content">
					<section id="Upcoming" class="section">
						<div class="upContain">
						    <div class="row">
						        <div class="panel panel-primary filterable">
						            <div class="panel-heading">
						                <h3 class="panel-title">Upcoming Bookings</h3>
						                <div class="pull-right">
						                    <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
						                </div>
						            </div>
						            <br>
						            <table class="table">
						                <thead>
						                    <tr class="filters">
						                        <th><input type="text" class="form-control" placeholder="Invoice #" disabled></th>
						                        <th><input type="text" class="form-control" placeholder="P Date/Time" disabled></th>
						                        <th><input type="text" class="form-control" placeholder="Return Date" disabled></th>
						                        <th><input type="text" class="form-control" placeholder="Est. KM" disabled></th>
						                        <th><input type="text" class="form-control" placeholder="Driver" disabled></th>
						                        <th><input type="text" class="form-control" placeholder="Location" disabled></th>
						                        <th><input type="text" class="form-control" placeholder="Payment" disabled></th>
						                        <th><input type="text" class="form-control" placeholder="Vehicle" disabled></th>
						                        <th><input type="text" class="form-control" placeholder="C Name" disabled></th>
						                        <th><input type="text" class="form-control" placeholder="Mobile" disabled></th>
						                        <th><input type="text" class="form-control" placeholder="D Name" disabled></th>
						                        <th style="font-weight:700; font-size:18px">Confirm/Cancel</th>
						                    </tr>
						                </thead>
						                <tbody>

						            		<?php
						                        $sql = "select * from booking where pickup_status ='No' and service IS NULL order by book_id DESC;";
						                        $result = mysqli_query($conn, $sql);
						                        if(mysqli_num_rows($result) > 0)
						                        {
						                            while($row = mysqli_fetch_array($result))
						                            {
						                            	$pay_id=$row["payment_id"];
						                            	$sql1 = "select * from payment where payment_id ='$pay_id'";
						                        		$result1 = mysqli_query($conn, $sql1);
						                        		$row1 = mysqli_fetch_array($result1);

						                        		$veh_id=$row["vehicle_id"];
						                            	$sql2 = "select * from vehicle where vehicle_id ='$veh_id'";
						                        		$result2 = mysqli_query($conn, $sql2);
						                        		$row2 = mysqli_fetch_array($result2);

						                        		if (NULL== $row["customer_id"]) 
						                        		{
						                        			$log_id=$row["login_id"];
							                            	$sql3 = "select * from customer where login_id ='$log_id'";
							                        		$result3 = mysqli_query($conn, $sql3);
							                        		$row3 = mysqli_fetch_array($result3);
						                        		}
						                        		else
						                        		{
						                        			$cus_id=$row["customer_id"];
							                            	$sql3 = "select * from customer where customer_id ='$cus_id'";
							                        		$result3 = mysqli_query($conn, $sql3);
							                        		$row3 = mysqli_fetch_array($result3);
						                        		}
						                    ?>
							                    <tr>
							                        <td><a href="printPDF.php?payment_id=<?php echo $row["payment_id"]; ?>"target="_blank"><?php echo $row["payment_id"]; ?></a></td>

							                        <td><?php echo $row["pickup_date"]; ?> <br> <?php echo $row["pickup_time"];?></td>
							                        <?php
															$start_date = $row["pickup_date"];
															$period = $row["booked_period"]-1;
															$return_date = date("Y-m-d", strtotime($start_date.'+  '.$period. 'days'));
														?>
							                        <td><?php echo $return_date ;?></div></td>
							                        <td><?php echo $row["estimated_km"]; ?></td>
							                        <td><?php if ($row["driver"]=='1'){echo "Yes";}else{echo "No";} ?></td>

							                        <td><?php if ($row["location_id"]=="1"){echo "AllDrive Kandy HQ";}else if ($row["location_id"]=="2"){echo "Peradeniya Garden";}else{echo "Dalada Maligawa";} ?></td>

							                        <td>Rs.<?php echo $row1["total_lkr"]; ?></td>
							                        <td><?php echo $row2["vehicle_name"]; ?></td>
							                        <td><?php echo $row3["f_name"]; ?> <?php echo $row3["l_name"]; ?></td>
							                        <td><?php echo $row3["tel_no"]; ?></td>
							                        <td>

							                        	<!-- Driver Selection -->

							                        	<?php
							                        		if ($row["driver_id"]==NULL)
							                        		{
							                        			$sql6 = "select * from drivers;";
									                        	$result6 = mysqli_query($conn, $sql6);
									                        	$numDrivers=mysqli_num_rows($result6);
									                        	$l=0;
									                        	$m=0;
									                        	$availability = "true";
									                        	$dID=array();

							                        			$period=$row["booked_period"];

							                        			if ($row["driver"]==1) 
							                        			{
							                        				$Date=$row["pickup_date"];
							                        				for ($j=1; $j <= $numDrivers; $j++) 
							                        				{ 
							                        					for ($i=0; $i < $period; $i++) 
									                        			{
									                        				$newDate=date('Y-m-d', strtotime($Date. ' + '.$i.' days'));
													                        $sql7 = "select * from booking where driver_id ='$j' and driver = 1;";
													                        $result7 = mysqli_query($conn, $sql7);
													                        $numbook=mysqli_num_rows($result7);
													                        if (0 == $numbook) 
													                        {
													                        	$availability = "true";
													                        }
													                        else
													                        {
														                        while ($row7 = mysqli_fetch_array($result7)) 
														                        {
														                        	for ($k=0; $k < $row7["booked_period"]; $k++) 
														                        	{ 
															                        	$dDate=$row7["pickup_date"];
															                        	$dDate=date('Y-m-d', strtotime($dDate. ' + '.$k.' days'));
															                        	if ($newDate!=$dDate) 
															                        	{
															                        		$availability="true";
															                        	}
															                        	else
															                        	{
															                        		$availability="false";
															                        		break;
															                        	}
															                        }
															                        if ($availability=="false") 
															                        {
															                        	break;
															                        }
															                    }
															                    if($availability=="true")
															                    {
															                        $sql8 = "select * from booking where driver_id ='$j' and driver = 0;";
																	                $result8 = mysqli_query($conn, $sql8);
																	               	while ($row8 = mysqli_fetch_array($result8)) 
																	                {
																	                    if ($newDate!=$row8["pickup_date"]) 
																	                    {
																	                       	$availability="true";
																	                    }
																	                    else
																	                    {
																	                        $availability="false";
																	                        break;
																	                    }
																	                }
															                    }
															                }
															                if($availability=="false")
															                {
															                    break;
															                }	
														                }
														                if($availability=="true")
														                {
														                    $dID[$m]=$j;
														                    $m++;
														                }
												                    }
							                        				if(0 != count($dID))
														            {
														                ?>
														                <div class="form-group">
														                <?php
														                    for ($o=0; $o < count($dID); $o++) 
														                    {
														                     	$sql4 = "select f_name from drivers where driver_id ='$dID[$o]';";
														                        $result4 = mysqli_query($conn, $sql4);
														                        $ri[$o] = mysqli_fetch_array($result4);
														                    }
														                ?>
														                <form action="assign_page.php?bid=<?php echo $row["book_id"] ?>" method="post">
														                <select name="driver" id="driver">
														                <?php
														                    for($p=0; $p < count($ri); $p++)
														                    {
														                        $dName=$ri[$p];
														                        echo "<option value=" .$dID[$p] . ">" . $dName['f_name'] . "</option>";
														                    }
														                ?>
														                </select>
														                	<td>
													                        	<center>
													                        	<button class="btn-check"><i class="fa fa-check"></i></button>
													                        	</form>
													                        	<a href="#" onclick="cancel_button(<?php echo $row["payment_id"]; ?>)" class ="btn-close"><i class="fa fa-close"></i></a>
													                        	</center>
													                        </td>
														                </div>
														                <?php
														                }
														            else
														            {
														                echo "Drivers N/A";
														            }
							                        			}
							                        			else
							                        			{
							                        				$Date=$row["pickup_date"];
							                        				$Time=$row["pickup_time"];
							                        				for ($j=1; $j <= $numDrivers; $j++) 
							                        				{ 
													                    $sql7 = "select * from booking where driver_id ='$j' and driver = 1;";
													                    $result7 = mysqli_query($conn, $sql7);
													                    
													                    $numbook=mysqli_num_rows($result7);
													                    if (0 == $numbook) 
													                    {
													                    	$availability = "true";
													                    }
													                    else
													                    {
														                    while ($row7 = mysqli_fetch_array($result7)) 
														                    {
														                    	for ($k=0; $k < $row7["booked_period"]; $k++) 
														                    	{ 
															                    	$dDate=$row7["pickup_date"];
															                    	$dDate=date('Y-m-d', strtotime($dDate. ' + '.$k.' days'));
															                    	if ($Date!=$dDate) 
															                    	{
															                    		$availability="true";
															                    	}
															                    	else
															                    	{
															                    		$availability="false";
															                    		break;
															                    	}
															                    }
															                    if ($availability=="false") 
															                    {
															                    	break;
															                    }
															                }
															                if($availability=="true")
															                {
															                    $sql8 = "select * from booking where driver_id ='$j' and driver = 0;";
																	            $result8 = mysqli_query($conn, $sql8);
																	           	while ($row8 = mysqli_fetch_array($result8)) 
																	            {
																	                if ($Date!=$row8["pickup_date"] && $Time!=$row8["pickup_time"]) 
																	                {
																	                   	$availability="true";
																	                }
																	                else
																	                {
																	                    $availability="false";
																	                    break;
																	                }
																	            }
															                }
															            }
														                if($availability=="true")
														                {
														                    $dID[$m]=$j;
														                    $m++;
														                }
												                    }
							                        				if(0 != count($dID))
														            {
														                ?>
														                <div class="form-group">
														                <?php
														                    for ($o=0; $o < count($dID); $o++) 
														                    {
														                     	$sql4 = "select f_name from drivers where driver_id ='$dID[$o]';";
														                        $result4 = mysqli_query($conn, $sql4);
														                        $ri[$o] = mysqli_fetch_array($result4);
														                    }
														                ?>
														                <form action="assign_page.php?bid=<?php echo $row["book_id"] ?>" method="post">
															                <select name="driver" id="driver">
															                <?php
															                    for($p=0; $p < count($ri); $p++)
															                    {
															                        $dName=$ri[$p];
															                        echo "<option value=" .$dID[$p] . ">" . $dName['f_name'] . "</option>";
															                    }
															                ?>
															                </select>
															                <td>
													                        	<center>
													                        	<button class="btn-check"><i class="fa fa-check"></i></button>
													                        	</form>
													                        	<a href="#" onclick="cancel_button(<?php echo $row["payment_id"]; ?>)" class ="btn-close"><i class="fa fa-close"></i></a>
													                        	</center>
													                        </td>
														                </div>
														                <?php
														                }
														            else
														            {
														                echo "Drivers N/A";
														            }
							                        			}
							                        		}
							                                else
							                                {
							                                	$driver_id=$row["driver_id"];
								                            	$sql5 = "select * from drivers where driver_id ='$driver_id'";
								                        		$result5 = mysqli_query($conn, $sql5);
								                        		$row5 = mysqli_fetch_array($result5);
								                        		echo $row5["f_name"];
								                        		echo '
								                        		<td>
													                <center>
													                <a href="update.php?bid='.$row["book_id"].'"><button class="btn-update"><i class="fa fa-refresh"></i></button></a>
													                <a href="#" onclick="cancel_button('.$row["payment_id"].')" class ="btn-close"><i class="fa fa-close"></i></a>
													                </center>
													            </td>';
							                                }
							                        	?>
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

					<section id="Ongoing" class="section">

						<div class="upContain">
						    <div class="row">
						        <div class="panel panel-primary filterable">
						            <div class="panel-heading">
						                <h3 class="panel-title">Ongoing Bookings</h3>
						                <div class="pull-right">
						                    <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
						                </div>
						            </div>
						            <br>
						            <table class="table">
						                <thead>
						                    <tr class="filters">
						                        <th><input type="text" class="form-control" placeholder="Invoice #" disabled></th>
						                        <th><input type="text" class="form-control" placeholder="Return Date" disabled></th>
						                        <th><input type="text" class="form-control" placeholder="Est. KM" disabled></th>
						                        <th><input type="text" class="form-control" placeholder="Location" disabled></th>
						                        <th><input type="text" class="form-control" placeholder="Payment" disabled></th>
						                        <th><input type="text" class="form-control" placeholder="Vehicle" disabled></th>
						                        <th><input type="text" class="form-control" placeholder="C Name" disabled></th>
						                        <th><input type="text" class="form-control" placeholder="Mobile" disabled></th>
						                        <th><input type="text" class="form-control" placeholder="D Name" disabled></th>
						                        <th style="font-weight:700; font-size:18px">Damages</th>
						                        <th style="font-weight:700; font-size:18px">Days</th>
						                        <th style="font-weight:700; font-size:18px">Distance</th>
						                        <th style="font-weight:700; font-size:18px">Return</th>
						                    </tr>
						                </thead>
						                <tbody>

						            		<?php
						                        $sql = "select * from booking where pickup_status ='Yes' AND return_id IS NULL  and service IS NULL order by book_id DESC;";
						                        $result = mysqli_query($conn, $sql);
						                        if(mysqli_num_rows($result) > 0)
						                        {
						                            while($row = mysqli_fetch_array($result))
						                            {
						                            	$pay_id=$row["payment_id"];
						                            	$sql1 = "select * from payment where payment_id ='$pay_id'";
						                        		$result1 = mysqli_query($conn, $sql1);
						                        		$row1 = mysqli_fetch_array($result1);

						                        		$veh_id=$row["vehicle_id"];
						                            	$sql2 = "select * from vehicle where vehicle_id ='$veh_id'";
						                        		$result2 = mysqli_query($conn, $sql2);
						                        		$row2 = mysqli_fetch_array($result2);

						                        		if (NULL== $row["customer_id"]) 
						                        		{
						                        			$log_id=$row["login_id"];
							                            	$sql3 = "select * from customer where login_id ='$log_id'";
							                        		$result3 = mysqli_query($conn, $sql3);
							                        		$row3 = mysqli_fetch_array($result3);
						                        		}
						                        		else
						                        		{
						                        			$cus_id=$row["customer_id"];
							                            	$sql3 = "select * from customer where customer_id ='$cus_id'";
							                        		$result3 = mysqli_query($conn, $sql3);
							                        		$row3 = mysqli_fetch_array($result3);
						                        		}
						                    ?>
							                    <tr>
							                        <td><a href="printPDF.php?payment_id=<?php echo $row["payment_id"]; ?>"target="_blank"><?php echo $row["payment_id"]; ?></a></td>
							                        <?php
															$start_date = $row["pickup_date"];
															$period = $row["booked_period"]-1;
															$return_date = date("Y-m-d", strtotime($start_date.'+  '.$period. 'days'));
														?>
							                        <td><?php echo $return_date ;?></div></td>
							                        <td><?php echo $row["estimated_km"]; ?></td>

							                        <td><?php if ($row["location_id"]=="1"){echo "AllDrive Kandy HQ";}else if ($row["location_id"]=="2"){echo "Peradeniya Garden";}else{echo "Dalada Maligawa";} ?></td>

							                        <td>Rs.<?php echo $row1["total_lkr"]; ?></td>
							                        <td><?php echo $row2["vehicle_name"]; ?></td>
							                        <td><?php echo $row3["f_name"]; ?> <?php echo $row3["l_name"]; ?></td>
							                        <td><?php echo $row3["tel_no"]; ?></td>
							                        <td>
							                        	<?php
							                        	$driver_id=$row["driver_id"];
								                        $sqlD = "select * from drivers where driver_id ='$driver_id'";
								                        $resultD = mysqli_query($conn, $sqlD);
								                        $rowD = mysqli_fetch_array($resultD);
								                        echo $rowD["f_name"];
													    ?>
													</td>
							                        <td>
							                        	<form action="ongoing.php?bid=<?php echo $row['book_id']?>" method="post">
							                        	<input type="number" id="damages" placeholder="Rs" name="damages" min="0" max="20000000" required="required">
							                        </td>
							                        <td>
							                        	<input type="number" id="damages" placeholder="Days" name="days" min="0" max="31" required="required">
							                        </td>
							                        <td>
							                        	<input type="number" id="distance" placeholder="KM" name="distance" min="0" max="2000" required="required">
							                        </td>
								                    <td>
													    <center>
													        <button class="btn-check"><i class="fa fa-check"></i></button>
													    </center>
													</form>
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

					<section id="Completed" class="section">

						<div class="upContain">
						    <div class="row">
						        <div class="panel panel-primary filterable">
						            <div class="panel-heading">
						                <h3 class="panel-title">Completed Bookings</h3>
						                <div class="pull-right">
						                    <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
						                </div>
						            </div>
						            <br>
						            <table class="table">
						                <thead>
						                    <tr class="filters">
						                        <th><input type="text" class="form-control" placeholder="Invoice #" disabled></th>
						                        <th><input type="text" class="form-control" placeholder="Vehicle Name" disabled></th>
						                        <th><input type="text" class="form-control" placeholder="Est. KM" disabled></th>
						                        <th><input type="text" class="form-control" placeholder="Driven KM" disabled></th>
						                        <th><input type="text" class="form-control" placeholder="Return Date" disabled></th>
						                        <th><input type="text" class="form-control" placeholder="Initial Payment" disabled></th>
						                        <th><input type="text" class="form-control" placeholder="Balance" disabled></th>
						                        <th><input type="text" class="form-control" placeholder="Status" disabled></th>
						                        <th><input type="text" class="form-control" placeholder="Return #" disabled></th>
						                        <th><input type="text" class="form-control" placeholder="D Name" disabled></th>
						                        <th><input type="text" class="form-control" placeholder="C Name" disabled></th>
						                        <th><input type="text" class="form-control" placeholder="C Mobile" disabled></th>
						                    </tr>
						                </thead>
						                <tbody>

						            		<?php
						                        $sql = "select * from booking where pickup_status ='Yes' AND return_id IS NOT NULL and service IS NULL order by book_id DESC;";
						                        $result = mysqli_query($conn, $sql);
						                        if(mysqli_num_rows($result) > 0)
						                        {
						                            while($row = mysqli_fetch_array($result))
						                            {
						                            	$pay_id=$row["payment_id"];
						                            	$sql1 = "select * from payment where payment_id ='$pay_id'";
						                        		$result1 = mysqli_query($conn, $sql1);
						                        		$batch1 = mysqli_fetch_array($result1);

						                        		$veh_id=$row["vehicle_id"];
						                            	$sqls2 = "select * from vehicle where vehicle_id ='$veh_id'";
						                        		$results2 = mysqli_query($conn, $sqls2);
						                        		$batch2 = mysqli_fetch_array($results2);

						                        		$ret_id=$row["return_id"];
						                            	$sqls4 = "select * from vehicle_return where return_id ='$ret_id'";
						                        		$results4 = mysqli_query($conn, $sqls4);
						                        		$batch4 = mysqli_fetch_array($results4);

						                        		if (NULL== $row["customer_id"]) 
						                        		{
						                        			$log_id=$row["login_id"];
							                            	$sqls3 = "select * from customer where login_id ='$log_id'";
							                        		$results3 = mysqli_query($conn, $sqls3);
							                        		$batch3 = mysqli_fetch_array($results3);
						                        		}
						                        		else
						                        		{
						                        			$cus_id=$row["customer_id"];
							                            	$sqls3 = "select * from customer where customer_id ='$cus_id'";
							                        		$results3 = mysqli_query($conn, $sqls3);
							                        		$batch3 = mysqli_fetch_array($results3);
						                        		}
						                    ?>
							                    <tr>
							                        <td><a href="printPDF.php?payment_id=<?php echo $row["payment_id"]; ?>"target="_blank"><?php echo $row["payment_id"]; ?></a></td>
							                        <td><?php echo $batch2["vehicle_name"]; ?></td>
							                        <td><?php echo $row["estimated_km"]; ?></td>
							                        <td><?php echo $batch4["driven_km"]; ?></td>
							                        <td><?php echo substr($batch4["return_date"], 0, 10) ?></div></td>
							                        <td>Rs.<?php echo $batch1["total_lkr"]; ?></td>
							                        <td>Rs.<?php echo $batch4["balance"]; ?></div></td>
							                        <td><?php echo $batch4["payment_status"]; ?></div></td>
							                        <td><a href="printFinal.php?$rID=<?php echo $row["return_id"]; ?>"target="_blank"><?php echo $row["return_id"]; ?></a></td>
							                        <td>
							                        	<?php
							                        	$driver_id=$row["driver_id"];
								                        $sqlDriv = "select * from drivers where driver_id ='$driver_id'";
								                        $resultDriv = mysqli_query($conn, $sqlDriv);
								                        $rowDriv = mysqli_fetch_array($resultDriv);
								                        echo $rowDriv["f_name"];
													    ?>
													</td>
							                        <td><?php echo $batch3["f_name"]; ?> <?php echo $batch3["l_name"]; ?></td>
							                        <td><?php echo $batch3["tel_no"]; ?></td>
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