<?php
        $host = "localhost:3307";
        $dbusername = "root";
        $dbpassword = "";
        $dbname = "alldrivedb";

        $conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

        if (mysqli_connect_error())
        {
            die('Connect Error ('. mysqli_connect_errno() .') '
            . mysqli_connect_error());
        }
?>