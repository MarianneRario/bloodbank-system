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
$tb_bloodrequest = mysqli_query($con, "SELECT * FROM tb_bloodrequest");
$tb_donor = mysqli_query($con, "SELECT * FROM tb_donor");
$tb_patient = mysqli_query($con, "SELECT * FROM tb_patient");



require('fpdf181/fpdf.php');

$pdf = new FPDF('P','mm', 'Letter');
$pdf->SetFont('Arial','B',10);

//TB_ADMIN
$pdf->AddPage();
$pdf->cell(100,10,'tb_admin',0,1);
$header_admin = mysqli_query($con, "SELECT UCASE(`COLUMN_NAME`)
FROM `INFORMATION_SCHEMA`.`COLUMNS`
WHERE `TABLE_SCHEMA` = 'bloodbank'
AND `TABLE_NAME` = 'tb_admin'
and `COLUMN_NAME` in ('admin_id', 'username', 'email', 'password')");
foreach($header_admin as $heading){
    foreach($heading as $column_heading);
        $pdf->cell(50,10,$column_heading,1);
}

foreach($tb_admin as $row){
    $pdf->Ln();
    foreach ($row as $column){
        $pdf->cell(50,10,$column,1);
    }
}

//TB_BLOODAPPROVAL
$pdf->addPage();
$pdf->cell(100,10,'tb_bloodapproval',0,1);
$header_approval = mysqli_query($con, "SELECT UCASE(`COLUMN_NAME`)
FROM `INFORMATION_SCHEMA`.`COLUMNS`
WHERE `TABLE_SCHEMA` = 'bloodbank'
AND `TABLE_NAME` = 'tb_bloodapproval'
and `COLUMN_NAME` in ('controlno', 'request_controlno', 'approval_date')");
foreach($header_approval as $heading){
    foreach($heading as $column_heading);
        $pdf->cell(50,10,$column_heading,1);
}

foreach($tb_bloodapproval as $row){
    $pdf->Ln();
    foreach ($row as $column){
        $pdf->cell(50,10,$column,1);
    }
}

//TB_BLOODAVAILABILITY
$pdf->addPage();
$pdf->cell(100,10,'tb_bloodavailability',0,1);
$header_availability = mysqli_query($con, "SELECT UCASE(`COLUMN_NAME`)
FROM `INFORMATION_SCHEMA`.`COLUMNS`
WHERE `TABLE_SCHEMA` = 'bloodbank'
AND `TABLE_NAME` = 'tb_bloodavailability'
and `COLUMN_NAME` in ('blood_id', 'blood', 'quantity')");
foreach($header_availability as $heading){
    foreach($heading as $column_heading);
        $pdf->cell(50,10,$column_heading,1);
}

foreach($tb_bloodavailability as $row){
    $pdf->Ln();
    foreach ($row as $column){
        $pdf->cell(50,10,$column,1);
    }
}


//TB_BLOODDONATION
$pdf->addPage('L', array(260,300), 0);
$pdf->cell(100,10,'tb_blooddonation',0,1);
$header_donation = mysqli_query($con, "SELECT UCASE(`COLUMN_NAME`)
FROM `INFORMATION_SCHEMA`.`COLUMNS`
WHERE `TABLE_SCHEMA` = 'bloodbank'
AND `TABLE_NAME` = 'tb_blooddonation'
and `COLUMN_NAME` in ('donation_id', 'donor_id', 'bloodtype', 'blood_pint', 'date_donated')");
foreach($header_donation as $heading){
    foreach($heading as $column_heading);
        $pdf->cell(50,10,$column_heading,1);
}

foreach($tb_blooddonation as $row){
    $pdf->Ln();
    foreach ($row as $column){
        $pdf->cell(50,10,$column,1);
    }
}

//TB_BLOODREQUEST
$pdf->addPage('L', array(200,280), 0);
$pdf->cell(100,10,'tb_bloodrequest',0,1);
$header_request = mysqli_query($con, "SELECT UCASE(`COLUMN_NAME`)
FROM `INFORMATION_SCHEMA`.`COLUMNS`
WHERE `TABLE_SCHEMA` = 'bloodbank'
AND `TABLE_NAME` = 'tb_bloodrequest'
and `COLUMN_NAME` in ('request_controlno', 'patient_id', 'blood_type', 'request_date', 'blood_pint')");
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

//TB_DONOR
$pdf->addPage('L', array(300,640), 0);
$pdf->cell(100,10,'tb_donor',0,1);
$header_donor = mysqli_query($con, "SELECT UCASE(`COLUMN_NAME`)
FROM `INFORMATION_SCHEMA`.`COLUMNS`
WHERE `TABLE_SCHEMA` = 'bloodbank'
AND `TABLE_NAME` = 'tb_donor'
and `COLUMN_NAME` in ('first_name', 'donor_id', 'last_name', 'contactnum', 'birthdate', 'address', 'email', 'password', 'username', 'gender', 'bloodtype', 'registration_date')");
foreach($header_donor as $heading){
    foreach($heading as $column_heading);
        $pdf->cell(50,10,$column_heading,1);
}

foreach($tb_donor as $row){
    $pdf->Ln();
    foreach ($row as $column){
        $pdf->cell(50,10,$column,1);
    }
}

//TB_PATIENT
$pdf->addPage('L', array(300,640), 0);
$pdf->cell(100,10,'tb_patient',0,1);
$header_patient = mysqli_query($con, "SELECT UCASE(`COLUMN_NAME`)
FROM `INFORMATION_SCHEMA`.`COLUMNS`
WHERE `TABLE_SCHEMA` = 'bloodbank'
AND `TABLE_NAME` = 'tb_patient'
and `COLUMN_NAME` in ('patient_id', 'first_name', 'last_name', 'contactnum', 'birthdate', 'address', 'email', 'password', 'username', 'gender', 'bloodtype', 'registration_date')");
foreach($header_patient as $heading){
    foreach($heading as $column_heading);
        $pdf->cell(50,10,$column_heading,1);
}

foreach($tb_patient as $row){
    $pdf->Ln();
    foreach ($row as $column){
        $pdf->cell(50,10,$column,1);
    }
}

$pdf->Output('D','tb_donor.pdf');;
