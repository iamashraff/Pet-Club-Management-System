<?php session_start(); 

if(!isset($_SESSION["memberid"])){
  header("location: login.php");
  exit;
}//END IF

?>

<!DOCTYPE html>
<html lang="en">
<head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>My Accounts - My Pets</title>
                    <?php include ('includes/header.php') ?>
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

                    <link href="includes/styles/sidebars.css" rel="stylesheet">
</head>
<body>
                    <?php include ('includes/sidebars.php'); ?>

                    <div class="container-fluid overflow-auto" style="margin-left:15px; margin-top:90px;">
                    <p class="text-danger" style="font-size:45px; font-weight:bold; font-family: 'abeezeeregular';"><i class="fa fa-user"></i>&nbsp;&nbsp;My Account</p>
                    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a>Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">My Account</li>
                    </ol>
                    </nav>
                    <hr class="mb-3">
                    <form action="myaccount.php" method="post">
                    <div class="container py-5 h-100">
                    <div class="row d-flex justify-content-center align-items-center h-90">
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle"></i>
                    If you are going to make any changes on your account details, please click the Save Changes button.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
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

                            // Check for a email:
                            if (empty($_POST['email'])) {
                              $errors[] = 'You forgot to enter your email.';
                              } else {
                              $email = trim($_POST['email']);
                            }//END IF

                            // Check for a area code:
                            if (empty($_POST['areacode'])) {
                              $errors[] = 'You forgot to enter your areacode.';
                              } else {
                              $areacode = trim($_POST['areacode']);
                            }//END IF

                            // Check for a phone no:
                            if (empty($_POST['phone'])) {
                              $errors[] = 'You forgot to enter your phone no.';
                              } else {
                              $phone = trim($_POST['phone']);
                            }//END IF
                            
                            // Check for a date of birth:
                            if (empty($_POST['birthdate'])) {
                              $errors[] = 'You forgot to enter your birth date.';
                              } else {
                              $birthdate = trim($_POST['birthdate']);
                            }//END IF

                            if (empty($errors)) {
                              require ('includes/mysqli_connect.php');
                              $memberid = $_SESSION["memberid"];
                              $q = "UPDATE members SET f_name='$fn', l_name='$ln', email='$email', area_code='$areacode', mobilehp='$phone', birth_date='$birthdate' WHERE member_id='$memberid';";
                              $r = @mysqli_query ($dbc, $q);
                                  if (mysqli_affected_rows($dbc) == 1) {
                                     //SUCCESS MESSAGE
                                     successMessage(); 
                                  }else{
                                     //FAILED MESSAGE
                                     errornoSave();   
                                  }//END IF

                            }//END IF


                        }else{
                    
                          $memberid = $_SESSION["memberid"];
                          showForm($memberid);                  

                        }//END IF

                        ?>
                        
                    </div>

                    </div></div>
                      </form>
                    </main>

                    
<?php 

                    function showForm($memberid){
                       require ('includes/mysqli_connect.php');
                       $q = "SELECT f_name, l_name, username, email, area_code, mobilehp, birth_date FROM members WHERE member_id='$memberid';";
                       $r = @mysqli_query ($dbc, $q);
                       $num = mysqli_num_rows($r);

                       if ($num == 1) {
                         $row = mysqli_fetch_array($r, MYSQLI_ASSOC);
                         //SHOW FORM

                         echo '<div class="row g-2">
                           <div class="col-md">
                              <div class="form-floating">
                                <input type="text" class="form-control rounded-5" value="'; echo $memberid; echo'" name="memberid" disabled>
                                <label ><i class="fa fa-id-badge"></i>&nbsp;Member ID</label>
                              </div>
                           </div>
                         </div>';
                         
                         echo '<div class="row g-2">
                           <div class="col-md">
                              <div class="form-floating">
                                <input type="text" class="form-control rounded-5" value="'; echo $row['f_name']; echo'" name="firstname">
                                <label ><i class="fas fa-user-tag"></i>&nbsp;First Name</label>
                              </div>
                           </div>

                           <div class="col-md">
                              <div class="form-floating">
                                <input type="text" class="form-control rounded-5" value="'; echo $row['l_name']; echo'" name="lastname">
                                <label><i class="fas fa-user-tag"></i>&nbsp;Last Name</label>
                              </div>
                           </div>
                         </div>';
                    
                         echo '<div class="row g-2">
                         <div class="col-md">
                            <div class="form-floating">
                              <input type="text" class="form-control rounded-5" value="'; echo $row['username']; echo'" name="username" disabled>
                              <label ><i class="fas fa-tag"></i>&nbsp;Username</label>
                            </div>
                         </div>

                         <div class="col-md">
                            <div class="form-floating">
                              <input type="email" class="form-control rounded-5" value="'; echo $row['email']; echo'" name="email">
                              <label><i class="fas fa-at"></i>&nbsp;Email</label>
                            </div>
                         </div>
                       </div>';

                       echo '<div class="row g-2">
                       <div class="col-md">
                          <div class="form-floating">
                            <input type="text" class="form-control rounded-5" value="'; echo $row['area_code']; echo'" name="areacode">
                            <label ><i class="fas fa-phone-alt"></i>&nbsp;Area Code</label>
                          </div>
                       </div>

                       <div class="col-md">
                          <div class="form-floating">
                            <input type="text" class="form-control rounded-5" value="'; echo $row['mobilehp']; echo'" name="phone">
                            <label><i class="fas fa-phone-alt"></i>&nbsp;Phone Number</label>
                          </div>
                       </div>
                     </div>';

                     echo '<div class="row g-2">
                     <div class="col-md">
                        <div class="form-floating">
                          <input type="date" class="form-control rounded-5" value="'; echo $row['birth_date']; echo'" id="dob" name="birthdate">
                          <label ><i class="fas fa-birthday-cake"></i>&nbsp;Date of Birth</label>
                        </div>
                     </div>
                   </div>';

                   echo '<div class="row g-2 mb-1">
                   <div class="col-md">
                     <div class="form-check form-switch">
                     <input class="form-check-input" type="checkbox" role="switch" id="yesChange" name="yesChange">
                     <label class="form-check-label" for="yesChange">Yes, I am sure to make a changes !</label>
                     </div>
                   </div>
                 </div>';
                    
                   echo '
                   <div class="row g-2">
                     <div class="col-md">
                      <button class="btn btn-primary btn-lg btn-block" type="submit" id="saveBtn" name="saveBtn" style="font-size:16px;" disabled ><i class="fas fa-save"></i>&nbsp; Save changes</button>
                    </div></div>';


                       }else{

                       }//END IF

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
                        <a class="btn btn-lg btn-danger w-100 mx-0" href="myaccount.php" role="button">Go Back</a>
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
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content rounded-6 shadow-lg">
                    <div class="modal-header bg-dark mb-5 border-bottom-0">
                    <h6 class="modal-title" style="color:white;" ><i class="fas fa-check-circle text-success" style=""></i>&nbsp;&nbsp;Account Details Saved</h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body py-0">
                    
                    <p class="text-center">Account details has been successfully saved !</p>
                    </div>
                    <div class="modal-footer flex-column border-top-0">
                    <a href="myaccount.php" class="btn btn-lg btn-success w-100 mx-0" role="button">Okay</a>
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


include ('includes/footer.html');?>

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