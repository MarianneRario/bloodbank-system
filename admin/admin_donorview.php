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
                     <a href="#" class="nav-link active">Donor</a>
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
                     <a href="databasebackup.php" class="nav-link toggle" data-toggle="">
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
      <!-- SEARCH -->
      <section id="search" class="py-4 mb-4 bg-light">
      <div class="container">
      <form class="" method="post">
         <div class="row">
            <div class="col-md-6 ml-auto mb-4">
               <div class="input-group">
               <form class="form-inline" method="post">
                  <input type="text" name="id" class="form-control" placeholder="Search by Id...">
                  <div class="input-group-append">
                     <button name="searchDonor" class="btn btn-primary">Search</button>
                  </div>
               </div>
            </div>
         </div>
         </div>
      </div>
      <!-- TABLE -->
      <section id="donor_table">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="card">
                     <div class="card-header">
                        <h4>Lists of Donors</h4>
                     </div>
                     <table class="table table-striped">
                        <thead class="thead-dark">
                           <tr>
                              <th>Donor Id</th>
                              <th>Username</th>
                              <th>Firstname</th>
                              <th>Lastname</th>
                              <th>Email</th>
                              <th>Blood Type</th>
                              <th></th>
                              <th></th>
                              <th></th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                              $resTable = mysqli_query($conn,"SELECT * FROM tb_donor");
                              while($rowTbl = mysqli_fetch_array($resTable)){
                                  echo "<tr>";
                                  echo "<tr>";
                                  echo "<td>" . $rowTbl['donor_id'] . "</td>";
                                  echo "<td>" . $rowTbl['username'] . "</td>";
                                  echo "<td>" . $rowTbl['first_name'] . "</td>";
                                  echo "<td>" . $rowTbl['last_name'] . "</td>";
                                  echo "<td>" . $rowTbl['email'] . "</td>";
                                  echo "<td>" . $rowTbl['bloodtype'] . "</td>";
                                  echo "</tr>";
                                  }
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