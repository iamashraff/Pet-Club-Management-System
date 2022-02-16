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
                    <title>View User Details - Admin Dashboard</title>
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
                    <li class="breadcrumb-item active" aria-current="page">View User Details</li>
                    </ol>
                    </nav>
                    <hr class="mb-3">
                    <a class="btn btn-danger" onclick="history.back()" role="button"><i class="fas fa-chevron-left"></i>&nbsp;&nbsp;Back</a>
                    <div class="container py-5 h-250">
                    <div class="row d-flex justify-content-center align-items-center h-250">

                    <?php 

                    

                    //SHOW FORM
                            if ( (isset($_GET['member'])) && (is_numeric($_GET['member'])) ) { 
                              $memberid = $_GET['member'];
                              deleteForm($memberid);
                            } elseif ( (isset($_POST['member'])) && (is_numeric($_POST['member'])) ) {
                              $memberid = $_POST['member'];
                              deleteForm($memberid);
                            } else { //IF ID NOT VALID
                              errormemberID();
                            }//END IF
                  
                    ?>

                    </div></div>
                    </div>

                    
</main>
                    
<?php

                    function deleteForm($memberid){

                    //SHOW FORM
                    require ('../includes/mysqli_connect.php');
                    $q = "SELECT member_id, f_name, l_name, email, area_code, mobilehp, birth_date, username FROM members WHERE member_id='$memberid';";
                    $r = @mysqli_query ($dbc, $q);
                    $num = mysqli_num_rows($r);

                    if ($num == 1) {
                      $row = mysqli_fetch_array($r, MYSQLI_ASSOC);
                      //SHOW FORM
                    
                    echo '<label style="font-size:18px; font-weight:bold;" class="text-success mb-3"><i class="far fa-eye"></i>&nbsp;View User Details</label>';
                    
                    echo '<div class="row g-2 mb-2">
                         <div class="col-md">
                            <div class="form-floating">
                              <input type="text" class="form-control rounded-5" value="'.$row['member_id'].'" disabled name="memberid" placeholder="Member ID">
                              <label ><i class="far fa-id-badge"></i>&nbsp;Member ID</label>
                            </div>
                         </div>
                         </div>
                         ';
                    
                    echo '<div class="row g-2 mb-2">
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
                    ';

                    echo '<div class="row g-2 mb-2">
                    <div class="col-md">
                       <div class="form-floating">
                         <input type="text" class="form-control rounded-5" value="'.$row['username'].'" disabled name="username" placeholder="Username">
                         <label ><i class="fas fa-tag"></i>&nbsp;Username</label>
                       </div>
                    </div>

                    <div class="col-md">
                       <div class="form-floating">
                         <input type="email" class="form-control rounded-5" value="'.$row['email'].'" disabled name="email" placeholder="Email">
                         <label><i class="fas fa-at"></i>&nbsp;Email</label>
                       </div>
                    </div>
                  </div>
                  ';
       
                  echo '<div class="row g-2 mb-2">
                  <div class="col-md">
                     <div class="form-floating">
                       <input type="text" class="form-control rounded-5" value="'.$row['area_code'].'" disabled name="areacode" placeholder="Area Code">
                       <label ><i class="fas fa-phone-alt"></i>&nbsp;Area Code</label>
                     </div>
                  </div>

                  <div class="col-md">
                     <div class="form-floating">
                       <input type="text" class="form-control rounded-5" value="'.$row['mobilehp'].'" disabled name="phone" placeholder="Phone Number">
                       <label><i class="fas fa-phone-alt"></i>&nbsp;Phone Number</label>
                     </div>
                  </div>
                  </div>
                  ';

                  echo '<div class="row g-2 mb-4">

                  <div class="col-md">
                  <div class="form-floating">
                      <input type="date" class="form-control rounded-5" value="'.$row['birth_date'].'" id="dob" disabled name="birthdate">
                      <label ><i class="fas fa-birthday-cake"></i>&nbsp;Date of Birth</label>
                  </div>
                  </div>
                  </div>
                  <br>';

                  
                                       
                 echo '<div>';
                 $qpet = "SELECT * FROM pet_info WHERE member_id='$memberid';";
                 $rpet = @mysqli_query ($dbc, $qpet);
                 $numpet = mysqli_num_rows($rpet);
                 $_SESSION['petqty'] = $numpet;
                 
                 if ($numpet >= 1) {
                    echo '<div class="alert alert-info border-info mb-4" role="alert">';
                    echo 'This user has <b>'.$numpet.' pet(s)</b> registered in the system.';
                    echo '</div>';                
                                     
                    echo '<table class="table table-hover border border-secondary text-center" style=" font-size:14px; font-family:'; echo" 'abeezeeregular'";echo';">
                    <thead class="table-info">
                      <tr>
                        <th scope="col">Pet ID</th>
                        <th scope="col">Pet Type</th>
                        <th scope="col">Pet Name</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>';

                      while ($rowpet = mysqli_fetch_array($rpet, MYSQLI_ASSOC)) {
                          echo '<tbody>
                          <tr style="font-weight:bold;">
                          <th scope="row">'.$rowpet['pet_id'].'</th>
                          <td>'.$rowpet['pet_type'].'</td>
                          <td>'.$rowpet['pet_name'].'</td>
                          <td><a class="btn btn-sm btn-primary" href="viewpetdetails.php?pet='.$rowpet['pet_id'].'" role="button"><i class="far fa-eye"></i>&nbsp; View</a></td>
                          </tr>';

                        }//END DO
                    
                        echo '</tbody>
                        </table>';
                        
                 }else{
                    echo '<div class="alert alert-info alert-dismissible fade show" role="alert">
                        This user has <b>no pet</b> added to the system.</div>';

                        echo '<table class="table table-hover border border-secondary text-center" style=" font-size:14px; font-family:'; echo" 'abeezeeregular'";echo';">
                        <thead class="table-info">
                          <tr>
                            <th scope="col">Pet ID</th>
                            <th scope="col">Pet Type</th>
                            <th scope="col">Pet Name</th>
                          </tr>
                        </thead>';

                        echo '<tbody>
                          <tr style="font-weight:bold;">
                          <td></td>
                          <td>No Pet(s) Found.</td>
                          <td></td>';

                          echo '</tbody>
                        </table>';

                 }//END IF

                 echo '<br>';

                 
                 echo '</div>';
                                      



                    }else{
                      //ERROR MESSAGE NOT FIND PET                
                      errormemberID();                 

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


                      function successDelete(){
                    echo '<!-- Modal -->
                    <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content rounded-6 shadow-lg">
                    <div class="modal-header bg-dark mb-4 border-bottom-0">
                    <h6 class="modal-title" style="color:white;" >Deleting...</h6>
                    </div>
                    <div class="modal-body py-0">
                    <img class="me-2" src="../includes/imageres/loading.svg" width="6%"><label class="mb-4">&nbsp;&nbsp;Deleting your data...</label>
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
                    setTimeout("location.href ='; echo "'viewuser.php?deleteuser=success';"; echo'",2000);
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