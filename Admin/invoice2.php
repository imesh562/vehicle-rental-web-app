<?php
function billOut($returnInfo,$billInfo,$rID) 
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
$pdf->Cell(59	,5,'RETURN RECEIPT',0,1);//end of line

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
$pdf->Cell(25	,5,'Return ID',0,0);
$pdf->Cell(34	,5,": $rID",0,1);//end of line

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189	,10,'',0,1);//end of line

//billing address
$pdf->Cell(100	,5,'Bill to',0,1);//end of line

$sql3 = "select * from booking INNER JOIN customer ON customer.customer_id = booking.customer_id OR customer.login_id = booking.login_id where booking.book_id ='$returnInfo[0]';";
$result3 = mysqli_query($conn, $sql3);
$batch3 = mysqli_fetch_array($result3);

//add dummy cell at beginning of each line for indentation
$pdf->Cell(10	,5,'',0,0);
$pdf->Cell(90	,5,$batch3['f_name'],0,1);

$pdf->Cell(10	,5,'',0,0);
$pdf->Cell(90	,5,$batch3['l_name'],0,1);

$pdf->Cell(10	,5,'',0,0);
$pdf->Cell(90	,5,$batch3['address'],0,1);

$pdf->Cell(10	,5,'',0,0);
$pdf->Cell(90	,5,$batch3['tel_no'],0,1);

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
$pdf->Cell(34	,5,$billInfo[3],1,1,'R');//end of line

$pdf->Cell(147	,5,'Rent For Distance',1,0);
$pdf->Cell(8	,5,'Rs.',1,0);
$pdf->Cell(34	,5,$billInfo[1],1,1,'R');//end of line

$pdf->Cell(147	,5,'Rent For Driver',1,0);
$pdf->Cell(8	,5,'Rs.',1,0);
$pdf->Cell(34	,5,$billInfo[2],1,1,'R');//end of line

$pdf->Cell(147	,5,'Extra fees',1,0);
$pdf->Cell(8	,5,'Rs.',1,0);
$pdf->Cell(34	,5,$billInfo[4],1,1,'R');//end of line

//summary
$pdf->Cell(110	,5,'',0,0);
$pdf->Cell(37	,6,'Subtotal',0,0);
$pdf->Cell(8	,5,'Rs.',1,0);
$pdf->Cell(34	,5,$billInfo[5],1,1,'R');//end of line

$pdf->Cell(110	,5,'',0,0);
$pdf->Cell(37	,6,'Initial Payment',0,0);
$pdf->Cell(8	,5,'Rs.',1,0);
$pdf->Cell(34	,5,$billInfo[0],1,1,'R');//end of line

$pdf->Cell(110	,5,'',0,0);
$pdf->Cell(37	,6,'Balance',0,0);
$pdf->Cell(8	,5,'Rs.',1,0);
$pdf->Cell(34	,5,$returnInfo[2],1,1,'R');//end of line

//add dummy cell at beginning of each line for indentation

$filename="return_bills/$rID.pdf";
$pdf->Output($filename,'F');

}
?>
