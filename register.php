<?php session_start(); 

if(isset($_SESSION["memberid"])){
  header("location: index.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Register Account</title>
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
          <div class="container d-flex align-items-center justify-content-center text-center h-100">
            <div class="text-white">
                    <img src="includes/imageres/logo.png" width="80px;">
                    <p style="font-size: 40px; font-family: 'hello_calanthe_demoregular'; text-shadow: 0px 0px 12px rgb(255,255,255);">Pet Corner Club</p>


                        <?php 
                        // Check for form submission:
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                          
                              $errors = array(); // Initialize an error array.

                              // Check for a first name:
                              if (empty($_POST['firstname'])) {
                                $errors[] = 'You forgot to enter your first name.';
                              } else {
                                $firstname = trim($_POST['firstname']);
                              }//END IF

                              // Check for a last name:
                              if (empty($_POST['lastname'])) {
                                $errors[] = 'You forgot to enter your last name.';
                              } else {
                                $lastname = trim($_POST['lastname']);
                              }//END IF

                              // Check for an email:
                              if (empty($_POST['email'])) {
                                $errors[] = 'You forgot to enter your email.';
                              } else {
                                $email= trim($_POST['email']);
                              }//END IF

                              // Check for a areacode:
                              if (empty($_POST['areacode'])) {
                                $errors[] = 'You forgot to enter your areacode.';
                              } else {
                                $areacode= trim($_POST['areacode']);
                              }//END IF

                              // Check for a phoneno:
                              if (empty($_POST['phoneno'])) {
                                $errors[] = 'You forgot to enter your phone no.';
                              } else {
                                $phoneno= trim($_POST['phoneno']);
                              }//END IF

                              // Check for a dob:
                              if (empty($_POST['dob'])) {
                                $errors[] = 'You forgot to enter your date of birth.';
                              } else {
                                $dob= trim($_POST['dob']);
                              }//END IF

                              // Check for a username:
                              if (empty($_POST['username'])) {
                                $errors[] = 'You forgot to enter your username.';
                              } else {
                                $username= trim($_POST['username']);
                              }//END IF

                              // Check for a password and match against the confirmed password:
                              if (!empty($_POST['password'])) {
                                    if ($_POST['password'] != $_POST['confirmpassword']) {
                                      $errors[] = 'Your password did not match the confirmed password.';
                                    } else {
                                      $password = trim($_POST['password']);
                                    }//END IF
                              } else {
                                    $errors[] = 'You forgot to enter your password.';
                              }//END IF

                              if (empty($errors)) {
                                require ('includes/mysqli_connect.php');
                                $q = "INSERT INTO members (f_name, l_name, email, area_code, mobilehp, birth_date, username, password) VALUES ('$firstname', '$lastname', '$email', '$areacode', '$phoneno', '$dob', '$username', SHA1('$password') )";
                                $r = @mysqli_query ($dbc, $q); // Run the query.
                                if ($r) { // If it ran OK.

                                  echo '<!-- Modal -->
                                          <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog modal-dialog-centered" role="document">
                                          <div class="modal-content rounded-6 shadow-lg">
                                            <div class="modal-header bg-dark mb-4 border-bottom-0">
                                              <h6 class="modal-title" style="color:white;" ><i class="fas fa-check-circle text-success" style=""></i>&nbsp;&nbsp;Account Registered</h6>
                                            </div>
                                            <div class="modal-body py-0">
                                            <label class="text-success"><img class="me-2" src="includes/imageres/loading.svg" width="6%">&nbsp;Your account has been successfully registered !</label>
                                            <p class="text-dark">Redirecting to login page...</p>
                                            
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
                                    setTimeout("location.href ='; echo "'login.php';"; echo'",2000);
                                    </script>';

                            
                                } else { // If it did not run OK.
                                  echo '<h1>ERROR</h1>';
                                  // Public message:
                                  echo '<h1>System Error</h1>
                                  <p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>'; 
                              
                                  // Debugging message:
                                  echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
                                    
                                } // End of if ($r) IF.
                                
                                mysqli_close($dbc); // Close the database connection.                                

                                
                              } else { // Report the errors.
                              

                                echo '<!-- Modal -->
                                          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog modal-dialog-centered" role="document">
                                          <div class="modal-content rounded-6 shadow-lg">
                                            <div class="modal-header bg-dark mb-3 border-bottom-0">
                                              <h6 class="modal-title" style="color:white;" ><i class="fa fa-times-circle text-danger" style=""></i>&nbsp;&nbsp;Please input all registration details</h6>
                                              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body py-0">
                                            <p align="left" class="text-dark">The following error(s) occurred:<br /></p>
                                            <hr class="text-dark">';

                                            foreach ($errors as $msg) { // Print each error.
                                              echo '<label align="left" class="text-dark"><i class="fas fa-exclamation-circle text-dark"></i> ';
                                              echo $msg.'</label><br>';
                                            }
                                            echo '<br><p class="text-dark"><b>Please enter all fields and try again !</b></p>';
                                            echo'</div>
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

                                
                              } // End of if (empty($errors)) IF.



                        }//END IF
                        
                          regForm();

                        
                        
                        ?>





            </div>
          </div> <!--END FORM-->
        </div>
      </div>
      <!-- Background image -->

</head>
<body> 
                    

                   

<?php include ('includes/footer.html');

function regForm(){

  echo '<div class="card shadow-lg text-dark" style="font-family:';
  echo "'abeezeeregular';";
  echo'">
  <div class="card-body">';


        echo'<div class="row">
        <h3 class="mb-5">Sign Up</h3>
        </div>

        <form action="register.php" method="post">

        <div class="d-flex flex-row align-items-center mb-4">
            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
            <div class="col">
              <input style="height:40px;" class="form-control" type="text" placeholder="First Name" name="firstname" value="'; if(isset($_POST['firstname'])) echo $_POST['firstname']; echo'" >
            </div>
            &nbsp;&nbsp;
            <div class="col">
            <input style="height:40px;" class="form-control" type="text" placeholder="Last Name" name="lastname" value="'; if(isset($_POST['lastname'])) echo $_POST['lastname']; echo'" >
            </div>
        </div>

      <div class="d-flex flex-row align-items-center mb-4">
            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
            <div class="col">
            <input style="height:40px;" class="form-control" type="email" placeholder="Email" name="email" value="'; if(isset($_POST['email'])) echo $_POST['email']; echo'" >
            </div> 
      </div>

      
      <div class="d-flex flex-row align-items-center mb-4">
            <i class="fas fa-phone-alt fa-lg me-3 fa-fw"></i>
            <div class="col-md-3">
              <input style="height:40px;" class="form-control" type="text" placeholder="Area Code" name="areacode" value="'; if(isset($_POST['areacode'])) echo $_POST['areacode']; echo'">
            </div>
              &nbsp;
            <div class="col">
              <input style="height:40px;" class="form-control" type="text" placeholder="Phone Number" name="phoneno" value="'; if(isset($_POST['phoneno'])) echo $_POST['phoneno']; echo'" >
            </div> 
      </div>

      <div class="d-flex flex-row align-items-center mb-4">
            <i class="fas fa-birthday-cake fa-lg me-3 fa-fw"></i>
            <div class="col">
              <input  placeholder="Date of Birth" style="height:40px;" class="form-control textbox-n" type="text" placeholder="Date of Birth" name="dob" onfocus="(this.';
              echo "type='date')";
              
              echo '" id="date">
            </div>           
      </div>

      <div class="d-flex flex-row align-items-center mb-4">
            <i class="fas fa-user-tag fa-lg me-3 fa-fw"></i>
            <div class="col">
              <input style="height:40px;" class="form-control" type="text" placeholder="Username" name="username">
            </div>               
      </div>


      <div class="d-flex flex-row align-items-center mb-4">
            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
            <div class="col">
            <input style="height:40px;" class="form-control" type="password" placeholder="Password" name="password">
            </div>
            &nbsp;&nbsp;
            <div class="col">
            <input style="height:40px;" class="form-control" type="password" placeholder="Confirm Password" name="confirmpassword">                 
            </div> 
      </div>
      <div class="d-flex flex-row align-items-center mb-4">
        
              <div class="col">
              <button class="btn btn-success btn-lg btn-block" style="font-size:16px; height:44px;" type="submit">Register</button>

              </div>
      </div>

      </form>
        
      <hr class="my-4">
      <div class="d-flex flex-row align-items-center">
          <div class="col">
              <p style="font-size:15px;">Already have an account?</p>
          </div>
      </div>
      

      <div class="d-flex flex-row align-items-center" style="margin-top:-13px;">
          <div class="col">
              <a href="login.php" class="btn btn-outline-danger" role="button" data-mdb-ripple-color="dark">Login</a>
          </div>
      </div>
      
      </div>
    </div>';
  }//END FUNCTION
?>