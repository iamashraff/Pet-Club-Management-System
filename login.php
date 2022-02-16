<?php session_start(); 

if(isset($_SESSION["memberid"])){
  header("location: index.php");
  exit;
}//END IF

?>
<!DOCTYPE html>
<html lang="en">
<head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Login</title>
                    <?php include ('includes/header.php') ?>
                    <style>
                    #intro {
                    background-image: url("includes/imageres/cat_banner.jpg");
                    height: 120.3vh;
                    }

                    /* Height for devices larger than 576px */
                    @media (min-width: 1024px) {
                    #intro {
                    margin-top: -58.59px;
                    }
                    }

                    .navbar .nav-link {
                    color: #fff !important;
                    }
                    </style>
      <!-- Background image -->
      <div id="intro" class="bg-image vh-120 shadow-1-strong">
        <video style="min-width: 100%; min-height: 100%;" playsinline autoplay muted loop>
          <source class="h-100" src="https://uniklwow.cov-19awareness.com/cat_4.mp4" type="video/mp4" />
        </video>
        <div class="mask"     style="
        background: linear-gradient(
          45deg,
          rgba(29, 236, 197, 0.7),
          rgba(91, 14, 214, 0.7) 100%
        );
      ">

          <!--FORM-->
                    <div class="container py-5 h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-8 col-md-6 col-lg-6 col-xl-4 text-center">
                    <img src="includes/imageres/logo.png" width="80px;">
                    <p style="font-size: 40px; color:white; font-family: 'hello_calanthe_demoregular'; text-shadow: 0px 0px 12px rgb(255,255,255);">Pet Corner Club</p>
                    <?php

      
 
                        require('includes/mysqli_connect.php');
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                          
                          $errors = array(); // Initialize error array.

                          // Check for a username:
                            if (empty($_POST['username'])) {
                              $errors[] = 'You forgot to enter your username.';
                            } else {
                              $username = $_POST['username'];
                              $username = stripcslashes($username);
                              $username = mysqli_real_escape_string($dbc, $username);
                            }//END IF

                            // Check for a password:
                            if (empty($_POST['password'])) {
                              $errors[] = 'You forgot to enter your password.';
                            } else {
                              $password = $_POST['password'];
                              $password = stripcslashes($password);
                              $password = mysqli_real_escape_string($dbc, $password);
                            }//END IF     

                          
                            if (empty($errors)) {
                                $q = "SELECT member_id, f_name, l_name FROM members WHERE username='$username' AND password=sha1('$password')";
                                $r = @mysqli_query ($dbc, $q);
                                

                                if (mysqli_num_rows($r) == 1) {
                                  //SUCCESS LOGIN
                                    
                                  $row = mysqli_fetch_array ($r,MYSQLI_ASSOC);
                                  $memberid = $row['member_id'];
                                  $fname = $row['f_name'];
                                  $lname = $row['l_name'];

                                  $_SESSION["memberid"] = $memberid;
                                  $_SESSION["fname"] = $fname;
                                  $_SESSION["lname"] = $lname;

                                  echo '<!-- Modal -->
                                          <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog modal-dialog-centered" role="document">
                                          <div class="modal-content rounded-6 shadow-lg">
                                            <div class="modal-header bg-dark mb-4 border-bottom-0">
                                              <h6 class="modal-title" style="color:white;" ><i class="fas fa-check-circle text-success" style=""></i>&nbsp;&nbsp;Redirecting...</h6>
                                            </div>
                                            <div class="modal-body py-0">
                                            <img class="me-2" src="includes/imageres/loading.svg" width="6%"><p>&nbsp;Redirecting to your account...</p>
                                            </div>
                                          </div>
                                        </div>
                                          </div>';

                                          
                                        echo '<script>
                                        var myModal = new bootstrap.Modal(document.getElementById("exampleModal"), {});
                                        document.onreadystatechange = function () {
                                          myModal.show();
                                        };
                                      </script>';
   

                                  	// Redirect the user:
                                    echo 
                                    '<script>
                                    setTimeout("location.href ='; echo "'mypet.php';"; echo'",3000);
                                    </script>';
                                  
                                }  
                                else{  
                                    //INVALID LOGIN MESSAGE                                         
                                          echo '<!-- Modal -->
                                          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog modal-dialog-centered" role="document">
                                          <div class="modal-content rounded-6 shadow-lg">
                                            <div class="modal-header bg-dark mb-5 border-bottom-0">
                                              <h6 class="modal-title" style="color:white;" ><i class="fa fa-times-circle text-danger" style=""></i>&nbsp;&nbsp;Incorrect login credentials</h6>
                                              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body py-0">
                                              
                                              <p>We are unable to verify your <b>Username</b> or <b>Password</b> entered.
                                              <br>Please try again !</p>
                                            </div>
                                            <div class="modal-footer flex-column border-top-0">
                                              <button type="button" class="btn btn-lg btn-danger w-100 mx-0" data-bs-dismiss="modal">Close</button>
                                            </div>
                                          </div>
                                        </div>
                                          </div>
                                          ';

                                        echo '<script>
                                        var myModal = new bootstrap.Modal(document.getElementById("exampleModal"), {});
                                        document.onreadystatechange = function () {
                                          myModal.show();
                                        };
                                      </script>';

                                }//END IF
                                //mysqli_close($dbc); // Close the database connection.
                            }else {
                              
                              //IF INPUT FORM LEFT IN BLANK
                              echo '<!-- Modal -->
                                          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog modal-dialog-centered" role="document">
                                          <div class="modal-content rounded-6 shadow-lg">
                                            <div class="modal-header bg-dark mb-2 border-bottom-0">
                                              <h6 class="modal-title" style="color:white;" ><i class="fa fa-times-circle text-danger" style=""></i>&nbsp;&nbsp;Please input your login details</h6>
                                              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body py-0">
                                              
                                              <p align="left" class="error">The following error(s) occurred:<br /></p>
                                              <hr>';
                                              
                                              foreach ($errors as $msg) { // Print each error.
                                                echo '<i class="fas fa-exclamation-circle"></i> ';
                                                echo "$msg<br />\n";
                                              }

                                              echo '<br><p class="error"><b>Please enter all fields and try again !</b></p>';
                                            echo'
                                            </div>
                                            <div class="modal-footer flex-column border-top-0">
                                              <button type="button" class="btn btn-lg btn-danger w-100 mx-0" data-bs-dismiss="modal">Close</button>
                                            </div>
                                          </div>
                                        </div>
                                          </div>
                                          ';

                                echo '<script>
                                        var myModal = new bootstrap.Modal(document.getElementById("exampleModal"), {});
                                        document.onreadystatechange = function () {
                                          myModal.show();
                                        };
                                </script>';
                              

                            }//END IF
                          

                        }//END IF
                     
                        loginForm();
                    
                    ?>
                    </div>
                    </div>
                    </div>

          <!--END FORM-->
        </div>
      </div>
      <!-- Background image -->
