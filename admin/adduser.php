<?php session_start(); 

if(!isset($_SESSION["admin_id"])){
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
                    <title>Add User - Admin Dashboard</title>
                    <?php include ('../includes/header.php') ?>
                    <style>
                    .bd-placeholder-img {
                    font-size: 1.125rem;
                    text-anchor: middle;
                    -webkit-user-select: none;
                    -moz-user-select: none;
                    user-select: none;
                    }

                    @media (min-width: 768px) {
                    .bd-placeholder-img-lg {
                    font-size: 3.5rem;
                    }
                    }
                    </style>

                    <link href="../includes/styles/sidebars.css" rel="stylesheet">
</head>
<body>
                    <?php include ('../includes/sidebars.php'); ?>
                    <div class="container-fluid overflow-auto" style="margin-left:15px; margin-top:90px;">
                    <p class="text-danger" style="font-size:45px; font-weight:bold; font-family: 'abeezeeregular';"><i class="fa fa-user"></i>&nbsp;&nbsp;User Management</p>
                    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a>Admin Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add User</li>
                    </ol>
                    </nav>
                    <hr class="mb-3">
                    <a class="btn btn-danger" href="viewuser.php" role="button"><i class="fas fa-chevron-left"></i>&nbsp;&nbsp;Back</a>
                    <div class="container py-5 h-100">
                    <div class="row d-flex justify-content-center align-items-center h-90">
                    <?php 

                      if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                          $errors = array();

                        // Check for a first name:
                          if (empty($_POST['firstname'])) {
                            $errors[] = 'You forgot to enter your first name.';
                            } else {
                            $fn = trim($_POST['firstname']);
                          }//END IF

                        // Check for a last name:
                          if (empty($_POST['lastname'])) {
                            $errors[] = 'You forgot to enter your last name.';
                            } else {
                            $ln = trim($_POST['lastname']);
                          }//END IF

                        // Check for a username:
                          if (empty($_POST['username'])) {
                            $errors[] = 'You forgot to enter your username.';
                            } else {
                            $un = trim($_POST['username']);
                          }//END IF

                          // Check for a email:
                          if (empty($_POST['email'])) {
                            $errors[] = 'You forgot to enter your email.';
                            } else {
                            $e = trim($_POST['email']);
                          }//END IF

                          // Check for a areacode:
                          if (empty($_POST['areacode'])) {
                            $errors[] = 'You forgot to enter your area code.';
                            } else {
                              $ac = trim($_POST['areacode']);
                          }//END IF
                        
                          // Check for a phone:
                          if (empty($_POST['phone'])) {
                            $errors[] = 'You forgot to enter your phone.';
                            } else {
                            $p = trim($_POST['phone']);
                          }//END IF

                          // Check for a date of birth:
                          if (empty($_POST['birthdate'])) {
                            $errors[] = 'You forgot to enter your date of birth.';
                            } else {
                            $dob = trim($_POST['birthdate']);
                          }//END IF

                          // Check for a password:
                          if (empty($_POST['password'])) {
                            $errors[] = 'You forgot to enter your password.';
                            } else {
                            $pass = trim($_POST['password']);
                          }//END IF

                          if (empty($errors)) {
                              require ('../includes/mysqli_connect.php');
                              $q = "INSERT INTO members (f_name, l_name, email, area_code, mobilehp, birth_date, username, password) VALUES ('$fn', '$ln', '$e', '$ac', '$p', '$dob', '$un', SHA1('$pass'));";  
                              $r = @mysqli_query ($dbc, $q);

                                if ($r) {
                                  //SUCCESS MESSAGE
                                  echo '<!-- Modal -->
                                  <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog modal-dialog-centered" role="document">
                                  <div class="modal-content rounded-6 shadow-lg">
                                  <div class="modal-header bg-dark mb-4 border-bottom-0">
                                  <h6 class="modal-title" style="color:white;" >Saving...</h6>
                                  </div>
                                  <div class="modal-body py-0">
                                  <img class="me-2" src="../includes/imageres/loading.svg" width="6%"><label class="mb-4">&nbsp;&nbsp;Saving your data...</label>
                                  <br>
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
                                  setTimeout("location.href ='; echo "'viewuser.php?adduser=success';"; echo'",2000);
                                  </script>';

                                }else{

                                  //ERROR MESSAGE
                                  echo '<!-- Modal -->
                                  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog modal-dialog-centered" role="document">
                                  <div class="modal-content rounded-6 shadow-lg">
                                  <div class="modal-header bg-dark mb-2 border-bottom-0">
                                  <h6 class="modal-title" style="color:white;" ><i class="fa fa-times-circle text-danger" style=""></i>&nbsp;&nbsp;Please input all the details</h6>
                                  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body py-0">
                                  
                                  
                                  <hr>';
                                  echo '<h1>System Error</h1>
                                  <p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>'; 
                                  
                                  // Debugging message:
                                  echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
                                  

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


                          }else{

                            //IF INPUT FORM LEFT BLANK                 
                            echo '<!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content rounded-6 shadow-lg">
                            <div class="modal-header bg-dark mb-2 border-bottom-0">
                            <h6 class="modal-title" style="color:white;" ><i class="fa fa-times-circle text-danger" style=""></i>&nbsp;&nbsp;Please input all the details</h6>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body py-0">
                            
                            <p align="left" class="error">The following error(s) occurred:<br /></p>
                            <hr>';
                            
                            foreach ($errors as $msg) { // Print each error.
                            echo '<i class="fas fa-exclamation-circle"></i> ';
                            echo "$msg<br />\n";
                            }

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

                      addForm();
                      

                    ?> 

                    </div></div>
                    </div>

                    
</main>

<?php 
          function addForm(){
            
            echo '<form action="adduser.php" method="post">';
            echo '<label style="font-size:18px; font-weight:bold;" class="text-success mb-2"><i class="fas fa-plus-circle"></i>&nbsp;Add A User</label>';
            echo '<div class="row g-2">
                           <div class="col-md">
                              <div class="form-floating">
                                <input type="text" class="form-control rounded-5" name="firstname" placeholder="First Name" value="'; if(isset($_POST['firstname'])) echo $_POST['firstname']; echo'">
                                <label ><i class="fas fa-user-tag"></i>&nbsp;First Name</label>
                              </div>
                           </div>

                           <div class="col-md">
                              <div class="form-floating">
                                <input type="text" class="form-control rounded-5" name="lastname" placeholder="Last Name" value="'; if(isset($_POST['lastname'])) echo $_POST['lastname']; echo'">
                                <label><i class="fas fa-user-tag"></i>&nbsp;Last Name</label>
                              </div>
                           </div>
            </div>
            <br>';

            echo '<div class="row g-2">
                         <div class="col-md">
                            <div class="form-floating">
                              <input type="text" class="form-control rounded-5" name="username" placeholder="Username" value="'; if(isset($_POST['username'])) echo $_POST['username']; echo'">
                              <label ><i class="fas fa-tag"></i>&nbsp;Username</label>
                            </div>
                         </div>

                         <div class="col-md">
                            <div class="form-floating">
                              <input type="email" class="form-control rounded-5" name="email" placeholder="Email" value="'; if(isset($_POST['email'])) echo $_POST['email']; echo'">
                              <label><i class="fas fa-at"></i>&nbsp;Email</label>
                            </div>
                         </div>
            </div>
            <br>';
            
            echo '<div class="row g-2">
                       <div class="col-md">
                          <div class="form-floating">
                            <input type="text" class="form-control rounded-5" name="areacode" placeholder="Area Code" value="'; if(isset($_POST['areacode'])) echo $_POST['areacode']; echo'">
                            <label ><i class="fas fa-phone-alt"></i>&nbsp;Area Code</label>
                          </div>
                       </div>

                       <div class="col-md">
                          <div class="form-floating">
                            <input type="text" class="form-control rounded-5" name="phone" placeholder="Phone Number" value="'; if(isset($_POST['phone'])) echo $_POST['phone']; echo'">
                            <label><i class="fas fa-phone-alt"></i>&nbsp;Phone Number</label>
                          </div>
                       </div>
                </div>
                <br>';


                echo '<div class="row g-2">

                <div class="col-md">
                <div class="form-floating">
                  <input type="date" class="form-control rounded-5" id="dob" name="birthdate">
                  <label ><i class="fas fa-birthday-cake"></i>&nbsp;Date of Birth</label>
                </div>
                </div>

                <div class="col-md">
                <div class="form-floating">
                  <input type="password" class="form-control rounded-5" name="password" placeholder="Password">
                  <label><i class="fas fa-key"></i>&nbsp;Password</label>
                </div>
             </div>

             </div>
              <br>';
              
              echo '<button class="btn btn-primary btn-lg btn-block" type="submit" style="font-size:16px;"><i class="fas fa-save"></i>&nbsp; Save</button>';


            echo'
            </form>
            ';

          }//END FUNCTION

          include ('../includes/footer.html');

?>
