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
                    <title>View Pet Details - Admin Dashboard</title>
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
                    <li class="breadcrumb-item active" aria-current="page">View Pet Details</li>
                    </ol>
                    </nav>
                    <hr class="mb-3">
                    <a class="btn btn-danger" onclick="history.back()" role="button"><i class="fas fa-chevron-left"></i>&nbsp;&nbsp;Back</a>
                    <div class="container py-5 h-250">

                    <?php 

                    //SHOW FORM
                            //SHOW FORM
                            if ( (isset($_GET['pet'])) && (is_numeric($_GET['pet'])) ) { 
                                        $petid = $_GET['pet'];
                                        delForm($petid);
                                      } elseif ( (isset($_POST['pet'])) && (is_numeric($_POST['pet'])) ) {
                                        $petid = $_POST['member'];
                                        delForm($petid);
                                      } else { //IF ID NOT VALID
                                        errormemberID();
                            }//END IF
                  
                    ?>

                    </div></div>
                    </div>

                    
</main>
<script src="../includes/styles/bootstrap.bundle.min.js"></script>
<script src="../includes/styles/sidebars.js"></script>
                    
<?php 
include ('../includes/footer.html');

function delForm($petid){
                    
                    require ('../includes/mysqli_connect.php');
                    $petid = $_GET['pet'];
                    $q = "SELECT pet_info.pet_id, pet_info.pet_type, pet_info.pet_name, pet_info.pet_gender, pet_info.pet_partnership_pro, members.f_name, members.l_name, members.username, members.member_id, members.email, members.area_code, members.mobilehp, members.birth_date 
                    FROM members 
                    INNER JOIN pet_info 
                    ON members.member_id = pet_info.member_id 
                    WHERE pet_id='$petid';";
                    
                    $r = @mysqli_query ($dbc, $q);
                    $num = mysqli_num_rows($r);

                    if ($num == 1) {
                      $row = mysqli_fetch_array($r, MYSQLI_ASSOC);
                      //SHOW FORM
                      echo '<form action="admindeletepet.php?pet='.$petid.'" method="post">';                  
                      echo'
                      <label style="font-size:18px; font-weight:bold;" class="text-success mb-3"><i class="far fa-eye"></i>&nbsp;View Pet Details</label>';

                      echo'
                      <form action="admineditpet.php?pet='; echo $petid; echo'" method="post">
                      <div class="row g-2">
                      <div class="col-md">
                        <div class="form-floating">
                        <input type="text" class="form-control rounded-5" value="';echo $row['pet_id']; echo'" disabled>
                        <label for="floatpetid"><i class="fa fa-id-badge"></i></i>&nbsp;Pet ID</label>
                        </div>         
                      </div>
                      </div>
                      <br>';
                      
                      
                      echo '<div class="row g-2">
                      <div class="col-md">
                      <div class="form-floating">
                      <input type="text" class="form-control rounded-5" value="';echo $row['pet_name']; echo'" name="petname" disabled>
                      <label for="floatpetname"><i class="fa fa-tag"></i>&nbsp;Pet Name</label>
                      </div>         
                    </div>
                    </div>
                    <br>';
                    
                    
                    echo '<div class="row g-2">
                      <div class="col-md">
                          <div class="form-floating">
                          <select class="form-select" id="floatingpettype" aria-label="Pet Type" name="pettype" disabled>';

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
                          <select class="form-select" id="floatingpetgender" aria-label="Pet Gender" name="petgender" disabled>';
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


                    echo '<div class="row g-2">
                    <div class="col-md">
                    <div class="form-floating">
                    <textarea disabled class="form-control" style="height: 60px">';echo $row['pet_partnership_pro']; echo'</textarea>
                    <label for="floatingTextarea"><i class="fa fa-list-alt"></i>&nbsp;Pet Partnership/ Program</label>
                    </div>
                    </div>
                    </div>
                    <br>';


                  echo '<div class="alert alert-info border-info mb-4" role="alert">';
                    echo 'This pet owned by <b><i>'.$row['username'].'</i></b>';
                    echo '</div>';
                    
                  echo'<div class="row g-2">
                    <div class="col-md">
                    <table class="table table-hover border border-secondary text-center" style=" font-size:14px; font-family:'; echo" 'abeezeeregular'";echo';">
                    <thead class="table-info">
                      <tr>
                        <th scope="col">Member ID</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Username</th>
                        <th scope="col">Action</th>

                      </tr>
                    </thead>
                    <tbody>
                          <tr style="font-weight:bold;">
                          <th scope="row">'.$row['member_id'].'</th>
                          <td>'.$row['f_name'].'</td>
                          <td>'.$row['l_name'].'</td>
                          <td>'.$row['username'].'</td>
                          <td><a class="btn btn-sm btn-primary" href="viewuserdetails.php?member='.$row['member_id'].'" role="button"><i class="far fa-eye"></i>&nbsp; View</a></td>
                          </tr>
                    </tbody>
                    </table>
                    </div>
                  </div>';


                    echo '</form>';
                    

                    }else{

                    }


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

?>