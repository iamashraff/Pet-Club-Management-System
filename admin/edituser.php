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
                    <title>Edit User - Admin Dashboard</title>
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
                    <li class="breadcrumb-item active" aria-current="page">Edit User</li>
                    </ol>
                    </nav>
                    <hr class="mb-3">
                    <a class="btn btn-danger" href="viewuser.php" role="button"><i class="fas fa-chevron-left"></i>&nbsp;&nbsp;Back</a>
                    <div class="container py-5 h-100">
                    <div class="row d-flex justify-content-center align-items-center h-90">

                    <?php 
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                        $errors = array(); // Initialize an error array.

                        $mid = $_GET['member'];

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

                          if (empty($errors)) {
                             require ('../includes/mysqli_connect.php');
                             $q = "UPDATE members SET f_name='$fn', l_name='$ln', email='$e', area_code='$ac', mobilehp='$p', birth_date='$dob', username='$un' WHERE member_id='$mid'";
                             $r = @mysqli_query ($dbc, $q);
                                  if (mysqli_affected_rows($dbc) == 1) {
                                    //SUCCESS MESSAGE
                                    successMessage();
                                  }else{
                                    //NOT SUCCESS MESSAGE
                                    errornoSave();

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
                          <button type="button" class="btn btn-lg btn-danger w-100 mx-0" onclick="history.back()" data-bs-dismiss="modal">Close</button>
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

                      //SHOW FORM
                            if ( (isset($_GET['member'])) && (is_numeric($_GET['member'])) ) { 
                              $memberid = $_GET['member'];
                              editForm($memberid);
                            } elseif ( (isset($_POST['member'])) && (is_numeric($_POST['member'])) ) {
                              $memberid = $_POST['member'];
                              editForm($memberid);
                            } else { //IF ID NOT VALID
                              errormemberID();
                            }//END IF

                    }//END IF
                    
                    
                    ?>


                    </div></div>
                    </div>

                    
</main>
                    
<?php
                    function editForm($memberid){

                      //SHOW FORM
                      require ('../includes/mysqli_connect.php');
                      $q = "SELECT member_id, f_name, l_name, email, area_code, mobilehp, birth_date, username FROM members WHERE member_id='$memberid';";
                      $r = @mysqli_query ($dbc, $q);
                      $num = mysqli_num_rows($r);

                      if ($num == 1) {
                        $row = mysqli_fetch_array($r, MYSQLI_ASSOC);
                        //SHOW FORM

                      echo '<form action="edituser.php?member='.$memberid.'" method="post">';
                      echo '<label style="font-size:18px; font-weight:bold;" class="text-success mb-3"><i class="fas fa-edit"></i>&nbsp;Edit A User</label>';
                      
                      echo '<div class="row g-2">
                           <div class="col-md">
                              <div class="form-floating">
                                <input type="text" class="form-control rounded-5" value="'.$row['member_id'].'" disabled name="memberid" placeholder="Member ID">
                                <label ><i class="far fa-id-badge"></i>&nbsp;Member ID</label>
                              </div>
                           </div>
                           </div>
                           <br>';
                      
                      echo '<div class="row g-2">
                           <div class="col-md">
                              <div class="form-floating">
                                <input type="text" class="form-control rounded-5" value="'.$row['f_name'].'" name="firstname" placeholder="First Name">
                                <label ><i class="fas fa-user-tag"></i>&nbsp;First Name</label>
                              </div>
                           </div>

                           <div class="col-md">
                              <div class="form-floating">
                                <input type="text" class="form-control rounded-5" value="'.$row['l_name'].'" name="lastname" placeholder="Last Name">
                                <label><i class="fas fa-user-tag"></i>&nbsp;Last Name</label>
                              </div>
                           </div>
                      </div>
                      <br>';

                      echo '<div class="row g-2">
                      <div class="col-md">
                         <div class="form-floating">
                           <input type="text" class="form-control rounded-5" value="'.$row['username'].'" name="username" placeholder="Username">
                           <label ><i class="fas fa-tag"></i>&nbsp;Username</label>
                         </div>
                      </div>

                      <div class="col-md">
                         <div class="form-floating">
                           <input type="email" class="form-control rounded-5" value="'.$row['email'].'" name="email" placeholder="Email">
                           <label><i class="fas fa-at"></i>&nbsp;Email</label>
                         </div>
                      </div>
                    </div>
                    <br>';
         
                    echo '<div class="row g-2">
                    <div class="col-md">
                       <div class="form-floating">
                         <input type="text" class="form-control rounded-5" value="'.$row['area_code'].'" name="areacode" placeholder="Area Code">
                         <label ><i class="fas fa-phone-alt"></i>&nbsp;Area Code</label>
                       </div>
                    </div>

                    <div class="col-md">
                       <div class="form-floating">
                         <input type="text" class="form-control rounded-5" value="'.$row['mobilehp'].'" name="phone" placeholder="Phone Number">
                         <label><i class="fas fa-phone-alt"></i>&nbsp;Phone Number</label>
                       </div>
                    </div>
                    </div>
                    <br>';

                    echo '<div class="row g-2">

                    <div class="col-md">
                    <div class="form-floating">
                        <input type="date" class="form-control rounded-5" value="'.$row['birth_date'].'" id="dob" name="birthdate">
                        <label ><i class="fas fa-birthday-cake"></i>&nbsp;Date of Birth</label>
                    </div>
                    </div>
                    </div>
                    <br>';

                    echo '<div class="row g-2 mb-2">
                   <div class="col-md">
                     <div class="form-check form-switch">
                     <input class="form-check-input" type="checkbox" role="switch" id="yesChange" name="yesChange">
                     <label class="form-check-label text-danger" for="yesChange">Yes, I am sure to make a changes !</label>
                     </div>
                   </div>
                   </div>';


                    echo '<button class="btn btn-primary btn-lg btn-block" type="submit" id="saveBtn" name="saveBtn" style="font-size:16px;" disabled ><i class="fas fa-save"></i>&nbsp; Save changes</button>';



                      echo '</form>';

                      }else{
                        //ERROR MESSAGE NOT FIND PET                


                      }//END IF



                    }//END FUNCTION

                    function errormemberID(){
                      //SHOW ERROR MESSAGE
                      echo '<!-- Modal -->
                      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content rounded-6 shadow-lg">
                      <div class="modal-header bg-dark mb-4 border-bottom-0">
                      <h6 class="modal-title" style="color:white;" ><i class="fa fa-times-circle text-danger" style=""></i>&nbsp;&nbsp;Access Error !</h6>
                      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body py-0">
                      
                      <p style="font-weight:bold;" class="text-center text-danger">There is an error occurred !<br /></p>
                      <p class="text-center">We are not able to load data.<br>Please go back and try again !</p>
                      <hr>';
                      
                      echo'
                      </div>
                      <div class="modal-footer flex-column border-top-0">
                      <a class="btn btn-lg btn-danger w-100 mx-0" href="viewuser.php" role="button">Go Back</a>
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
                      }//END FUNCTION

                      function successMessage(){

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
                      setTimeout("location.href ='; echo "'viewuser.php?edituser=success';"; echo'",2000);
                      </script>';

                    }//END FUNCTION

                    function errornoSave(){
                        //SHOW ERROR MESSAGE
                        echo '<!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content rounded-6 shadow-lg">
                        <div class="modal-header bg-dark mb-4 border-bottom-0">
                        <h6 class="modal-title" style="color:white;" ><i class="fa fa-times-circle text-danger" style=""></i>&nbsp;&nbsp;Unable to save data</h6>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body py-0">
                        
                        <p style="font-weight:bold;" class="text-center text-danger">You did not make any changes.<br /></p>
                        <p class="text-center">No data has been saved.<br>Please go back and try again !</p>
                        <hr>';
                        
                        echo'
                        </div>
                        <div class="modal-footer flex-column border-top-0">
                        <a class="btn btn-lg btn-danger w-100 mx-0" onclick="history.back()" role="button">Go Back</a>
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
                        }//END FUNCTION




 include ('../includes/footer.html');
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
          $('#yesChange').focus();
            $("#yesChange").change(function(){
                if($(this).prop("checked")){
                    $("#saveBtn").prop("disabled",false);
                }
                else{
                    $("#saveBtn").prop("disabled",true);
                }
            });
        });
    </script>