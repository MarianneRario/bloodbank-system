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
            <a href="donor.php" class="navbar-brand">Donor Dashboard</a>
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
                        <a href="profile.php" class="dropdown-item">
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
               <div class="col-md-9">
                  <h1>
                     <i class="fas fa-user"></i> Welcome, <?php echo $row['username'].'!' ?>
                  </h1>
               </div>
            </div>
         </div>
      </header>
      <!-- ACTIONS -->
      <section id="actions" class="py-4 mb-4 bg-light">
         <div class="container">
            <div class="row">
               <div class="col-md-9">
                  <a href="#" class="btn btn-danger btn-block" data-toggle="modal" data-target="#addPostModal">
                  <i class="fas fa-plus"></i> Add Donation
                  </a>
               </div>
            </div>
         </div>
      </section>
      <!-- POSTS -->
      <section id="posts">
         <div class="container">
            <div class="row">
               <div class="col-md-9">
                  <div class="card">
                     <div class="card-header">
                        <h4>Donations</h4>
                     </div>
                     <table class="table table-striped">
                        <thead class="thead-dark">
                           <tr>
                              <th>Donation ID</th>
                              <th>Blood Pint</th>
                              <th>Date</th>
                           </tr>
                        </thead>
                        <tbody>
                        <?php
                        $resTable = mysqli_query($conn,"SELECT donation_id, blood_pint, date_donated FROM tb_blooddonation WHERE donor_id = '$id'");
                        while($rowTbl = mysqli_fetch_array($resTable)){
                            echo "<tr>";
                            echo "<td>" . $rowTbl['donation_id'] . "</td>";
                            echo "<td>" . $rowTbl['blood_pint'] . ' pt'. "</td>";
                            echo "<td>" . $rowTbl['date_donated'] . "</td>";
                            echo "</tr>";
                            }
                        ?>
                        </tbody>
                     </table>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="card text-center bg-danger text-white mb-3">
                     <div class="card-body">
                        <h3>Total Blood Pint</h3>
                        <h4 class="display-4">
                           <i class="fa fa-tint" aria-hidden="true"></i> <?php echo $res['sum(blood_pint)'] ?>
                        </h4>
                     </div>
                  </div>
                  <div class="card text-center bg-warning text-white mb-3">
                     <div class="card-body">
                        <h3>Total Donation</h3>
                        <h4 class="display-4">
                           <i class="fas fa-users"></i> <?php echo $resCount['count(donor_id)'] ?>
                        </h4>
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
      <!-- ADD POST MODAL -->
      <div class="modal fade" id="addPostModal">
         <div class="modal-dialog modal-lg">
            <div class="modal-content">
               <div class="modal-header bg-danger text-white">
                  <h5 class="modal-title">DONATE A BLOOD, SAVE A LIFE</h5>
                  <button class="close" data-dismiss="modal">
                  <span>&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <form name="donor-form" method="POST">
                     <div class="row">
                        <div class="col">
                           <!--firstname-->
                           <div class="form-group row">
                              <label class="col-sm-3 col-form-label">Firstname</label>
                              <div class="col-sm">
                                 <input type="text" class="form-control"  name="fname" value="<?php echo $row['first_name'] ?>" readonly >
                              </div>
                           </div>
                           <!--email-->
                           <div class="form-group row">
                              <label class="col-sm-3 col-form-label">Username</label>
                              <div class="col-sm">
                                 <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text" id="basic-addon1">@</span>
                                    </div>
                                    <input type="text" class="form-control" name="username" id = "validation-username" aria-label="Username" aria-describedby="basic-addon1" value="<?php echo $row['username'] ?>" readonly>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col">
                           <div class="form-group row">
                              <label class="col-sm-3 col-form-label">Lastname</label>
                              <div class="col-sm">
                                 <input type="text" class="form-control"  name="lname" value="<?php echo $row['last_name'] ?>" readonly >
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-3 col-form-label">Email</label>
                              <div class="col-sm">
                                 <input type="text" class="form-control"  name="email" value="<?php echo $row['email'] ?>" readonly >
                              </div>
                           </div>
                        </div>
                     </div>
                     <p class="lead">BLOOD INFORMATION</p>
                     <div class="row">
                     <div class="col">
                           <!--donorId-->
                           <div class="form-group row">
                              <label class="col-sm-3 col-form-label">ID #</label>
                              <div class="col-sm">
                                 <input type="text" class="form-control"  name="id" value="<?php echo $row['donor_id'] ?>" readonly >
                              </div>
                           </div>
                        </div>
                        <div class="col">
                           <!--bloodtype-->
                           <div class="form-group row">
                              <label class="col-sm-3 col-form-label">Type</label>
                              <div class="col-sm">
                                 <input type="text" class="form-control"  name="bloodtype" value="<?php echo $row['bloodtype'] ?>" readonly >
                              </div>
                           </div>
                        </div>
                        <div class="col">
                           <div class="form-group row">
                              <label class="col-sm-3 col-form-label">Pint</label>
                              <div class="col-sm">
                                 <input type="number" class="form-control"  name="bloodpint" min="1" max="2" placeholder="Blood Pint" >
                              </div>
                           </div>
                        </div>
                     </div>
               </div>
               <div class="modal-footer">
               <!--donate button-->
               <button type="submit" name = "donate" class="btn btn-primary btn-block">DONATE</button>
               </div>
               </form>
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
         // Get the current year for the copyright
         $('#year').text(new Date().getFullYear());
         
         CKEDITOR.replace('editor1');
      </script>
   </body>
</html>