<?php
session_start();
$username = "";
$email = "";
$errors = array();

//CONNECT TO DATABASE
$server = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "bloodbank";
$conn = new mysqli($server, $dbusername, $dbpassword, $dbname);

/**
 * REGISTER USER
 */

//IF REGISTER BUTTON IS CLICKED
if (isset($_POST['register']))
{
    $usertype = $_POST['usertype'];
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $contactnumber = $_POST['contactnum'];
    $address = $_POST['address'];
    $birthdate = $_POST['birthdate'];
    $username = $_POST['username'];
    $gender = $_POST['gender'];
    $bloodtype = $_POST['bloodtype'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($usertype == "donor")
    {
        $sql = "INSERT INTO tb_donor (first_name, last_name, contactnum, birthdate, address, email, password, username, gender, bloodtype) 
            VALUES ('$firstname', '$lastname', '$contactnumber', '$birthdate','$address', '$email', '$password', '$username', '$gender', '$bloodtype')";
        $run = mysqli_query($conn, $sql);

    }
    if ($usertype == "patient")
    {
        $sql = "INSERT INTO tb_patient (first_name, last_name, contactnum, birthdate, address, email, password, username, gender, bloodtype) 
            VALUES ('$firstname', '$lastname', '$contactnumber', '$birthdate','$address', '$email', '$password', '$username', '$gender', '$bloodtype')";
        $run = mysqli_query($conn, $sql);
    }
}

/**
 * LOGIN USER
 */

//IF THE LOGIN BUTTON IS CLICKED
if (isset($_POST['login']))
{
    $usertype = $_POST['user'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    //ERROR MESSAGES FROM THE LOGIN PAGE
    if ($usertype == "donor")
    {
        $sql = "SELECT * FROM tb_donor WHERE email = '$email' AND password = '$password'";
        $run = mysqli_query($conn, $sql);
        if (mysqli_num_rows($run) == 1)
        {
            $row = mysqli_fetch_assoc($run);
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;
            $_SESSION['success'] = "You are now logged in";
            header('location: donor/donor.php');
        }
    }

    if ($usertype == "patient")
    {
        $sql = "SELECT * FROM tb_patient WHERE email = '$email' AND password = '$password'";
        $run = mysqli_query($conn, $sql);
        if (mysqli_num_rows($run) == 1)
        {
            $row = mysqli_fetch_assoc($run);
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;
            $_SESSION['success'] = "You are now logged in";
            header('location: patient/patient.php');
        }
    }

    if (($email == 'admin@bloodbank.com') && ($password == 'admin'))
    {
        $sql = "SELECT * FROM tb_admin WHERE email = '$email' AND password = '$password'";
        $run = mysqli_query($conn, $sql);
        if (mysqli_num_rows($run) == 1)
        {
            $row = mysqli_fetch_assoc($run);
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;
            $_SESSION['success'] = "You are now logged in";
            header('location: admin/admin.php');
        }
    }
    else
    {
        array_push($errors, "The email or password is incorrect"); 
    }
}

/**
 * BLOOD DONATION (DONOR)
 */

//IF THE DONATE BUTTON IS CLICKED
if (isset($_POST['donate']))
{
    $id = $_POST['id'];
    $bloodtype = $_POST['bloodtype'];
    $bloodpint = $_POST['bloodpint'];
    $date = date('Y-m-d H:i:s');

    $sql = "INSERT INTO tb_blooddonation (donor_id, bloodtype, blood_pint, date_donated)
                   VALUES ('$id', '$bloodtype', '$bloodpint', '$date')";
    $run = mysqli_query($conn, $sql);

    echo "
           <div class='alert alert-success' role='alert'>
            <b>SUCCESS:<b/> Successfully Donated!
           </div>
           ";

    $addSql = "UPDATE tb_bloodavailability SET quantity  = quantity + '$bloodpint' WHERE blood = '$bloodtype'";
    $addRun = mysqli_query($conn, $addSql);

}

/**
 * BLOOD REQUEST (PATIENT)
 */

//IF THE SEND REQUEST BUTTON IS CLICKED
if (isset($_POST['send_request']))
{
    $id = $_POST['id'];
    $bloodtype = $_POST['bloodtype'];
    $bloodpint = $_POST['bloodpint'];
    $date = date('Y-m-d H:i:s');
    $msg = 'PENDING';

    $sql = "INSERT INTO tb_bloodrequest (patient_id, blood_type, request_date, blood_pint, msg)
                   VALUES ('$id', '$bloodtype', '$date', '$bloodpint', '$msg')";
    $run = mysqli_query($conn, $sql);

    echo "
           <div class='alert alert-success' role='alert'>
           <b>SUCCESS:<b/> Request Sent!
           </div>
           ";
}

/**
 * ADMIN
 */

//APPROVE BLOOD REQUEST
if (isset($_POST['approve']))
{
    $requestno = $_POST['requestno'];
    $date = date('Y-m-d H:i:s');
    $msg = 'APPROVED';

    //ERROR MESSAGES FROM REGISTRATION PAGE
    if (empty($requestno))
    {
        echo "<div class='alert alert-danger' role='alert'>
            Search by Request #
           </div>";
    }
    else
    {

        $sql = mysqli_query($conn, "SELECT * FROM tb_bloodrequest WHERE request_controlno = '$requestno'");
        $result = mysqli_fetch_array($sql);
        $bloodtype = $result['blood_type'];
        $bloodpint = $result['blood_pint'];

        $sql = "UPDATE tb_bloodavailability SET quantity  = quantity - '$bloodpint' WHERE blood = '$bloodtype'";
        $run = mysqli_query($conn, $sql);

        $sql = "INSERT INTO tb_bloodapproval (request_controlno, approval_date)
        VALUES ('$requestno', '$date')";
        $run = mysqli_query($conn, $sql);

        $sql = "UPDATE tb_bloodrequest SET msg = '$msg' WHERE request_controlno = '$requestno'";
        $run = mysqli_query($conn, $sql);

        echo "<div class='alert alert-success' role='alert'>
        <b>SUCCESS:<b/>  Approved Successfully.
       </div>";
    }
}

//DECLINE BLOOD REQUEST
if (isset($_POST['decline']))
{
    $requestno = $_POST['requestno'];
    $date = date('Y-m-d H:i:s');
    $msg = 'DECLINED';

    if (empty($requestno))
    {
        echo "<div class='alert alert-danger' role='alert'>
            Search by Request #
           </div>";
    }
    else
    {

        $sql = "UPDATE tb_bloodrequest SET msg = '$msg' WHERE request_controlno = '$requestno'";
        $run = mysqli_query($conn, $sql);

        echo "<div class='alert alert-success' role='alert'>
        <b>SUCCESS:<b/> The request has been declined.
       </div>";
    }
}

//SEARCH DONOR
if (isset($_POST['searchDonor']))
{
    $id = $_POST['id'];

    if (empty($id))
    {
        echo "<div class='alert alert-danger' role='alert'>
            Search by Id...
           </div>";
    }
    else
    {
        $sql = "SELECT * FROM tb_donor WHERE donor_id = '$id'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 1)
        {
            $_SESSION['id'] = $id;
            header('location: admin_donoredit.php');
        }
        else
        {
            echo "
            <div class='alert alert-danger' role='alert'>
            <b>ERROR:</b> No data found.
            </div>
            ";
        }
    }
}

//CHANGE DONOR DATA
if (isset($_POST['savedonordata']))
{
    $id = $_POST['id'];
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $contactno = $_POST['contactno'];

    if ((empty($username)) or (empty($firstname)) or (empty($lastname)) or (empty($email)) or (empty($password)) or (empty($contactno)))
    {
        echo "
                <div class='alert alert-danger' role='alert'>
                <b>ERROR:</b> You can't delete required fields.
                </div>
                ";
    }
    else
    {
        $sql = "UPDATE tb_donor SET 
            first_name = '$firstname',
            last_name = '$lastname',
            email = '$email',
            username = '$username',
            password = '$password',
            contactnum = '$contactno'
            WHERE donor_id = '$id'";
        $run = mysqli_query($conn, $sql);

        echo "
                <div class='alert alert-success' role='alert'>
                <b>SUCCESS:</b> User data has been updated successfully.
                </div>
                ";
    }
}

//DELETE DONOR DATA
if (isset($_POST['deletedonordata']))
{
    $id = $_POST['id'];
    $sql = "DELETE FROM tb_donor WHERE donor_id = '$id'";
    $result = mysqli_query($conn, $sql);
    header('location: admin_donorview.php');
    echo "
    <div class='alert alert-success' role='alert'>
    <b>SUCCESS:</b> User has been successfully deleted.
    </div>
    ";
}


//SEARCH PATIENT
if (isset($_POST['searchPatient']))
{
    $id = $_POST['id'];

    if (empty($id))
    {
        echo "<div class='alert alert-danger' role='alert'>
            Search by Id...
           </div>";
    }
    else
    {
        $sql = "SELECT * FROM tb_patient WHERE patient_id = '$id'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 1)
        {
            $_SESSION['id'] = $id;
            header('location: admin_patientedit.php');
        }
        else
        {
            echo "
            <div class='alert alert-danger' role='alert'>
            <b>ERROR:</b> No data found.
            </div>
            ";
        }
    }
}

//CHANGE PATIENT DATA
if (isset($_POST['savepatientdata']))
{
    $id = $_POST['id'];
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $contactno = $_POST['contactno'];

    if ((empty($username)) or (empty($firstname)) or (empty($lastname)) or (empty($email)) or (empty($password)) or (empty($contactno)))
    {
        echo "
                <div class='alert alert-danger' role='alert'>
                <b>ERROR:</b> You can't delete required fields.
                </div>
                ";
    }
    else
    {
        $sql = "UPDATE tb_patient SET 
            first_name = '$firstname',
            last_name = '$lastname',
            email = '$email',
            username = '$username',
            password = '$password',
            contactnum = '$contactno'
            WHERE patient_id = '$id'";
        $run = mysqli_query($conn, $sql);

        echo "
                <div class='alert alert-success' role='alert'>
                <b>SUCCESS:</b> User data has been updated successfully.
                </div>
                ";
    }
}

//DELETE PATIENT DATA
if (isset($_POST['deletepatientdata']))
{
    $id = $_POST['id'];
    $sql = "DELETE FROM tb_patient WHERE patient_id = '$id'";
    $result = mysqli_query($conn, $sql);
    header('location: admin_patientview.php');
    echo "
    <div class='alert alert-success' role='alert'>
    <b>SUCCESS:</b> User has been successfully deleted.
    </div>
    ";
}


/*
 * EDIT INDIVIDUAL DATA
 */

 //EDIT DONOR DATA
 if (isset($_POST['saveuserdonor']))
 {
     
     $id = $_POST['id'];
     $firstname = $_POST['fname'];
     $lastname = $_POST['lname'];
     $username = $_POST['username'];
     $email = $_POST['email'];
     $password = $_POST['password'];
     $contactno = $_POST['contactno'];
 
     if ((empty($username)) or (empty($firstname)) or (empty($lastname)) or (empty($email)) or (empty($password)) or (empty($contactno)))
     {
         echo "
                 <div class='alert alert-danger' role='alert'>
                 <b>ERROR:</b> You can't delete required fields.
                 </div>
                 ";
     }
     else
     {
         $sql = "UPDATE tb_donor SET 
             first_name = '$firstname',
             last_name = '$lastname',
             email = '$email',
             username = '$username',
             password = '$password',
             contactnum = '$contactno'
             WHERE donor_id = '$id'";
         $run = mysqli_query($conn, $sql);
 
         echo "
                 <div class='alert alert-success' role='alert'>
                 <b>SUCCESS:</b> Your data has been updated successfully.
                 </div>
                 ";
     }
 }
//EDIT PATIENT DATA
if (isset($_POST['saveuserpatient']))
{
    
    $id = $_POST['id'];
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $contactno = $_POST['contactno'];

    if ((empty($username)) or (empty($firstname)) or (empty($lastname)) or (empty($email)) or (empty($password)) or (empty($contactno)))
    {
        echo "
                <div class='alert alert-danger' role='alert'>
                <b>ERROR:</b> You can't delete required fields.
                </div>
                ";
    }
    else
    {
        $sql = "UPDATE tb_patient SET 
            first_name = '$firstname',
            last_name = '$lastname',
            email = '$email',
            username = '$username',
            password = '$password',
            contactnum = '$contactno'
            WHERE patient_id = '$id'";
        $run = mysqli_query($conn, $sql);

        echo "
                <div class='alert alert-success' role='alert'>
                <b>SUCCESS:</b> Your data has been updated successfully.
                </div>
                ";
    }
}


/*
 * ADMIN ADD DONOR AND ADD PATIENT
 */

if (isset($_POST['addDonor'])) {
    $firstname     = $_POST['fname'];
    $lastname      = $_POST['lname'];
    $contactnumber = $_POST['contactnum'];
    $address       = $_POST['address'];
    $birthdate     = $_POST['birthdate'];
    $username      = $_POST['username'];
    $gender        = $_POST['gender'];
    $bloodtype     = $_POST['bloodtype'];
    $email         = $_POST['email'];
    $password      = $_POST['password'];

    
        $sql      = "INSERT INTO tb_donor (first_name, last_name, contactnum, birthdate, address, email, password, username, gender, bloodtype) 
            VALUES ('$firstname', '$lastname', '$contactnumber', '$birthdate','$address', '$email', '$password', '$username', '$gender', '$bloodtype')";
        $run      = mysqli_query($conn, $sql);
        echo "
        <div class='alert alert-success' role='alert'>
        <b>SUCCESS:</b> New donor has been successfully added.
        </div>
        ";
}

if (isset($_POST['addPatient'])) {
    $firstname     = $_POST['fname'];
    $lastname      = $_POST['lname'];
    $contactnumber = $_POST['contactnum'];
    $address       = $_POST['address'];
    $birthdate     = $_POST['birthdate'];
    $username      = $_POST['username'];
    $gender        = $_POST['gender'];
    $bloodtype     = $_POST['bloodtype'];
    $email         = $_POST['email'];
    $password      = $_POST['password'];
    
    $sql      = "INSERT INTO tb_patient (first_name, last_name, contactnum, birthdate, address, email, password, username, gender, bloodtype) 
                 VALUES ('$firstname', '$lastname', '$contactnumber', '$birthdate','$address', '$email', '$password', '$username', '$gender', '$bloodtype')";
    $run      = mysqli_query($conn, $sql);
    echo "
    <div class='alert alert-success' role='alert'>
    <b>SUCCESS:</b> New patient has been successfully added.
    </div>
    ";
}

/*
 * DOWNLOAD REPORT BUTTON
 */





?>
