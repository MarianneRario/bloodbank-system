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
      <link rel="stylesheet" href="css/style.css">
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
                     <a href="admin_patientview.php" class="nav-link active">Patient</a>
                  </li>
                  <li class="nav-item px-2">
                     <a href="databasebackup.php" class="nav-link">Database Backup & Recovery</a>
                  </li>
               </ul>
               <ul class="navbar-nav ml-auto">
                  <li class="nav-item dropdown mr-3">
                     <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                     <i class="fas fa-user"></i> Welcome <?php echo $row['username'] ?>
                     </a>
                     <div class="dropdown-menu">
                        <a href="#" class="dropdown-item">
                        <i class="fas fa-user-circle"></i> Profile
                        </a>
                        <a href="#" class="dropdown-item">
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
      <?php 
         $id = $_SESSION["id"];
         $sql1 = "SELECT * FROM tb_patient WHERE patient_id = '$id'";
         $result1 = mysqli_query($conn, $sql1);
         $resultCheck1 = mysqli_num_rows($result1);
         $row1 = mysqli_fetch_assoc($result1);

         $sqlID = "SELECT sum(blood_pint) FROM tb_bloodrequest WHERE patient_id = '$id'";
         $sqlIDCheck = mysqli_query($conn, $sqlID);
         $res = mysqli_fetch_assoc($sqlIDCheck);
         
         $sqlCount = "SELECT count(patient_id) FROM tb_bloodrequest WHERE patient_id = '$id'";
         $sqlCountCheck = mysqli_query($conn, $sqlCount);
         $resCount = mysqli_fetch_assoc($sqlCountCheck);
         ?>      
      <header id="main-header" class="py-2 bg-primary text-white">
         <div class="container">
            <div class="row">
               <div class="col-md-6">
                  <h1>
                     <i class="fas fa-user-edit"></i> Edit Profile Data
                  </h1>
               </div>
            </div>
         </div>
      </header>
      <!-- ACTIONS -->
      <section id="actions" class="py-4 mb-4 bg-light">
         <div class="container">
            <div class="row">
               <div class="col-md-3">
                  <a href="admin.php" class="btn btn-light btn-block">
                  <i class="fas fa-arrow-left"></i> Back To Dashboard
                  </a>
               </div>
            </div>
         </div>
      </section>
      <!-- PROFILE -->
      <section id="profile">
         <div class="container">
            <div class="row">
               <div class="col-md">
                  <div class="card">
                     <div class="card-header">
                        <h4>Your Profile</h4>
                     </div>
                     <div class="card-body">
                        <form method = "post">
                           <div class="form-row">
                              <div class="form-group col-md-6">
                                 <label for="inputEmail4">Firstname</label>
                                 <input type="text" name="fname" class="form-control" value="<?php echo $row1['first_name'] ?>">
                              </div>
                              <div class="form-group col-md-6">
                                 <label for="inputPassword4">Lastname</label>
                                 <input type="text" name="lname" class="form-control" value="<?php echo $row1['last_name'] ?>">
                              </div>
                           </div>
                           <div class="form-row">
                              <div class="form-group col-md-6">
                                 <label for="inputEmail4">Email</label>
                                 <input type="text" name="email" class="form-control" value="<?php echo $row1['email'] ?>">
                              </div>
                              <div class="form-group col-md-6">
                                 <label for="inputPassword4">Username</label>
                                 <input type="text" name="username" class="form-control" value="<?php echo $row1['username'] ?>" >
                              </div>
                           </div>
                           <div class="form-row">
                              <div class="form-group col-md-6">
                                 <label for="inputEmail4">Password</label>
                                 <input type="text" name="password" class="form-control" value="<?php echo $row1['password'] ?>">
                              </div>
                              <div class="form-group col-md-6">
                                 <label for="inputEmail4">Contact Number</label>
                                 <input type="text" name="contactno" class="form-control" value="<?php echo $row1['contactnum'] ?>">
                              </div>
                           </div>
                           <div class="form-row">
                              <div class="form-group col-md-6">
                                 <label for="inputEmail4">Birthdate</label>
                                 <input type="text" class="form-control" value="<?php echo $row1['birthdate'] ?>" readonly>
                              </div>
                              <div class="form-group col-md-6">
                                 <label for="inputPassword4">Date Registered</label>
                                 <input type="text" class="form-control" value="<?php echo $row1['registration_date'] ?>" readonly>
                              </div>
                           </div>
                           <br>
                           <h4>Blood Information</h4>
                           <hr>
                           <div class="form-row">
                              <div class="form-group col-md-6">
                                 <label for="inputEmail4">Patient Id</label>
                                 <input type="text" name = "id" class="form-control" value="<?php echo $row1['patient_id'] ?>" readonly>
                              </div>
                              <div class="form-group col-md-6">
                                 <label for="inputPassword4">Blood Type</label>
                                 <input type="text" class="form-control" value="<?php echo $row1['bloodtype'] ?>" readonly>
                              </div>
                           </div>
                           <div class="form-row">
                              <div class="form-group col-md-6">
                                 <label for="inputEmail4">Total Blood Request Made</label>
                                 <input type="email" class="form-control" value = "<?php echo $resCount['count(patient_id)'] ?>" readonly>
                              </div>
                              <div class="form-group col-md-6">
                                 <label for="inputPassword4">Total Blood Pint Requested</label>
                                 <input type="text" class="form-control" value = "<?php echo $res['sum(blood_pint)'] ?>" readonly>
                              </div>
                           </div>
                           <br>
                           <button type="submit" name="savepatientdata" class="btn btn-success btn-block">
                           <i class="fas fa-check"></i>
                           SAVE DATA
                           </button>
                           <button type="submit" name="deletepatientdata" class="btn btn-danger btn-block">
                           <i class="fas fa-lock"></i>
                           DELETE USER
                           </button>
                        </form>
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
         // Get the current year for the copyright
         $('#year').text(new Date().getFullYear());
         
         CKEDITOR.replace('editor1');
      </script>
   </body>
</html>