<?php include('server.php'); ?>
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
      <link rel="preconnect" href="https://fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
      <link rel="preconnect" href="https://fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
      <link rel="preconnect" href="https://fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&family=Roboto:wght@500&display=swap" rel="stylesheet">
      <link rel="preconnect" href="https://fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
      <title>BloodBank</title>
   </head>
   <body data-spy="scroll" data-target="#main-nav" id="home">
      <nav class="navbar navbar-expand-sm fixed-top" id="main-nav">
         <div class="container">
            <a href="index.html" class="navbar-brand"><b>
            <span class="blood">Blood</span><span class="bank">Bank</span></b></a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
            </button>
         </div>
      </nav>
      <header id="home-section">
         <div>
            <div class="home-inner container">
               <div class="row">
                  <div class="col-lg-8 d-none d-lg-block">
                     <span class="gift">The gift of Blood </span><br>
                     <span class="life">is a gift of Life</span>
                     <div class="d-flex">
                        <div class="par">
                           Let’s start doing your bit for the world. Join us as a volunteer. <br>
                           1 blood donor can save up to 3 lives. Donate your blood for a reason, <br>
                           let the reason be life.
                        </div>
                     </div>
                     <div class="d-flex">
                        <div class="align-self-start">
                           <span>
                           <button type="button" data-toggle="modal" data-target="#loginModal" 
                              class="login-btn">Log In</button>
                           </span>
                        </div>
                        <span>
                        <a href="#">
                        <button type="button" data-toggle="modal" data-target="#signupModal" 
                           class="signup-btn">Sign Up</button>
                        </a>
                        </span>
                     </div>
                  </div>
                  <div class="col-lg-4">
                     <div class="img-home">
                        <div class="description-container">
                           <img src="img/cover.png" alt="" class="img-ribbon">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </header>
      <footer id="main-footer" class="bg-dark">
         <div class="container">
            <div class="row">
               <div class="col text-center py-4">
                  <h6>BloodBank</h6>
                  <p>Copyright &copy;
                     <span id="year"></span>
                  </p>
               </div>
            </div>
         </div>
      </footer>
      <div class="modal fade text-dark mt-5" id="loginModal">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title w-100 text-center">Log In to Your Account</h5>
                  <button class="close" data-dismiss="modal">
                  <span>&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <!--ERROR VALIDATIONS-->
                  <?php include('errors.php') ?>
                  <!--LOGIN FORM-->
                  <form name="login-form" onsubmit="validateForm()" class="needs-validation" novalidate action = "index.php" method="POST">
                     <div class="container">
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                           <!--usertype-->
                           <label class="btn btn-secondary">
                           <input type="radio" name="user" value="donor" autocomplete="off" required> Donor
                           </label>
                           <label class="btn btn-secondary">
                           <input type="radio" name="user" value="patient" autocomplete="off" required> Patient
                           </label>
                        </div>
                     </div>
                     <!--email-->
                     <div class="form-group">
                        <input type="text" name="email" class="form-control" placeholder="Email" required>
                        <div class="invalid-feedback">
                                    <p id="conpass">E-mail cannot be blank.</p>
                                 </div>
                     </div>
                     <!--password-->
                     <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                        <div class="invalid-feedback">
                                    <p id="conpass">Password cannot be blank.</p>
                                 </div>
                     </div>
                     <!--login button-->
                     <div class="">
                        <button type="submit" name = "login" class="btn btn-danger btn-block">Log In</button>
                     </div>
                  </form>
               </div>
               <div class="ml-3">
                  <a href="#">
                     <p class="text-muted">Forgot your Password?</p>
                  </a>
               </div>
            </div>
         </div>
      </div>
      <div class="modal fade text-dark bd-example-modal-lg" id="signupModal">
         <div class="modal-dialog modal-lg">
            <div class="modal-content">
               <div class="modal-header">
                  <!--REGISTER FORM-->
                  <h5 class="modal-title w-100 text-center">REGISTER</h5>
                  <button class="close" data-dismiss="modal">
                  <span>&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <p class="text-center">Create your account. It's free and only takes a minute.</p>
                  <form name="registration-form" onsubmit="validateForm()" class="needs-validation" novalidate action = "index.php" method="POST">
                     <div class="container">
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                           <!--usertype-->
                           <label class="btn btn-outline-secondary">
                           <input type="radio" name="usertype" value="donor" id="validation-usertype" autocomplete="off"> Donor
                           </label>
                           <label class="btn btn-outline-secondary">
                           <input type="radio" name="usertype" value="patient" id="validation-usertype" autocomplete="off"> Patient
                           </label>
                           <div class="invalid-feedback">
                              Please choose usertype.
                           </div>
                        </div>
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
                        <button type="submit" name = "register" class="btn btn-primary btn-block">Register</button>
                     </div>
                     <div class="ml-3">
                        <p class="text-muted">By clicking register, you agree to our terms and condition.</p>
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
         $('#year').text(new Date().getFullYear());
         $('body').scrollspy({ target: '#main-nav' });
         $("#main-nav a").on('click', function (event) {
           if (this.hash !== "") {
             event.preventDefault();
             const hash = this.hash;
             $('html, body').animate({
               scrollTop: $(hash).offset().top
             }, 800, function () {
               window.location.hash = hash;
             });
           }
         });

         
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