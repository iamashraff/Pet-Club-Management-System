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
                    <title>View User - Admin Dashboard</title>
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
                    <li class="breadcrumb-item active" aria-current="page">View User</li>
                    </ol>
                    </nav>
                    <hr class="mb-3">
                    <?php 
                      include ('../includes/mysqli_connect.php'); 
                      $q = "SELECT member_id, f_name, l_name, email, area_code, mobilehp, birth_date, username FROM members;";
                      $r = @mysqli_query ($dbc, $q);
                      $num = mysqli_num_rows($r);

                      if ($num > 0) {

                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        You have <b>'.$num.' user(s) registered</b> in the system.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';

                        echo '<a style="width:180px;" class="btn btn-primary mb-3" href="adduser.php" role="button"><i class="fa fa-plus-circle"></i>&nbsp;Add User</a>';

                        echo '<table class="table table-hover border border-secondary text-center" style=" font-size:14px; font-family:'; echo" 'abeezeeregular'";echo';">
                        <thead class="table-info">
                          <tr>
                            <th scope="col">Member ID</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Area Code</th>
                            <th scope="col">Mobile Phone</th>
                            <th scope="col">Date of Birth</th>
                            <th scope="col">Username</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>';

                        while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
                          $birthdate = date_create($row['birth_date']);
                          $birthdate = date_format($birthdate,"d M Y");
                          $memberid = $row['member_id'];
                          echo '<tbody>
                          <tr style="font-weight:bold;">
                          <th scope="row">'.$row['member_id'].'</th>
                          <td>'.$row['f_name'].'</td>
                          <td>'.$row['l_name'].'</td>
                          <td>'.$row['email'].'</td>
                          <td>'.$row['area_code'].'</td>
                          <td>'.$row['mobilehp'].'</td>
                          <td>'.$birthdate.'</td>
                          <td>'.$row['username'].'</td>
                          <td><a class="btn btn-sm btn-primary" href="viewuserdetails.php?member='.$memberid.'" role="button"><i class="far fa-eye"></i>&nbsp; View</a> 
                          &nbsp;<a class="btn btn-sm btn-success" href="edituserpass.php?member='.$memberid.'" role="button"><i class="fas fa-edit"></i>&nbsp; Change Password</a>
                          &nbsp;<a class="btn btn-sm btn-success" href="edituser.php?member='.$memberid.'" role="button"><i class="fas fa-user-edit"></i>&nbsp; Edit</a>
                          &nbsp;<a class="btn btn-sm btn-danger" href="deleteuser.php?member='.$memberid.'" role="button"><i class="fas fa-trash-alt"></i>&nbsp; Delete</a></td>
                          </tr>';

                        }//END DO

                        echo '</tbody>
                        </table>';
                        echo '<br><medium class="text-muted"><center><em><i class="fas fa-binoculars"></i></i>&nbsp;&nbsp;End of result</em></center></medium>';

                      }else{

                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle"></i>&nbsp;There are currently no registered users.</div>';
                        echo '<a style="width:180px;" class="btn btn-primary mb-3" href="adduser.php" role="button"><i class="fa fa-plus-circle"></i>&nbsp;Add User</a>';

                      }//END IF
                    
                    ?>
                    
                    </div>

                    
</main>

      <script src="../includes/styles/bootstrap.bundle.min.js"></script>
      <script src="../includes/styles/sidebars.js"></script>
                    
<?php

include ('../includes/footer.html');

if(isset($_GET['adduser']) && $_GET['adduser']=='success'){
  echo '<!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content rounded-6 shadow-lg">
    <div class="modal-header bg-dark mb-5 border-bottom-0">
      <h6 class="modal-title" style="color:white;" ><i class="fas fa-check-circle text-success" style=""></i>&nbsp;&nbsp;User Added</h6>
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body py-0">
      
      <p class="text-center">User has been successfully added to the system !</p>
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


if(isset($_GET['edituser']) && $_GET['edituser']=='success'){
  echo '<!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content rounded-6 shadow-lg">
    <div class="modal-header bg-dark mb-5 border-bottom-0">
      <h6 class="modal-title" style="color:white;" ><i class="fas fa-check-circle text-success" style=""></i>&nbsp;&nbsp;User Edited</h6>
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body py-0">
      
      <p class="text-center">User has been successfully edited !</p>
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


if(isset($_GET['deleteuser']) && $_GET['deleteuser']=='success'){
  echo '<!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content rounded-6 shadow-lg">
    <div class="modal-header bg-dark mb-5 border-bottom-0">
      <h6 class="modal-title" style="color:white;" ><i class="fas fa-check-circle text-success" style=""></i>&nbsp;&nbsp;User Deleted</h6>
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body py-0">
      
      <p class="text-center">User has been successfully deleted !</p>
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



if(isset($_GET['editpass']) && $_GET['editpass']=='success'){
  echo '<!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content rounded-6 shadow-lg">
    <div class="modal-header bg-dark mb-5 border-bottom-0">
      <h6 class="modal-title" style="color:white;" ><i class="fas fa-check-circle text-success" style=""></i>&nbsp;&nbsp;Password Changed</h6>
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body py-0">
      
      <p class="text-center">User password has been successfully changed !</p>
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