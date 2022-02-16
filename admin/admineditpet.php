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
                    <title>Edit Pet - Admin Dashboard</title>
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
                    <li class="breadcrumb-item active" aria-current="page">Edit Pet</li>
                    </ol>
                    </nav>
                    <hr class="mb-3">
                    <a class="btn btn-danger" href="viewpet.php" role="button"><i class="fas fa-chevron-left"></i>&nbsp;&nbsp;Back</a>
                    <div class="container py-5 h-100">
                    <div class="row d-flex justify-content-center align-items-center h-90">

                    <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                       $errors = array();

                                        $petid = $_GET['pet'];
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
                                        $errors[] = 'You forgot to enter your member id.';
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
                                           $q = "UPDATE pet_info SET pet_name='$pn' , pet_type='$pt', pet_gender='$pg', pet_partnership_pro='$program', member_id='$mid' WHERE pet_id='$petid'";
                                           $r = @mysqli_query ($dbc, $q);             
                                           if (mysqli_affected_rows($dbc) == 1) {
                                                //SUCCESS MESSAGE
                                                                            
                                                  successMessage();

                                           }else{
                                    
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
                                        

                                        if ( (isset($_GET['pet'])) && (is_numeric($_GET['pet'])) ) { 
                                                            $petid = $_GET['pet'];
                                                            showeditForm($petid);
                                                          } elseif ( (isset($_POST['pet'])) && (is_numeric($_POST['pet'])) ) {
                                                            $petid = $_POST['pet'];
                                                            showeditForm($petid);
                                                          } else { //IF ID NOT VALID
                                                            errorpetID();
                                        }//END IF            



                    }//END IF


                    
                    ?>


                    </div></div>
                    </div>

                    
</main>
 

<script src="../includes/styles/bootstrap.bundle.min.js"></script>
<script src="../includes/styles/sidebars.js"></script>
<?php 
include ('../includes/footer.html');


