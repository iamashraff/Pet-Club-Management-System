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
                    <title>View Pet - Admin Dashboard</title>
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
                    <li class="breadcrumb-item active" aria-current="page">View Pet</li>
                    </ol>
                    </nav>
                    <hr class="mb-3">
                    <?php 
                      include ('../includes/mysqli_connect.php');
                      $q = "SELECT pet_info.pet_id, pet_info.pet_type, pet_info.pet_name, pet_info.pet_gender, pet_info.pet_partnership_pro, members.f_name, members.l_name, members.username, members.member_id
                      FROM members INNER JOIN
                      pet_info ON members.member_id = pet_info.member_id ORDER BY pet_id;";
                      $r = @mysqli_query ($dbc, $q);
                      $num = mysqli_num_rows($r);

                      if ($num > 0) {

                       echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
                       You have <b>'.$num.' pet(s)</b> registered in the system.
                       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                       </div>';

                       echo '<a style="width:180px;" class="btn btn-primary mb-3" href="adminaddpet.php" role="button"><i class="fa fa-plus-circle"></i>&nbsp;Add Pet</a>';

                       echo '<table class="table table-hover border border-secondary text-center" style=" font-size:14px; font-family:'; echo" 'abeezeeregular'";echo';">
                        <thead class="table-info">
                          <tr>
                            <th scope="col">Pet ID</th>
                            <th scope="col">Pet Type</th>
                            <th scope="col">Pet Name</th>
                            <th scope="col">Pet Gender</th>
                            <th scope="col">Partnership Program</th>
                            <th scope="col">Owner</th>
                            <th scope="col">Member ID</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>';

                        while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
                          $owner = $row['f_name'].' '.$row['l_name'].' ('.$row['username'].')';
                          echo '<tbody>
                          <tr style="font-weight:bold;">
                          <th scope="row">'.$row['pet_id'].'</th>
                          <td>'.$row['pet_type'].'</td>
                          <td>'.$row['pet_name'].'</td>
                          <td>'.$row['pet_gender'].'</td>
                          <td>'.$row['pet_partnership_pro'].'</td>
                          <td>'.$owner.'</td>
                          <td><a href="viewuserdetails.php?member='.$row['member_id'].'">'.$row['member_id'].'</a></td>
                          <td>
                          <a class="btn btn-sm btn-primary" href="viewpetdetails.php?pet='.$row['pet_id'].'" role="button"><i class="far fa-eye"></i>&nbsp; View</a>
                          &nbsp;<a class="btn btn-sm btn-success" href="admineditpet.php?pet='.$row['pet_id'].'" role="button"><i class="fas fa-edit"></i>&nbsp; Edit</a>
                          &nbsp;<a class="btn btn-sm btn-danger" href="admindeletepet.php?pet='.$row['pet_id'].'" role="button"><i class="fas fa-trash-alt"></i>&nbsp; Delete</a></td>
                          </tr>';              

                        }//END DO
                        echo '</tbody>
                        </table>';
                        echo '<br><medium class="text-muted"><center><em><i class="fas fa-binoculars"></i></i>&nbsp;&nbsp;End of result</em></center></medium><br><br>';

                      }else{

                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle"></i>&nbsp;There are currently no pet registered in the system. Please add a user first then assigned a pet to the user.</div>';
                        
                      }//END IF
                    
                    
                    ?>


                    </div>

                    
</main>

<script src="../includes/styles/bootstrap.bundle.min.js"></script>
<script src="../includes/styles/sidebars.js"></script>
                    
<?php 
include ('../includes/footer.html');


if(isset($_GET['editpet']) && $_GET['editpet']=='success'){
  echo '<!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content rounded-6 shadow-lg">
    <div class="modal-header bg-dark mb-5 border-bottom-0">
      <h6 class="modal-title" style="color:white;" ><i class="fas fa-check-circle text-success" style=""></i>&nbsp;&nbsp;Pet Edited</h6>
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body py-0">
      
      <p class="text-center">Pet has been edited successfully !</p>
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


if(isset($_GET['deletepet']) && $_GET['deletepet']=='success'){
  echo '<!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content rounded-6 shadow-lg">
    <div class="modal-header bg-dark mb-5 border-bottom-0">
      <h6 class="modal-title" style="color:white;" ><i class="fas fa-check-circle text-success" style=""></i>&nbsp;&nbsp;Pet Deleted</h6>
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body py-0">
      
      <p class="text-center">Pet has been deleted successfully !</p>
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
}

if(isset($_GET['addpet']) && $_GET['addpet']=='success'){
  echo '<!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content rounded-6 shadow-lg">
    <div class="modal-header bg-dark mb-5 border-bottom-0">
      <h6 class="modal-title" style="color:white;" ><i class="fas fa-check-circle text-success" style=""></i>&nbsp;&nbsp;Pet Added</h6>
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body py-0">
      
      <p class="text-center">Pet has been added successfully !</p>
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
?>