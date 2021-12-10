<?php
function billOut($bookingInfo,$userInfo,$paymentInfo) 
{
include('DBconnection.php');
require('fpdf17/fpdf.php');

//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm

$pdf = new FPDF('P','mm','A4');

$pdf->AddPage();

//set font to arial, bold, 14pt
$pdf->SetFont('Arial','B',14);

//Cell(width , height , text , border , end line , [align] )

$pdf->Cell(130	,5,'AllDrive',0,0);
$pdf->Cell(59	,5,'RECEIPT',0,1);//end of line

$pdf->Cell(189	,10,'',0,1);//end of line

//set font to arial, regular, 12pt
$pdf->SetFont('Arial','',12);

$pdf->Cell(130	,5,'271 Aladeniya Road,',0,0);
$pdf->Cell(59	,5,'',0,1);//end of line
$pdf->Cell(130	,5,'Peradeniya ,Sri Lanka',0,0);

$date = new DateTime("now", new DateTimeZone('Asia/Dhaka') );
$sDate = $date->format('Y-m-d H:i:s');
$sDate = substr($sDate, 0,10);
$pdf->Cell(25	,5,'Date',0,0);
$pdf->Cell(34	,5,": $sDate",0,1);//end of line

$pdf->Cell(130	,5,'Phone (+94) 0812 410 194',0,0);
$pdf->Cell(25	,5,'Invoice #',0,0);
$pdf->Cell(34	,5,": $bookingInfo[9]",0,1);//end of line

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189	,10,'',0,1);//end of line

//billing address
$pdf->Cell(100	,5,'Bill to',0,1);//end of line

//add dummy cell at beginning of each line for indentation
$pdf->Cell(10	,5,'',0,0);
$pdf->Cell(90	,5,$userInfo[0],0,1);

$pdf->Cell(10	,5,'',0,0);
$pdf->Cell(90	,5,$userInfo[1],0,1);

$pdf->Cell(10	,5,'',0,0);
$pdf->Cell(90	,5,$userInfo[4],0,1);

$pdf->Cell(10	,5,'',0,0);
$pdf->Cell(90	,5,$userInfo[3],0,1);

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189	,10,'',0,1);//end of line

//invoice contents
$pdf->SetFont('Arial','B',12);

$pdf->Cell(155	,10,'Description',1,0);
$pdf->Cell(34	,10,'Amount',1,1,'R');//end of line

$pdf->SetFont('Arial','',12);

//Numbers are right-aligned so we give 'R' after new line parameter

$pdf->Cell(147	,5,'Rent For Days',1,0);
$pdf->Cell(8	,5,'Rs.',1,0);
$pdf->Cell(34	,5,$paymentInfo[0],1,1,'R');//end of line

$pdf->Cell(147	,5,'Rent For Distance',1,0);
$pdf->Cell(8	,5,'Rs.',1,0);
$pdf->Cell(34	,5,$paymentInfo[1],1,1,'R');//end of line

$pdf->Cell(147	,5,'Rent For Driver',1,0);
$pdf->Cell(8	,5,'Rs.',1,0);
$pdf->Cell(34	,5,$paymentInfo[2],1,1,'R');//end of line

//summary
$pdf->Cell(122	,5,'',0,0);
$pdf->Cell(25	,6,'Subtotal',0,0);
$pdf->Cell(8	,5,'Rs.',1,0);
$pdf->Cell(34	,5,$bookingInfo[7],1,1,'R');//end of line

$pdf->Cell(147	,5,'',0,0);
$pdf->Cell(8	,5,'$',1,0);
$pdf->Cell(34	,5,$bookingInfo[8],1,1,'R');//end of line

//add dummy cell at beginning of each line for indentation

$sql = "select * from vehicle where vehicle_id ='$bookingInfo[6]'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

$pdf->Cell(40	,5,'Vehicle Name',0,0);
$pdf->Cell(20	,5,": ".$row['vehicle_name'],0,1);

$sql1 = "select * from locations where location_id ='$bookingInfo[2]'";
$result1 = mysqli_query($conn, $sql1);
$row1 = mysqli_fetch_array($result1);

$pdf->Cell(40	,5,'Pickup Location',0,0);
$pdf->Cell(20	,5,": ".$row1['location'],0,1);

$pdf->Cell(40	,5,'Pickup Date',0,0);
$pdf->Cell(20	,5,": $bookingInfo[0]",0,1);

$pdf->Cell(40	,5,'Pickup Time',0,0);
$pdf->Cell(20	,5,": $bookingInfo[1]",0,1);

$filename="bills/$bookingInfo[9].pdf";
$pdf->Output($filename,'F');

}
?>
