<?php
   include('../server.php');
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp"
         crossorigin="anonymous">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB"
         crossorigin="anonymous">
      <link rel="stylesheet" href="admin.css">
      <title>BloodBank</title>
   </head>
   <body>
   <?php 
         $e = $_SESSION["email"];
         $p = $_SESSION["password"];
         
         $sql = "SELECT * FROM tb_admin WHERE email = '$e' AND password = '$p'";
         $result = mysqli_query($conn, $sql);
         $resultCheck = mysqli_num_rows($result);
         $row = mysqli_fetch_assoc($result);

         ?>
      <nav class="navbar navbar-expand-sm navbar-dark bg-dark p-0">
         <div class="container">
            <a href="admin.php" class="navbar-brand">BloodBank</a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
               <ul class="navbar-nav">
                  <li class="nav-item px-2">
                     <a href="#" class="nav-link active">Dashboard</a>
                  </li>
                  <li class="nav-item px-2">
                     <a href="admin_donorview.php" class="nav-link">Donor</a>
                  </li>
                  <li class="nav-item px-2">
                     <a href="admin_patientview.php" class="nav-link">Patient</a>
                  </li>
                  <li class="nav-item px-2">
                     <a href="databasebackup.php" class="nav-link">Database Backup & Recovery</a>
                  </li>
               </ul>
               <ul class="navbar-nav ml-auto">
                  <li class="nav-item dropdown mr-3">
                     <a href="#" class="nav-link toggle" data-toggle="">
                     <i class="fas fa-user"></i> Welcome <?php echo $row['username'] ?>
                     </a>
                     <div class="dropdown-menu">
                        <a href="profile.html" class="dropdown-item">
                        <i class="fas fa-user-circle"></i> Profile
                        </a>
                        <a href="settings.html" class="dropdown-item">
                        <i class="fas fa-cog"></i> Settings
                        </a>
                     </div>
                  </li>
                  <li class="nav-item">
                     <a href="../index.php" class="nav-link">
                     <i class="fas fa-user-times"></i> Logout
                     </a>
                  </li>
               </ul>
            </div>
         </div>
      </nav>
      <!-- HEADER -->
      <header id="main-header" class="py-2 bg-primary text-white">
         <div class="container">
            <div class="row">
               <div class="col-md-6">
                  <h1>
                     <i class="fas fa-lock"></i> File Maintenance
                  </h1>
               </div>
            </div>
         </div>
      </header>
      <!-- ACTIONS -->
      <section id="actions" class="py-4 mb-4 bg-light">
         <div class="container">
            <div class="row">
               <div class="col-md-6">
                  <a href="#" class="btn btn-danger btn-block" data-toggle="modal" data-target="#addDonorModal">
                  <i class="fas fa-plus"></i> Add Donor
                  </a>
               </div>
               <div class="col-md-6">
                  <a href="#" class="btn btn-info btn-block" data-toggle="modal" data-target="#addPatientModal">
                  <i class="fas fa-plus"></i> Add Patient
                  </a>
               </div>
            </div>
         </div>
      </section>
      <!-- POSTS -->
      <section id="posts">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="card">
                     <div class="card-header">
                        <h4>Report Generation and Transactions</h4>
                     </div>
                     <table class="table table-striped">
                        <thead class="thead-dark">
                           <tr>
                              <th>Report</th>
                              <th>Audit Trail Summary</th>
                              <th>Transactions</th>
                              <th><center></center></th>
                              <th></th>
                           </tr>
                        </thead>
                        <tbody>
                        <?php
                        $resTable = mysqli_query($conn,"SELECT count(donor_id) FROM tb_donor");
                        $rowTbl = mysqli_fetch_array($resTable);
                            echo "<tr>";
                            echo "<td><b>Total Number of Donors</b></td>";
                            echo "<td> There are " . $rowTbl['count(donor_id)'] . " users registered as Donors </td>";
                            echo "<td>" . "<a href='admin_donorview.php' class='btn btn-secondary'>
                            <i class='fas fa-angle-double-right'></i> Details</a>" . "</td>";
                            echo "<td>" . "<a href='pdfdonor.php' class='btn btn-success'>download</a>" . "</td>";
                            echo "<td></td>";
                            echo "</tr>";  
                        ?>
                        <?php
                        $resTable = mysqli_query($conn,"SELECT count(patient_id) FROM tb_patient");
                        $rowTbl = mysqli_fetch_array($resTable);
                            echo "<tr>";
                            echo "<td><b>Total Number of Patients</b></td>";
                            echo "<td> There are " . $rowTbl['count(patient_id)'] . " users registered as Patients </td>";
                            echo "<td>" . "<a href='admin_patientview.php' class='btn btn-secondary'>
                            <i class='fas fa-angle-double-right'></i> Details</a>" . "</td>";
                            echo "<td>" . "<a href='pdfpatients.php' class='btn btn-success'>download</a>" . "</td>";
                            echo "<td></td>";
                            echo "</tr>"; 
                        ?>      
                        <?php
                        $resTable = mysqli_query($conn,"SELECT count(blood_id) FROM tb_bloodavailability");
                        $rowTbl = mysqli_fetch_array($resTable);
                            echo "<tr>";
                            echo "<td><b>Total Blood Types Stored in Blood Bank</b></td>";
                            echo "<td> There are " . $rowTbl['count(blood_id)'] . " Blood Types stored </td>";
                            echo "<td>" . "<a href='admin_bloodview.php' class='btn btn-secondary'>
                            <i class='fas fa-angle-double-right'></i> Details</a>" . "</td>";
                            echo "<td>" . "<a href='pdfbloodtype.php' class='btn btn-success'>download</a>" . "</td>";
                            echo "<td></td>";
                            echo "</tr>";
                        ?>
                        <?php
                        $resTable = mysqli_query($conn,"SELECT sum(quantity) FROM tb_bloodavailability");
                        $rowTbl = mysqli_fetch_array($resTable);
                            echo "<tr>";
                            echo "<td><b>Total Blood Availability</b></td>";
                            echo "<td> There are " . $rowTbl['sum(quantity)'] . " Blood Pint stored </td>";
                            echo "<td>" . "<a href='admin_bloodavailability.php' class='btn btn-secondary'>
                            <i class='fas fa-angle-double-right'></i> Details</a>" . "</td>";
                            echo "<td>" . "<a href='pdfavailability.php' class='btn btn-success'>download</a>" . "</td>";
                            echo "<td></td>";
                            echo "</tr>";
                            
                        ?>
                        <?php
                        $resTable = mysqli_query($conn,"SELECT count(msg) FROM tb_bloodrequest WHERE msg = 'PENDING'");
                        $rowTbl = mysqli_fetch_array($resTable);
                            echo "<tr>";
                            echo "<td><b>Total Number of Blood Request</b></td>";
                            echo "<td> There are currently " . $rowTbl['count(msg)'] . " Requests </td>";
                            echo "<td>" . "<a href='admin_bloodrequest.php' class='btn btn-secondary'>
                            <i class='fas fa-angle-double-right'></i> Details</a>" . "</td>";
                            echo "<td>" . "<a href='pdfrequest.php' class='btn btn-success'>download</a>" . "</td>";
                            echo "<td></td>";
                            echo "</tr>";
                        ?>   
                        <?php
                        $resTable = mysqli_query($conn,"SELECT count(controlno) FROM tb_bloodapproval");
                        $rowTbl = mysqli_fetch_array($resTable);
                            echo "<tr>";
                            echo "<td><b>Total Number of Approved Request</b></td>";
                            echo "<td> There are currently " . $rowTbl['count(controlno)'] . " requests that has been approved</td>";
                            echo "<td>" . "<a href='admin_bloodapproval.php' class='btn btn-secondary'>
                            <i class='fas fa-angle-double-right'></i> Details</a>" . "</td>";
                            echo "<td>" . "<a href='pdfapproved.php' class='btn btn-success'>download</a>" . "</td>";
                            echo "<td></td>";
                            echo "</tr>";
                        ?> 
                        <?php
                        $resTable = mysqli_query($conn,"SELECT count(msg) FROM tb_bloodrequest WHERE msg = 'DECLINED'");
                        $rowTbl = mysqli_fetch_array($resTable);
                            echo "<tr>";
                            echo "<td><b>Total Number of Declined Blood Request</b></td>";
                            echo "<td> There are currently " . $rowTbl['count(msg)'] . " that has been declined </td>";
                            echo "<td>" . "<a href='admin_declinedrequest.php' class='btn btn-secondary'>
                            <i class='fas fa-angle-double-right'></i> Details</a>" . "</td>";
                            echo "<td>" . "<a href='pdfdecline.php' class='btn btn-success'>download</a>" . "</td>";
                            echo "<td></td>";
                            echo "</tr>";
                        ?>   
                        
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
         </div>
      </section>
      <!-- FOOTER -->
      <footer id="main-footer" class="bg-dark text-white mt-5 p-5">
         <div class="container">
            <div class="row">
               <div class="col">
                  <p class="lead text-center">
                     Copyright &copy;
                     <span id="year"></span>
                     BloodBank
                  </p>
               </div>
            </div>
         </div>
      </footer>
      <!-- MODALS -->
      <!-- ADD DONOR MODAL -->
      <div class="modal fade text-dark bd-example-modal-lg" id="addDonorModal">
         <div class="modal-dialog modal-lg">
            <div class="modal-content">
               <div class="modal-header">
                  <!--REGISTER FORM-->
                  <h5 class="modal-title w-100 text-center">DONOR REGISTRATION</h5>
                  <button class="close" data-dismiss="modal">
                  <span>&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <p class="text-center">Fill out the form below to add a donor.</p>
                  <form name="donorform" onsubmit="validateForm()" class="needs-validation" novalidate action = "admin.php" method="POST">
                     <div class="container">
                        <div class="row">
                           <div class="col">
                              <div class="form-group">
                                 <!--firstname-->
                                 <input type="text" class="form-control" id="validation-fname" name="fname" placeholder="Firstname" required>
                                 <div class="invalid-feedback">
                                    Firstname cannot be blank.
                                 </div>
                              </div>
                              <div class="form-group">
                                 <!--contact number-->
                                 <input type="tel" name = "contactnum" id = "validation-contactnum" maxlength = "11" class="form-control" placeholder="Contact Number" pattern="[0]{1}[9]{1}[0-9]{9}" required>
                                 <div class="invalid-feedback">
                                    Enter a valid contact number. Ex: 09XXXXXXXXX.
                                 </div>
                              </div>
                           </div>
                           <div class="col">
                              <div class="form-group">
                                 <!--lastname-->
                                 <input type="text" name = "lname" id = "validation-lname" class="form-control" placeholder="Lastname" required>
                                 <div class="invalid-feedback">
                                    Lastname cannot be blank.
                                 </div>
                              </div>
                              <!--address-->
                              <div class="form-group">
                                 <select class="form-control" name="address">
                                    <option disabled selected>--Select your City Address--</option>
                                    <option value="Manila">Manila</option>
                                    <option value="Pasig">Pasig</option>
                                    <option value="Mandaluyong">Mandaluyong</option>
                                    <option value="San Juan">San Juan</option>
                                    <option value="Makati">Makati</option>
                                    <option value="Quezon City">Quezon City</option>
                                    <option value="Malabon">Malabon</option>
                                    <option value="Pasay">Pasay</option>
                                    <option value="Caloocan">Caloocan</option>
                                    <option value="Parañaque">Parañaque</option>
                                    <option value="Muntinlupa">Muntinlupa</option>
                                    <option value="Taguig">Taguig</option>
                                    <option value="Las Piñas">Las Piñas</option>
                                 </select>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col">
                        <div class="form-group">
                           <div class="row">
                              <!--birthdate-->
                              <div class="column-1">Birthdate</div>
                              <div class="form-control-date">
                                 <input type="date" name = "birthdate" id="validation-birthday" class="form-control" placeholder="birthday" required>
                                 <div class="invalid-feedback">
                                    Birthdate cannot be blank .
                                 </div>
                              </div>
                              <!--gender-->
                              <div class="column-hg">Gender</div>
                              <div class="column-g">
                                 <select class="form-control" name="gender" id="validation-gender" required>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                 </select>
                                 <div class="invalid-feedback">
                                    Please choose gender.
                                 </div>
                              </div>
                              <!--bloodtype-->
                              <div class="column-hb">Blood Type</div>
                              <div class="column">
                                 <select class="form-control" name="bloodtype" id="validation-bloodtype" required>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="AB">AB</option>
                                    <option value="O">O</option>
                                 </select>
                                 <div class="invalid-feedback">
                                    Please choose your blood type.
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="container">
                        <div class="row">
                           <div class="col">
                              <div class="form-group">
                                 <!--email-->
                                 <input onkeyup="check()" type="text" name ="email" id = "validation-email" class="form-control" placeholder="Email" required>
                                 <div class="invalid-feedback">
                                    Please enter a valid email.
                                 </div>
                              </div>
                              <div class="form-group">
                                 <!--password-->
                                 <input type="password" name="password" id = "validation-password" class="form-control" placeholder="Password" required>
                                 <div class="invalid-feedback">
                                    Password cannot be blank.
                                 </div>
                              </div>
                           </div>
                           <div class="col">
                              <div class="input-group mb-3">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">@</span>
                                 </div>
                                 <!--username-->
                                 <input type="text" class="form-control" name="username" id = "validation-username" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" required>
                                 <div class="invalid-feedback">
                                    Username cannot be blank.
                                 </div>
                              </div>
                              <div class="form-group">
                                 <!--confirm password-->
                                 <input onkeyup="checkPass()" type = "password" name="confirm-password" id = "validation-confirmpassword" class="form-control" placeholder="Confirm-Password" required>
                                 <div class="invalid-feedback">
                                    <p id="conpass">Password cannot be blank.</p>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="modal-footer">
                        <!--register button-->
                        <button type="submit" name = "addDonor" class="btn btn-danger btn-block">Register Donor</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <!-- ADD PATIENT MODAL -->
      <div class="modal fade text-dark bd-example-modal-lg" id="addPatientModal">
         <div class="modal-dialog modal-lg">
            <div class="modal-content">
               <div class="modal-header">
                  <!--REGISTER FORM-->
                  <h5 class="modal-title w-100 text-center">PATIENT REGISTRATION</h5>
                  <button class="close" data-dismiss="modal">
                  <span>&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <p class="text-center">Fill out the form below to add a patient.</p>
                  <form name="patientform" onsubmit="validateForm()" class="needs-validation" novalidate action = "admin.php" method="POST">
                     <div class="container">
                        <div class="row">
                           <div class="col">
                              <div class="form-group">
                                 <!--firstname-->
                                 <input type="text" class="form-control" id="validation-fname" name="fname" placeholder="Firstname" required>
                                 <div class="invalid-feedback">
                                    Firstname cannot be blank.
                                 </div>
                              </div>
                              <div class="form-group">
                                 <!--contact number-->
                                 <input type="tel" name = "contactnum" id = "validation-contactnum" maxlength = "11" class="form-control" placeholder="Contact Number" pattern="[0]{1}[9]{1}[0-9]{9}" required>
                                 <div class="invalid-feedback">
                                    Enter a valid contact number. Ex: 09XXXXXXXXX.
                                 </div>
                              </div>
                           </div>
                           <div class="col">
                              <div class="form-group">
                                 <!--lastname-->
                                 <input type="text" name = "lname" id = "validation-lname" class="form-control" placeholder="Lastname" required>
                                 <div class="invalid-feedback">
                                    Lastname cannot be blank.
                                 </div>
                              </div>
                              <!--address-->
                              <div class="form-group">
                                 <select class="form-control" name="address">
                                    <option disabled selected>--Select your City Address--</option>
                                    <option value="Manila">Manila</option>
                                    <option value="Pasig">Pasig</option>
                                    <option value="Mandaluyong">Mandaluyong</option>
                                    <option value="San Juan">San Juan</option>
                                    <option value="Makati">Makati</option>
                                    <option value="Quezon City">Quezon City</option>
                                    <option value="Malabon">Malabon</option>
                                    <option value="Pasay">Pasay</option>
                                    <option value="Caloocan">Caloocan</option>
                                    <option value="Parañaque">Parañaque</option>
                                    <option value="Muntinlupa">Muntinlupa</option>
                                    <option value="Taguig">Taguig</option>
                                    <option value="Las Piñas">Las Piñas</option>
                                 </select>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col">
                        <div class="form-group">
                           <div class="row">
                              <!--birthdate-->
                              <div class="column-1">Birthdate</div>
                              <div class="form-control-date">
                                 <input type="date" name = "birthdate" id="validation-birthday" class="form-control" placeholder="birthday" required>
                                 <div class="invalid-feedback">
                                    Birthdate cannot be blank .
                                 </div>
                              </div>
                              <!--gender-->
                              <div class="column-hg">Gender</div>
                              <div class="column-g">
                                 <select class="form-control" name="gender" id="validation-gender" required>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                 </select>
                                 <div class="invalid-feedback">
                                    Please choose gender.
                                 </div>
                              </div>
                              <!--bloodtype-->
                              <div class="column-hb">Blood Type</div>
                              <div class="column">
                                 <select class="form-control" name="bloodtype" id="validation-bloodtype" required>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="AB">AB</option>
                                    <option value="O">O</option>
                                 </select>
                                 <div class="invalid-feedback">
                                    Please choose your blood type.
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="container">
                        <div class="row">
                           <div class="col">
                              <div class="form-group">
                                 <!--email-->
                                 <input onkeyup="check()" type="text" name ="email" id = "validation-email" class="form-control" placeholder="Email" required>
                                 <div class="invalid-feedback">
                                    Please enter a valid email.
                                 </div>
                              </div>
                              <div class="form-group">
                                 <!--password-->
                                 <input type="password" name="password" id = "validation-password" class="form-control" placeholder="Password" required>
                                 <div class="invalid-feedback">
                                    Password cannot be blank.
                                 </div>
                              </div>
                           </div>
                           <div class="col">
                              <div class="input-group mb-3">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">@</span>
                                 </div>
                                 <!--username-->
                                 <input type="text" class="form-control" name="username" id = "validation-username" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" required>
                                 <div class="invalid-feedback">
                                    Username cannot be blank.
                                 </div>
                              </div>
                              <div class="form-group">
                                 <!--confirm password-->
                                 <input onkeyup="checkPass()" type = "password" name="confirm-password" id = "validation-confirmpassword" class="form-control" placeholder="Confirm-Password" required>
                                 <div class="invalid-feedback">
                                    <p id="conpass">Password cannot be blank.</p>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="modal-footer">
                        <!--register button-->
                        <button type="submit" name = "addPatient" class="btn btn-info btn-block">Register Patient</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
         crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
         crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
         crossorigin="anonymous"></script>
      <script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
      <script>
                // Example starter JavaScript for disabling form submissions if there are invalid fields
                (function () {
              'use strict'
              // Fetch all the forms we want to apply custom Bootstrap validation styles to
              var forms = document.querySelectorAll('.needs-validation')
              // Loop over them and prevent submission
              Array.prototype.slice.call(forms)
                 .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                       event.preventDefault()
                       event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                    }, false)
                 })
              })()
      </script>
      <script>
         // Get the current year for the copyright
         $('#year').text(new Date().getFullYear());
         
         CKEDITOR.replace('editor1');
              
              //EMAIL VALIDATION
              const email = document.querySelector("#validation-email");
              let regExp = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
              function check(){
              if(email.value.match(regExp)) {
                 email.style.borderColor = "#CED4DA";
              } else { 
                 email.style.borderColor = "#e74c3c";
              }
              }
              //PASSWORD VALIDATION
              var password = document.querySelector("#validation-password");
              var confirmPassword = document.querySelector("#validation-confirmpassword");
              function checkPass() {
              if (confirmPassword.value === password.value) {
                 confirmPassword.style.borderColor = "#27ae60";
              } else {
                 confirmPassword.style.borderColor = "#e74c3c";
                 document.getElementById("conpass").innerHTML = "Passwords do not match.";
              } 
              }
      </script>
   </body>
</html>