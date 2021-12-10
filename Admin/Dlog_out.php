<?php

session_start();

if(isset($_SESSION['driver_id']))
{
	unset($_SESSION['driver_id']);
	//session_destroy();
}

header("Location: driverLog.php")

?>