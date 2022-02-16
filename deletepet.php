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
                    <title>Delete Pet - My Pets</title>
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
                    <p class="text-danger" style="font-size:45px; font-weight:bold; font-family: 'abeezeeregular';"><i class="fas fa-cat"></i>&nbsp;&nbsp;My Pets</p>
                    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a>Dashboard</a></li>
                    <li class="breadcrumb-item"><a>My Pets</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Delete Pet</li>
                    </ol>
                    </nav>
                    <hr class="mb-3">
                    <a class="btn btn-danger" href="mypet.php" role="button"><i class="fas fa-chevron-left"></i>&nbsp;&nbsp;Back</a>
                    <div class="container py-5 h-100">
                    <div class="row d-flex justify-content-center align-items-center h-90">
                    <?php 
                    
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                      $petid = $_GET['pet'];
                      require ('includes/mysqli_connect.php');
                      $q = "DELETE FROM pet_info WHERE pet_id='$petid'";
                      $r = @mysqli_query ($dbc, $q);

                      if (mysqli_affected_rows($dbc) == 1) {
                        //QUERY SUCCESSFUL
                        successDelete();
                      }else {
                        //QUERY UNSUCCESSFUL
                        errorpetID();
                      }//END IF
                      

                    }else{//SHOW FORM
                      if ( (isset($_GET['pet'])) && (is_numeric($_GET['pet'])) ) { 
                        $petid = $_GET['pet'];
                        showForm($petid);
                      } elseif ( (isset($_POST['pet'])) && (is_numeric($_POST['pet'])) ) {
                        $petid = $_POST['pet'];
                        showForm($petid);
                      } else { //IF ID NOT VALID
                        errorpetID();
                      }//END IF


                    }//END IF
                    
                    ?>
                    </div></div>

                    </div>

</main>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
          $('#yesDelete').focus();
            $("#yesDelete").change(function(){
                if($(this).prop("checked")){
                    $("#delBtn").prop("disabled",false);
                }
                else{
                    $("#delBtn").prop("disabled",true);
                }
            });
        });
    </script>
                 
                    
<?php 

function showForm($petid){
  require ('includes/mysqli_connect.php');
  $memberid = $_SESSION["memberid"];
  $q = "SELECT * FROM pet_info WHERE member_id='$memberid' AND pet_id='$petid';";
  $r = @mysqli_query ($dbc, $q);
  $num = mysqli_num_rows($r);

  if ($num == 1) {
    $row = mysqli_fetch_array($r, MYSQLI_ASSOC);

    
    echo '<label style="font-size:18px; font-weight:bold;" class="text-danger mb-3"><i class="fa fa-trash"></i>&nbsp;Delete A Pet</label>
    <div class="alert alert-danger border-danger" role="alert">';
    echo '<div><i class="fa fa-question-circle"></i>&nbsp;&nbsp;Are you sure to delete your pet name <b>'; echo $row['pet_name']; echo '</b> ?</div></div>';
    echo'<div class="row g-2">
            <div class="col-md">
              <div class="form-floating">
              <input type="text" class="form-control rounded-5" value="';echo $row['pet_id']; echo'" disabled>
              <label for="floatpetid"><i class="fa fa-id-badge"></i></i>&nbsp;Pet ID</label>
              </div>         
            </div>


            <div class="col-md">
              <div class="form-floating">
              <input type="text" class="form-control rounded-5" value="';echo $row['pet_name']; echo'" disabled>
              <label for="floatpetname"><i class="fa fa-tag"></i>&nbsp;Pet Name</label>
              </div>         
            </div>

         </div>';

    echo'<div class="row g-2">
         <div class="col-md">
           <div class="form-floating">
           <input type="text" class="form-control rounded-5" value="';echo $row['pet_type']; echo'" disabled>
           <label for="floatpettype"><i class="fa fa-paw"></i>&nbsp;Pet Type</label>
           </div>         
         </div>


         <div class="col-md">
           <div class="form-floating">
           <input type="text" class="form-control rounded-5" value="';echo $row['pet_gender']; echo'" disabled>
           <label for="floatpetgender"><i class="fa fa-venus-mars"></i>&nbsp;Pet Gender</label>
           </div>         
         </div>

      </div>';

      echo '<div class="row g-2 mb-3">
        <div class="col-md">
        <div class="form-floating">
        <textarea disabled class="form-control" style="height: 80px">';echo $row['pet_partnership_pro']; echo'</textarea>
        <label for="floatingTextarea"><i class="fa fa-list-alt"></i>&nbsp;Pet Partnership/ Program</label>
        </div>
        </div>
        </div>';


        echo '
        <form action="deletepet.php?pet='; echo $row['pet_id']; echo'" method="post">
        <div class="row g-2 mb-2">
          <div class="col-md">
            <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="yesDelete" name="yesDelete">
            <label class="form-check-label" for="yesDelete">Yes, I want to delete my pet <b><i>'; echo $row['pet_name']; echo'</i></b> from the system.</label>
            </div>
          </div>
        </div>';

        echo '<div class="row g-2">
        <div class="col-md">
        <button class="btn btn-danger btn-lg btn-block" id="delBtn" name="delBtn" type="submit" style="font-size:16px;" disabled="disabled"><i class="fa fa-trash"></i>&nbsp;&nbsp;Delete</button> 
        </div></div>
        </form>';


  }else{
    //ERROR MESSAGE NOT FIND PET
    errorpetID();
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


function successDelete(){
  echo '<!-- Modal -->
  <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content rounded-6 shadow-lg">
  <div class="modal-header bg-dark mb-4 border-bottom-0">
  <h6 class="modal-title" style="color:white;" >Deleting...</h6>
  </div>
  <div class="modal-body py-0">
  <img class="me-2" src="includes/imageres/loading.svg" width="6%"><label class="mb-4">&nbsp;&nbsp;Deleting your data...</label>
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
  setTimeout("location.href ='; echo "'mypet.php?deletepet=success';"; echo'",2000);
  </script>';
}//

include ('includes/footer.html'); ?>
