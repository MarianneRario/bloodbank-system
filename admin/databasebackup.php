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
                     <a href="admin.php" class="nav-link">Dashboard</a>
                  </li>
                  <li class="nav-item px-2">
                     <a href="admin_donorview.php" class="nav-link">Donor</a>
                  </li>
                  <li class="nav-item px-2">
                     <a href="admin_patientview.php" class="nav-link">Patient</a>
                  </li>
                  <li class="nav-item px-2">
                     <a href="databasebackup.php" class="nav-link active">Database Backup & Recovery</a>
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
                     <i class="fas fa-lock"></i> Admin
                  </h1>
               </div>
            </div>
         </div>
      </header>
      <!-- POSTS -->
      <section id="posts">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
               <br>
               <br>
               <div class="jumbotron">
                    <h1 class="display-4">Database Backup and Recovery</h1>
                    <p class="lead">Having a database backup and recovery function is the important in backing up your data in the event of a loss. 
                    It is also essential in setting up secure systems that allow you to recover your data as a result. Data backup requires the copying 
                    and archiving of computer data to make it accessible in case of data corruption or deletion.</p>
                    <hr class="my-4">
                    <p>Have your database backed up including database tables and updated information. Just click the download button at the bottom.</p>
                    <p class="lead">
                        <a class="btn btn-primary btn-lg" href="export.php" role="button">Download</a>
                    </p>
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