<?php
$con = mysqli_connect('localhost','root','','bloodbank');

if(!$con){
    die('Could not conect to the server' .mysqli_error($con));
}

mysqli_select_db($con, 'bloodbank') or die('Could not connect to the database' .mysqli_error($con));

$tb_admin = mysqli_query($con, "SELECT * FROM tb_admin");
$tb_bloodapproval = mysqli_query($con, "SELECT * FROM tb_bloodapproval");
$tb_bloodavailability = mysqli_query($con, "SELECT * FROM tb_bloodavailability");
$tb_blooddonation = mysqli_query($con, "SELECT * FROM tb_blooddonation");
$tb_bloodrequest = mysqli_query($con, "SELECT * FROM tb_bloodrequest WHERE msg='Declined' ");
$tb_donor = mysqli_query($con, "SELECT * FROM tb_donor");
$tb_patient = mysqli_query($con, "SELECT * FROM tb_patient");

require('fpdf181/fpdf.php');

$pdf = new FPDF('P','mm', 'Letter');
$pdf->SetFont('Arial','B',10);

$pdf->addPage('L', array(200,330), 0);
$pdf->cell(100,10,'Total Number of Declined Blood Request',0,1);
$header_request = mysqli_query($con, "SELECT UCASE(`COLUMN_NAME`)
FROM `INFORMATION_SCHEMA`.`COLUMNS`
WHERE `TABLE_SCHEMA` = 'bloodbank'
AND `TABLE_NAME` = 'tb_bloodrequest'
and `COLUMN_NAME` in ('request_controlno', 'patient_id', 'blood_type', 'request_date', 'blood_pint', 'msg')");
foreach($header_request as $heading){
    foreach($heading as $column_heading);
        $pdf->cell(50,10,$column_heading,1);
}

foreach($tb_bloodrequest as $row){
    $pdf->Ln();
    foreach ($row as $column){
        $pdf->cell(50,10,$column,1);
    }
}

$pdf->Output('D','Total Number of Declined Blood Request.pdf');;