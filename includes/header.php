<!DOCTYPE html>
<html lang="en">

 <head>

      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      
      <title>My Program</title>
    
      <?php $pagename = basename($_SERVER['PHP_SELF']); 
      if ($pagename=="admin_login.php" || $pagename=="viewuser.php" || $pagename=="adduser.php" || $pagename=="edituser.php" || $pagename=="edituserpass.php" || $pagename=="deleteuser.php" || $pagename=="viewpet.php" || $pagename=="adminaddpet.php" || $pagename=="admineditpet.php" || $pagename=="admindeletepet.php" || $pagename=="viewuserdetails.php" || $pagename=="viewpetdetails.php" ){
        $dir_str ="../";

      }else {
        $dir_str ="";
      }
      ?>
      
      <!-- Font Awesome -->
      <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet"/>

      <!-- Google Fonts -->
      <link href="<?php echo $dir_str; ?>includes/styles/google-font-roboto.css" rel="stylesheet"/>
      

      <!-- FontAwesome -->
      <link href="<?php echo $dir_str; ?>includes/styles/all.css" rel="stylesheet">

      <!-- Font -->
      <link href="<?php echo $dir_str; ?>includes/fontkit/stylesheet.css" rel="stylesheet">
      <link href="<?php echo $dir_str; ?>includes/fontkit/kaushanscript.css" rel="stylesheet">

      <!-- MDB -->
      <link href="<?php echo $dir_str; ?>includes/styles/mdb.min.css" rel="stylesheet"/>

      <!-- MDB -->
      <script
      type="text/javascript"
      src="<?php echo $dir_str; ?>includes/styles/mdb.min.js"
      ></script>
      
      <!-- Bootstrap core CSS -->
      <link href="<?php echo $dir_str; ?>includes/styles/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

      <!-- Favicon -->
      <?php include ('favicon.php'); ?>


</head>
                    
 <body>
   <header>

  <!-- Fixed navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark shadow-lg" style="height: 70px;">
    <div class="container-fluid" style="margin-left:40px;">
      <img class="me-2" src="<?php echo $dir_str; ?>includes/imageres/logo.png" width="45" >
      <a style="font-family: 'hello_calanthe_demoregular'; font-size:30px; margin-top:10px;" class="navbar-brand" href="<?php echo $dir_str; ?>index.php">Pet Corner Club</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div style="margin-left:20px;" class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item active">
            <a class="nav-link" aria-current="page" href="<?php echo $dir_str; ?>index.php">Home</a>
          </li>

          <?php if(!isset($_SESSION["admin_id"]) && !isset($_SESSION["memberid"])){ ?>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo $dir_str; ?>register.php">Join Us</a>
          </li>
          <?php }else{ 
            if ($pagename=="index.php" && isset($_SESSION["admin_id"])){
              $dir_str = "admin/";
            }else{
              $dir_str = "";
            }
            
            ?>
            <li class="nav-item">
            <a class="nav-link" href="<?php echo $dir_str; ?>logout.php">Logout</a>
          </li>
           <?php }?>

        </ul>

        <form class="d-flex" style="margin-right:20px;">
        
                    <!--RIGHT-->
                    
                    <?php
                    if(isset($_SESSION["memberid"])){
                      $f_name = $_SESSION["fname"];
                      $l_name = $_SESSION["lname"];
                      echo'<!-- Primary -->
                      <div class="btn-group" style="margin-top:0px; margin-left:-10%;">
                        <button
                          type="button"
                          style="font-family: '; echo"'abeezeeregular';"; echo 'font-size:14px; font-weight:bold; color:black; height:110%;" class="btn btn-danger dropdown-toggle shadow-lg border border-dark"
                          data-mdb-toggle="dropdown"
                          aria-expanded="false"
                        >';
                          echo '<i class="fas fa-user"></i>&nbsp;&nbsp;&nbsp;'; echo "Holla,  ".$f_name." ".$l_name." ";
                        echo '</button>
                        <ul class="dropdown-menu" style="font-size:15px; font-weight:bold;">
                          <li><a class="dropdown-item" href="myaccount.php"><i class="fas fa-stream"></i>&nbsp;&nbsp; My Account</a></li>
                          <li><a class="dropdown-item" href="mypet.php"><i class="fas fa-paw"></i>&nbsp;&nbsp; My Pet</a></li>
                          <li>
                            <hr class="dropdown-divider" />
                          </li>
                          <li><a class="dropdown-item text-danger" href="logout.php"><i class="fas fa-sign-out-alt"></i>&nbsp;&nbsp; <b>Logout</b></a></li>
                        </ul>
                      </div>';
                    }else{


                    }//END IF

                    if($pagename=="login.php"){
                      echo'<a href="admin" class="btn btn-light me-2" role="button" style="font-size:14px; color:black; width:150px;" data-mdb-ripple-color="dark"><i class="fas fa-users"></i>&nbsp;&nbsp;Admin Login</a>';
                    }

                    if ($pagename=="admin_login.php"){
                      echo'<a href="../login.php" class="btn btn-light me-2" role="button" style="font-size:14px; color:black; width:150px;" data-mdb-ripple-color="dark"><i class="fas fa-user"></i>&nbsp;&nbsp;User Login</a>';
                    }//END IF
                    
                    if(isset($_SESSION["admin_id"])){
                      $admin_un = $_SESSION["admin_username"];

                      if($pagename=="index.php"){
                        $strLink = "admin/";
                      }else{
                        $strLink = "";
                      }//END IF
            
                      echo'<!-- Primary -->
                      <div class="btn-group" style="margin-top:0px; margin-left:-10%;">
                        <button
                          type="button"
                          style="font-family: '; echo"'abeezeeregular';"; echo 'font-size:14px; font-weight:bold; color:black; height:110%;" class="btn btn-danger dropdown-toggle shadow-lg border border-dark"
                          data-mdb-toggle="dropdown"
                          aria-expanded="false"
                        >';
                          echo '<i class="fas fa-users"></i>&nbsp;&nbsp;&nbsp;'; echo "Hi,  ".$admin_un." ";
                        echo '</button>
                        <ul class="dropdown-menu" style="font-size:15px; font-weight:bold;">
                          <li><a class="dropdown-item" href="'.$strLink.'viewuser.php"><i class="fas fa-stream"></i>&nbsp;&nbsp; User Management</a></li>
                          <li><a class="dropdown-item" href="'.$strLink.'viewpet.php"><i class="fas fa-paw"></i>&nbsp;&nbsp; Pet Management</a></li>
                          <li>
                            <hr class="dropdown-divider" />
                          </li>
                          <li><a class="dropdown-item text-danger" href="logout.php"><i class="fas fa-sign-out-alt"></i>&nbsp;&nbsp; <b>Logout</b></a></li>
                        </ul>
                      </div>';



                    }//END IF

                    if(!isset($_SESSION["admin_id"]) && !isset($_SESSION["memberid"])){

                      if($pagename=="index.php"){

                        echo '<a href="login.php" class="btn btn-light me-2" role="button" style="font-size:14px; color:black; width:120px;" data-mdb-ripple-color="dark"><i class="fas fa-user"></i>&nbsp;&nbsp;Login</a>
                        <a href="register.php" class="btn btn-danger me" role="button" style="font-size:14px; color:black; width:150px;" data-mdb-ripple-color="dark"><i class="fas fa-user-edit"></i>&nbsp;&nbsp;Register</a>';

                      }//END IF

                    }//END IF
                    

                    ?>

        </form>
      </div>
    </div>
  </nav>
  <!-- End Fixed navbar -->    

 </header>
 <!--INCLUDE JAVASCRIPT-->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
 