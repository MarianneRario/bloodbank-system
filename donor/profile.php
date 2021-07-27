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
         
         $sql = "SELECT * FROM tb_donor WHERE email = '$e' AND password = '$p'";
         $result = mysqli_query($conn, $sql);
         $resultCheck = mysqli_num_rows($result);
         $row = mysqli_fetch_assoc($result);
         
         $id = $row['donor_id'];
         $sqlID = "SELECT sum(blood_pint) FROM tb_blooddonation WHERE donor_id = '$id'";
         $sqlIDCheck = mysqli_query($conn, $sqlID);
         $res = mysqli_fetch_assoc($sqlIDCheck);
         
         $sqlCount = "SELECT count(donor_id) FROM tb_blooddonation WHERE donor_id = '$id'";
         $sqlCountCheck = mysqli_query($conn, $sqlCount);
         $resCount = mysqli_fetch_assoc($sqlCountCheck);
         
         ?>
      <nav class="navbar navbar-expand-sm navbar-dark bg-dark p-0">
         <div class="container">
            <a href="index.html" class="navbar-brand">Donor Dashboard</a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
               <ul class="navbar-nav ml-auto">
                  <li class="nav-item dropdown mr-3">
                     <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                     <i class="fas fa-user"></i> <?php echo $row['username'] ?>
                     </a>
                     <div class="dropdown-menu">
                        <a href="profile.html" class="dropdown-item">
                        <i class="fas fa-user-circle"></i> Profile
                        </a>
                        <a href="editProfile.php" class="dropdown-item">
                        <i class="fas fa-cog"></i> Edit Data
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
                     <i class="fas fa-user"></i> Profile
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
                  <a href="donor.php" class="btn btn-light btn-block">
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
                        <form>
                           <div class="form-row">
                              <div class="form-group col-md-6">
                                 <label for="inputEmail4">Firstname</label>
                                 <input type="text" class="form-control" id="inputEmail4" value="<?php echo $row['first_name'] ?>" readonly>
                              </div>
                              <div class="form-group col-md-6">
                                 <label for="inputPassword4">Lastname</label>
                                 <input type="text" class="form-control" id="inputPassword4" value="<?php echo $row['last_name'] ?>" readonly>
                              </div>
                           </div>
                           <div class="form-row">
                              <div class="form-group col-md-6">
                                 <label for="inputEmail4">Email</label>
                                 <input type="text" class="form-control" id="inputEmail4" value="<?php echo $row['email'] ?>" readonly>
                              </div>
                              <div class="form-group col-md-6">
                                 <label for="inputPassword4">Username</label>
                                 <input type="text" class="form-control" id="inputPassword4" value="<?php echo $row['username'] ?>" readonly>
                              </div>
                           </div>
                           <div class="form-row">
                              <div class="form-group col-md-6">
                                 <label for="inputEmail4">Birthdate</label>
                                 <input type="text" class="form-control" id="inputEmail4" value="<?php echo $row['birthdate'] ?>" readonly>
                              </div>
                              <div class="form-group col-md-6">
                                 <label for="inputPassword4">City Address</label>
                                 <input type="text" class="form-control" id="inputPassword4" value="<?php echo $row['address'] ?>" readonly>
                              </div>
                           </div>
                           <div class="form-row">
                              <div class="form-group col-md-6">
                                 <label for="inputEmail4">Gender</label>
                                 <input type="text" class="form-control" id="inputEmail4" value="<?php echo $row['gender'] ?>" readonly>
                              </div>
                              <div class="form-group col-md-6">
                                 <label for="inputPassword4">Date Registered</label>
                                 <input type="text" class="form-control" id="inputPassword4" value="<?php echo $row['registration_date'] ?>" readonly>
                              </div>
                           </div>
                           <br>
                           <h4>Blood Information</h4>
                           <hr>
                           <div class="form-row">
                              <div class="form-group col-md-6">
                                 <label for="inputEmail4">Donor Id</label>
                                 <input type="text" class="form-control" id="inputEmail4" value="<?php echo $row['donor_id'] ?>" readonly>
                              </div>
                              <div class="form-group col-md-6">
                                 <label for="inputPassword4">Blood Type</label>
                                 <input type="text" class="form-control" id="inputPassword4" value="<?php echo $row['bloodtype'] ?>" readonly>
                              </div>
                           </div>
                           <div class="form-row">
                              <div class="form-group col-md-6">
                                 <label for="inputEmail4">Total Blood Donation</label>
                                 <input type="email" class="form-control" id="inputEmail4" value = "<?php echo $resCount['count(donor_id)'] ?>" readonly>
                              </div>
                              <div class="form-group col-md-6">
                                 <label for="inputPassword4">Total Blood Pint Donated</label>
                                 <input type="text" class="form-control" id="inputPassword4" value = "<?php echo $res['sum(blood_pint)'] ?>" readonly>
                              </div>
                           </div>
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