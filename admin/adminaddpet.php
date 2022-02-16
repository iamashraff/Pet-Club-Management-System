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
                    <title>Add Pet - Admin Dashboard</title>
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
                    <p class="text-danger" style="font-size:45px; font-weight:bold; font-family: 'abeezeeregular';"><i class="fas fa-cat"></i>&nbsp;&nbsp;Pet Management</p>
                    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a>Admin Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Pet</li>
                    </ol>
                    </nav>
                    <hr class="mb-3">
                    <a class="btn btn-danger" href="viewpet.php" role="button"><i class="fas fa-chevron-left"></i>&nbsp;&nbsp;Back</a>
                    <div class="container py-5 h-100">
                    <div class="row d-flex justify-content-center align-items-center h-90">
                    <?php
                    
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                      // Check for a pet name:
                        if (empty($_POST['petname'])) {
                          $errors[] = 'You forgot to enter your petname.';
                          } else {
                          $pn = trim($_POST['petname']);
                        }//END IF

                       // Check for a pet type:
                        if (empty($_POST['pettype'])) {
                          $errors[] = 'You forgot to enter your pet type.';
                          } else {
                          $pt = trim($_POST['pettype']);
                        }//END IF

                      // Check for a pet gender:
                        if (empty($_POST['petgender'])) {
                          $errors[] = 'You forgot to enter your pet gender.';
                          } else {
                          $pg = trim($_POST['petgender']);
                        }//END IF

                        // Check for a pet gender:
                        if (empty($_POST['memberid'])) {
                          $errors[] = 'You forgot to select user.';
                          } else {
                          $mid = trim($_POST['memberid']);
                        }//END IF
                        
                        if(empty($_POST['check_list'])) {
                          $errors[] = 'Please select at least 1 program';
                          }else{
                          foreach($_POST['check_list'] as $check) {
                          $cb[] = $check;
                          }
                          $program = implode(",",$cb);
                        }//END IF  

                        if (empty($errors)) {
                          require ('../includes/mysqli_connect.php');
                          $q = "INSERT INTO pet_info (pet_type, pet_name, pet_gender, pet_partnership_pro, member_id, date_added) VALUES ('$pt', '$pn', '$pg', '$program', '$mid', NOW() )";
                          $r = @mysqli_query ($dbc, $q);
                              if ($r) {
                                //SUCCESS MESSAGE
                                successMessage();
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


                    }else{


                    addForm();
                    
                    }//END IF
                    ?>
                    </div></div>
                    </div>

                    
</main>
 

<script src="../includes/styles/bootstrap.bundle.min.js"></script>
<script src="../includes/styles/sidebars.js"></script>

<?php


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
  setTimeout("location.href ='; echo "'viewpet.php?addpet=success';"; echo'",2000);
  </script>';

}//END IF


function addForm(){
                    echo'
                      
                      <form action="adminaddpet.php" method="post">
                      <label style="font-size:18px; font-weight:bold;" class="text-success"><i class="fas fa-plus-circle"></i>&nbsp;Add A Pet</label>
                      <p>Please input the details below :</p>
                      <div class="form-floating">
                      <input type="text" class="form-control rounded-5" id="floatpetname" placeholder="Pet Name" name="petname" value="'; if(isset($_POST['petname'])) echo $_POST['petname']; echo'">
                      <label for="floatpetname"><i class="fa fa-tag"></i>&nbsp;Pet Name</label>
                      </div>
                      <br>
            
                      <div class="row g-2">
                      <div class="col-md">
                      <div class="form-floating">
                      <select class="form-select" id="floatingpettype" aria-label="Pet Type" name="pettype">
                        <option selected disabled>Please Select</option>
                        <option>Cat</option>
                        <option>Dog</option>
                        <option>Rabbit</option>
                        <option>Fish</option>
                      </select>
                      <label for="floatingpettype"><i class="fa fa-paw"></i>&nbsp;Pet Type</label>
                    </div>
                      </div>
                      <div class="col-md">
                        <div class="form-floating">
                          <select class="form-select" id="floatingpetgender" aria-label="Pet Gender" name="petgender">
                            <option selected disabled>Please Select</option>
                            <option>Male</option>
                            <option>Female</option>
                          </select>
                          <label for="floatingpetgender"><i class="fa fa-venus-mars" aria-hidden="true"></i>&nbsp;Pet Gender</label>
                        </div>
                      </div>
                    </div>
                    <br>';

                    include ('../includes/mysqli_connect.php');
                    $q = "SELECT f_name, l_name, member_id, username FROM members;";
                    $r = @mysqli_query ($dbc, $q);
                    $num = mysqli_num_rows($r);
                    if ($num > 0) {

                       echo'<div class="row g-2">
                      <div class="col-md">
                      <div class="form-floating">
                      <select class="form-select" id="floatingassignuser" aria-label="Assign User" name="memberid">
                      <option selected disabled>Please Select User</option>'; 

                      while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
                      echo'<option value= "'.$row['member_id'].'">';
                      echo ' '.$row['member_id'].' - '.$row['username'].' ('.$row['f_name'].' '.$row['l_name'].')';
                      echo '</option>';                  

                      }//END DO
                    }else{

                    }//END IF

                    echo '</select>
                    <label for="floatingpettype"><i class="fas fa-user-cog"></i>&nbsp;Assign User</label>
                  </div>
                    </div>
                    </div>
                    ';

                    echo'
                    <br>
                    <label class="mb-2"><i class="fa fa-list-alt"></i>&nbsp;Pet Partnership/ Programs :</label>
                    <div class="row g-2">
                    
                      <div class="col-md">
                        <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="shelterprogram" value="Shelter Program" name="check_list[]">
                        <label class="form-check-label" for="shelterprogram">Shelter Program</label>
                        </div>
                      </div>
            
                      <div class="col-md">
                        <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="breederprogram" value="Breeder Program" name="check_list[]">
                        <label class="form-check-label" for="breederprogram">Breeder Program</label>
                        </div>
                      </div>
                    </div>
            
                    <div class="row g-2">
                    <div class="col-md">
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="petcareacademy" value="Pet Care Academy" name="check_list[]">
                        <label class="form-check-label" for="petcareacademy">Pet Care Academy</label>
                      </div>
                    </div>
            
                    <div class="col-md">
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="animalwelfare" value="Animal Welfare" name="check_list[]">
                        <label class="form-check-label" for="animalwelfare">Animal Welfare</label>
                      </div>
                    </div>
                  </div>
            
                  <div class="row g-2">
                    <div class="col-md">
                        <div class="form-check form-switch">
                          <input class="form-check-input" type="checkbox" id="petphysiotherapy" value="Pet Physiotherapy" name="check_list[]">
                          <label class="form-check-label" for="petphysiotherapy">Pet Physiotherapy</label>
                        </div>
                    </div>
                  </div>
                  
                  <br>
                  <button class="btn btn-primary btn-lg btn-block" type="submit" style="font-size:16px;">Save&nbsp;&nbsp;&nbsp;<i class="fas fa-sign-in-alt"></i></button>
                  </form>
                    ';
                  }//END FUNCTION

include ('../includes/footer.html');

?>