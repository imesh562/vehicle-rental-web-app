<?php
$rID = $_GET['$rID'];
// The location of the PDF file
// on the server
$filename = "../Admin/return_bills/$rID.pdf";
  
// Header content type
header("Content-type: application/pdf");
  
header("Content-Length: " . filesize($filename));
  
// Send the file to the browser.
readfile($filename);

?> 