function showeditForm($petid){
                    require ('../includes/mysqli_connect.php');
                    $petid = $_GET['pet'];
                    $q = "SELECT pet_info.pet_id, pet_info.pet_type, pet_info.pet_name, pet_info.pet_gender, pet_info.pet_partnership_pro, members.f_name, members.l_name, members.username, members.member_id 
                    FROM members 
                    INNER JOIN pet_info 
                    ON members.member_id = pet_info.member_id 
                    WHERE pet_id='$petid';";
                    
                    $r = @mysqli_query ($dbc, $q);
                    $num = mysqli_num_rows($r);

                    if ($num == 1) {
                      $row = mysqli_fetch_array($r, MYSQLI_ASSOC);
                      //SHOW FORM

                      echo'
                      <label style="font-size:18px; font-weight:bold;" class="text-primary mb-3"><i class="fas fa-edit"></i>&nbsp;Edit A Pet</label>
                      <div class="alert alert-info border-info" role="alert">
                      <i class="fas fa-exclamation-circle"></i>&nbsp;&nbsp;You are going to make changes for pet <b><i>'; echo $row['pet_name']; echo'.</i></b> Click on Save Changes button to continue.';

                      echo'
                      <form action="admineditpet.php?pet='; echo $petid; echo'" method="post">
                      </div>
                      <div class="row g-2">
                      <div class="col-md">
                        <div class="form-floating">
                        <input type="text" class="form-control rounded-5" value="';echo $row['pet_id']; echo'" disabled>
                        <label for="floatpetid"><i class="fa fa-id-badge"></i></i>&nbsp;Pet ID</label>
                        </div>         
                      </div>
                      </div>';
                      
                      
                      echo '<div class="row g-2">
                      <div class="col-md">
                      <div class="form-floating">
                      <input type="text" class="form-control rounded-5" value="';echo $row['pet_name']; echo'" name="petname">
                      <label for="floatpetname"><i class="fa fa-tag"></i>&nbsp;Pet Name</label>
                      </div>         
                    </div>
                    </div>';
                    
                    
                    echo '<div class="row g-2">
                      <div class="col-md">
                          <div class="form-floating">
                          <select class="form-select" id="floatingpettype" aria-label="Pet Type" name="pettype">';

                          $ptype = array("Cat", "Dog", "Rabbit", "Fish");

                         for($i=0; $i<count($ptype); $i++){
                          echo '<option ';
                          if ($row['pet_type'] == $ptype[$i]){
                            echo ' selected="selected"';
                          }
                          echo ' >'.$ptype[$i].'</option>';
                         }//END DO

                          echo'
                          </select>
                          <label for="floatingpettype"><i class="fa fa-paw"></i>&nbsp;Pet Type</label>
                         </div>                        
                      </div>

                      <div class="col-md">
                          <div class="form-floating">
                          <select class="form-select" id="floatingpetgender" aria-label="Pet Gender" name="petgender">';
                          $pgen = array("Male", "Female");
                          for($i=0; $i<count($pgen); $i++){
                            echo '<option ';
                            if ($row['pet_gender'] == $pgen[$i]){
                              echo ' selected="selected"';
                            }
                            echo ' >'.$pgen[$i].'</option>';
                           }//END DO
                          
                          echo'
                          </select>
                          <label for="floatingpetgender"><i class="fa fa-venus-mars" aria-hidden="true"></i>&nbsp;Pet Gender</label>
                         </div>                        
                      </div>
                    </div><br>';

                       $mid = $row['member_id'];    
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
                        
                        if($mid == $row['member_id']){
                          $strSelect = "selected";
                        }else{
                          $strSelect = "";                             
                        }

                        echo'<option value= "'.$row['member_id'].'" '.$strSelect.'>';
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

                      $q = "SELECT pet_info.pet_id, pet_info.pet_type, pet_info.pet_name, pet_info.pet_gender, pet_info.pet_partnership_pro, members.f_name, members.l_name, members.username, members.member_id 
                      FROM members 
                      INNER JOIN pet_info 
                      ON members.member_id = pet_info.member_id 
                      WHERE pet_id='$petid';";
                      
                      $r = @mysqli_query ($dbc, $q);
                      $row = mysqli_fetch_array($r, MYSQLI_ASSOC);


                    echo'
                    <div class="row g-2 mb-3">
                    <label class="mb-2"><i class="fa fa-list-alt"></i>&nbsp;Pet Partnership/ Programs :</label>';
                    
                    $listpname = array("Shelter Program", "Breeder Program", "Pet Care Academy", "Animal Welfare", "Pet Physiotherapy");
                    $pname = $row['pet_partnership_pro'];
                    
                    $pname_arr = explode (",", $pname); 
                    for ($i = 0; $i<count($listpname); $i++ ){
                      echo '<div class="col-md">';
                      echo '<div class="form-check form-switch">';
                      echo '<input class="form-check-input" type="checkbox" value="'; echo $listpname[$i]; echo'" name="check_list[]"'; 
                      for ($j = 0; $j<count($pname_arr); $j++ ){
                        if($pname_arr[$j]==$listpname[$i]){
                          echo 'checked';
                        }
                      }
                      echo'>';
                      echo '<label class="form-check-label">'; echo $listpname[$i]; echo'</label>';
                      echo '</div>';
                      echo '</div>';
                    }       

                    
                    echo'

                    </div>';

                    echo '<div class="row g-2 mb-2">
                   <div class="col-md">
                     <div class="form-check form-switch">
                     <input class="form-check-input" type="checkbox" role="switch" id="yesChange" name="yesChange">
                     <label class="form-check-label text-danger" for="yesChange">Yes, I am sure to make a changes !</label>
                     </div>
                   </div>
                   </div>';

                    echo '<button class="btn btn-primary btn-lg btn-block" type="submit" id="saveBtn" name="saveBtn" style="font-size:16px;" disabled><i class="fas fa-save"></i>&nbsp; Save changes</button>
                          </form>';


                          

                    }else{
                      //ERROR MESSAGE NOT FIND PET
                      
                    }//END IF

                  }//END FUNCTION


                  function errorpetID(){
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
                    <a class="btn btn-lg btn-danger w-100 mx-0" href="mypet.php" role="button">Go Back</a>
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
                      setTimeout("location.href ='; echo "'viewpet.php?editpet=success';"; echo'",2000);
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