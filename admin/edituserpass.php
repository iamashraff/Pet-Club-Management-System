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
                    <title>Edit User Password - Admin Dashboard</title>
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
                    <li class="breadcrumb-item active" aria-current="page">Edit User Password</li>
                    </ol>
                    </nav>
                    <hr class="mb-3">
                    <a class="btn btn-danger" href="viewuser.php" role="button"><i class="fas fa-chevron-left"></i>&nbsp;&nbsp;Back</a>
                    <div class="container py-5 h-100">
                    <div class="row d-flex justify-content-center align-items-center h-90">

                    <?php 

                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                    $errors = array();
                    
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
                          $mid = $_GET['member'];                
                          require ('../includes/mysqli_connect.php');
                          $q = "UPDATE members SET `password` = SHA1('$password') WHERE `members`.`member_id` = $mid;";
                          $r = @mysqli_query ($dbc, $q);
                                  if (mysqli_affected_rows($dbc) == 1) {
                                    //SUCCESS MESSAGE
                                    successMessage();
                                  }else{
                                    //NOT SUCCESS MESSAGE
                                    errornoSave($mid);

                                  }//END IF                 

                      }else{
                                        echo '<!-- Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content rounded-6 shadow-lg">
                                          <div class="modal-header bg-dark mb-3 border-bottom-0">
                                            <h6 class="modal-title" style="color:white;" ><i class="fa fa-times-circle text-danger" style=""></i>&nbsp;&nbsp;Please input all fields</h6>
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
                                            <button type="button" onclick="history.back()" class="btn btn-lg btn-danger w-100 mx-0" data-bs-dismiss="modal">Go Back</button>
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

                      }//END EMPTY ERROR

                              
                    }else{


                                        if ( (isset($_GET['member'])) && (is_numeric($_GET['member'])) ) { 
                                        $memberid = $_GET['member'];
                                        passForm($memberid);
                                        } elseif ( (isset($_POST['member'])) && (is_numeric($_POST['member'])) ) {
                                        $memberid = $_POST['member'];
                                        passForm($memberid);
                                        } else { //IF ID NOT VALID
                                        
                                        }//END IF

                    }//END IF
                    
                    ?>

                    </div></div>
                    </div>

                    
</main>
                    
<?php 
include ('../includes/footer.html');

                    function passForm($memberid){
                      
                      echo '<form action="edituserpass.php?member='.$memberid.'" method="post">';
                      echo '<label style="font-size:18px; font-weight:bold;" class="text-success mb-3"><i class="fas fa-edit"></i>&nbsp;Edit A User Password</label>';
                      
                      require ('../includes/mysqli_connect.php');
                      $q = "SELECT member_id, f_name, l_name, username FROM members WHERE member_id='$memberid';";
                      $r = @mysqli_query ($dbc, $q);
                      $num = mysqli_num_rows($r);

                                        
                      if ($num == 1) {
                        $row = mysqli_fetch_array($r, MYSQLI_ASSOC);
                        echo '<div class="alert alert-info border-info mb-4" role="alert">';
                      echo '<div><i class="fas fa-exclamation-circle"></i>&nbsp;&nbsp;You are going to change password for <b><i>'.$row['username'].'</i></b>. Click save password to continue making changes !</div></div>';
                        echo '<div class="row g-2">
                           <div class="col-md">
                              <div class="form-floating">
                                <input type="text" class="form-control rounded-5" value="'.$row['member_id'].'" disabled name="memberid" placeholder="Member ID">
                                <label ><i class="far fa-id-badge"></i>&nbsp;Member ID</label>
                              </div>
                           </div>

                           <div class="col-md">
                           <div class="form-floating">
                             <input type="text" class="form-control rounded-5" value="'.$row['username'].'" disabled name="username" placeholder="Username">
                             <label ><i class="far fas fa-tag"></i>&nbsp;Username</label>
                           </div>
                        </div>
                           </div>
                           <br>';

                           echo '<div class="row g-2">
                           <div class="col-md">
                              <div class="form-floating">
                                <input type="text" class="form-control rounded-5" value="'.$row['f_name'].'" disabled name="firstname" placeholder="First Name">
                                <label ><i class="fas fa-user-tag"></i>&nbsp;First Name</label>
                              </div>
                           </div>

                           <div class="col-md">
                              <div class="form-floating">
                                <input type="text" class="form-control rounded-5" value="'.$row['l_name'].'" disabled name="lastname" placeholder="Last Name">
                                <label><i class="fas fa-user-tag"></i>&nbsp;Last Name</label>
                              </div>
                           </div>
                      </div>
                      <hr class="text-dark mb-4">';

                      echo '<div class="row g-2">
                      <label class="text-muted"><i>Please input the following text field to continue :</i></label>                  
                <div class="col-md">
                <div class="form-floating">
                  <input type="password" class="form-control border-info rounded-5" name="password" placeholder="Password">
                  <label><i class="fas fa-key"></i>&nbsp;<b>Password</b></label>
                </div>
             </div>

                <div class="col-md">
                <div class="form-floating">
                  <input type="password" class="form-control border-info rounded-5" name="confirmpassword" placeholder="Confirm Password">
                  <label><i class="fas fa-key"></i>&nbsp;<b>Confirm Password</b></label>
                </div>
             </div>

             </div>
              <br>';

              echo '<div class="row g-2 mb-2">
                   <div class="col-md">
                     <div class="form-check form-switch">
                     <input class="form-check-input" type="checkbox" role="switch" id="yesChange" name="yesChange">
                     <label class="form-check-label text-danger" for="yesChange">Yes, I am sure to change password for <b><i>'.$row['username'].'</i></b> !</label>
                     </div>
                   </div>
                   </div>';

              echo '<button class="btn btn-primary btn-lg btn-block" type="submit" id="saveBtn" name="saveBtn" style="font-size:16px;" disabled ><i class="fas fa-save"></i>&nbsp; Save password</button>';

              echo '</form>';
                    
                      }else{

                      }//END IF

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
                      setTimeout("location.href ='; echo "'viewuser.php?editpass=success';"; echo'",2000);
                      </script>';

                    }//END FUNCTION

                    function errornoSave($mid){
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
                        
                        <p style="font-weight:bold;" class="text-center text-danger">Unable to use previous password.<br>Please provide the user with another password !<br /></p>
                        <p class="text-center">No data has been saved.<br>Please go back and try again !</p>
                        <hr>';
                        
                        echo'
                        </div>
                        <div class="modal-footer flex-column border-top-0">
                        <a href="edituserpass.php?member='.$mid.'" class="btn btn-lg btn-danger w-100 mx-0" role="button">Go Back</a>
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