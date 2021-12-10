<?php
$payment_id = $_GET['payment_id'];
// The location of the PDF file
// on the server
$filename = "../Admin/bills/$payment_id.pdf";
  
// Header content type
header("Content-type: application/pdf");
  
header("Content-Length: " . filesize($filename));
  
// Send the file to the browser.
readfile($filename);

?> 