</head>
<body>

                        
                    
      <?php 
      
      if(isset($_GET['logout']))
      {
        echo '<!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content rounded-6 shadow-lg">
          <div class="modal-header bg-dark mb-5 border-bottom-0">
            <h6 class="modal-title" style="color:white;" ><i class="fas fa-check-circle text-success" style=""></i>&nbsp;&nbsp;Success Logged Out !</h6>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body py-0">
            
            <p class="text-center">You have been successfully logged out !</p>
          </div>
          <div class="modal-footer flex-column border-top-0">
            <button type="button" class="btn btn-lg btn-success w-100 mx-0" data-bs-dismiss="modal">Okay</button>
          </div>
        </div>
      </div>
        </div>
        ';

      echo '<script>
      var myModal = new bootstrap.Modal(document.getElementById("exampleModal"), {});
      document.onreadystatechange = function () {
        myModal.show();
      };
    </script>';
      }//END IF
      
      
      include ('includes/footer.html');
      
      
      function loginForm(){
        
        echo'
        <div class="card shadow-2-strong" style="border-radius: 1rem; font-family:'; 
        echo"'abeezeeregular'"; 
        echo';">

                    <div class="card-body p-4 text-center">

                    <h3 class="mb-4"><i class="fas fa-user"></i>&nbsp;<b>User Login</b></h3>

                    <form action="login.php" method="post">
                    <div class="row mb-4">
                                        <div class="col-1">
                                        <i class="fas fa-user-tag fa-lg me-3 fa-fw" style="margin-top:14px;"></i>
                                        </div>
                                        &nbsp;
                                        <div class="col">
                                          <div class="form-floating">
                                            <input type="text" class="form-control rounded-5" id="floatUsername" placeholder="Username" name="username" value="'; if(isset($_POST['username'])) echo $_POST['username']; echo'">
                                            <label for="floatingInput">Username</label>
                                          </div>
                                        </div>
                    </div>

                    <div class="row mb-4">
                                        <div class="col-1">
                                        <i class="fas fa-lock fa-lg me-3 fa-fw" style="margin-top:14px;"></i>
                                        </div>
                                        &nbsp;
                                        <div class="col">
                                          <div class="form-floating">
                                            <input type="password" class="form-control rounded-5" id="floatPassword" placeholder="Password" name="password">
                                            <label for="floatPassword">Password</label>
                                          </div>
                                        </div>
                    </div>

                    <div class="row mb-4">
                                        <div class="col">
                                        <link href="includes/styles/gradient_bg.css" rel="stylesheet">
                                        <button class="btn btn-primary btn-lg btn-block gradient-custom-2" type="submit" style="font-size:16px;">Login&nbsp;&nbsp;&nbsp;<i class="fas fa-sign-in-alt"></i></button>
                                        </div>
                    </div>

                    <hr class="my-3">

                    <div class="row">
                                        <p style="font-size:15px;">Not a member?</p>
                                        
                    </div>

                    <div class="d-flex flex-row align-items-center" style="margin-top:-13px;">
                          <div class="col">
                              <a href="register.php" class="btn btn-outline-danger" role="button" data-mdb-ripple-color="dark">Register</a>
                          </div>
                       </div>     
                    </form>

                    </div>
                    </div>';
                  }//END FUNCTION

                
      ?>