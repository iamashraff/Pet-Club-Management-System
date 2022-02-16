<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Home Page</title>
   <?php include ('includes/header.php') ?>
   <style>
      #intro {
        background-image: url("includes/imageres/cat_banner.jpg");
        height: 106.3vh;
      }

      /* Height for devices larger than 576px */
      @media (min-width: 1024px) {
        #intro {
          margin-top: -58.59px;
        }
      }

      .navbar .nav-link {
        color: #fff !important;
      }
    </style>
    <!-- Background image -->
    <div id="intro" class="bg-image shadow-lg">
      <div class="mask" style="background-color: rgba(0, 0, 0, 0.5);">
        <div class="container d-flex align-items-center justify-content-center text-center h-100">
          <div class="text-white">
            <h1 style="margin-top:30px; font-family: 'abeezeeregular';">Welcome to</h1>
            <p style="margin-top:-30px; font-size: 80px; font-family: 'hello_calanthe_demoregular'; text-shadow: 0px 0px 12px rgb(255,255,255);">Pet Corner Club</p>
            <h5 style="font-family: 'abeezeeregular';">You're welcome to the family of Pet Lovers</h5>
            <br>
            <button onclick="window.location.href='register.php'" style="font-family: 'abeezeeregular'; font-size:20px; width:30%;" type="button" class="btn btn-outline-light shadow-lg" data-mdb-ripple-color="dark">Join Us</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Background image -->

</head>
<body>

<section class="border-top border-dark bg-light">

  <div class="container" style="margin-top:80px;">
      <div class="row">
        <p style="text-align:center; font-size: 40px; font-family: 'abeezeeregular';" >Why you need to join us ?</p>
      </div>
      <br>
      <br>
      <div class="row">
        <div class="col">
          <div class="card shadow border text-center" style="height:240px;">
            <div class="card-body" >
             <br>
             <i style="font-size:50px;" class="text-info fas fa-gift"></i>
             <h5 class="text-info" style="margin-top:10px;" class="card-title">Free Registration</h5>
             <p>Create profiles for you and your pets.</p>
             
            </div>
          </div>

        </div>

        <div class="col">
          <div class="card shadow border text-center" style="height:240px;">
            <div class="card-body" >
             <br>
             <i style="font-size:50px;" class="text-success fas fa-user-friends"></i>
             <h5 class="text-success" style="margin-top:10px;" class="card-title">Friendly Community</h5>
             <p>Be part of the our community where you can schedule play dates.</p>
             
            </div>
          </div>

        </div>

        <div class="col">
          <div class="card shadow border text-center" style="height:240px;">
            <div class="card-body" >
             <br>
             <i style="font-size:50px;" class="text-danger fas fa-heart"></i>
             <h5 class="text-danger" style="margin-top:10px;" class="card-title">Adoption Center</h5>
             <p>You can adopt or list a pet for adoption</p>
             
            </div>
          </div>

        </div>
        
      </div>

  </div>
  <br><br><br><br><br><br><br><br>

</section>

<section>
<style>
      #subsection2 {
        background-image: url("includes/imageres/rabbit_banner.jpg");
        height: 50vh;
      }

      /* Height for devices larger than 576px */
      @media (min-width: 1024px) {
        #subsection2 {
          margin-top: -58.59px;
        }
      }

      .navbar .nav-link {
        color: #fff !important;
      }
    </style>
    <!-- Background image -->
    <div id="subsection2" class="bg-image shadow-lg">
      <div class="mask" style="background-color: rgba(0, 0, 0, 0.5);">
        <div class="container d-flex align-items-center justify-content-center text-center h-100">
          <div class="text-white">

            <p style="margin-top:-30px; font-size: 80px; font-family: 'kaushan_scriptregular';">We Love Pets</p>
            <h5 style="font-family: 'abeezeeregular';">The <label style="font-size:24px; font-family: 'hello_calanthe_demoregular';">Pet Corner Club</label> team comprises pet lovers, nutritionists and even the expert help.<br>Join today to start receiving news, advice and tips!</h5>
            <br>
            <button onclick="window.location.href='register.php'" style="font-family: 'abeezeeregular'; font-size:15px; height:50px;" type="button" class="btn btn-success btn-rounded shadow-lg" data-mdb-ripple-color="dark">
            Join Us Today - <b>It's Free !</b>
            </button>
            <br>
            
          </div>
        </div>
      </div>
    </div>
    <!-- Background image -->
</section>

<section>
  <br><br><br>

  <div class="container">
    <div class="row mx-auto">
      <div class="col">
        <img class="me-2" src="includes/imageres/dogcat.webp" width="100%">
      </div>

      <div class="col">
        <br><br>
        <p class="text-success" style="font-family: 'abeezeeregular'; font-size:45px; font-weight:bold;">Pet Adoption. Be Part of Something <label style="font-family: 'kaushan_scriptregular';" class="text-danger">Beautiful </label>&nbsp;<i style="font-size:40px;" class="text-danger fas fa-heart"></i> !</p>
        <h5 style="font-family: 'abeezeeregular';">We have a large selection of cats and dogs. our animals
        are spayed-neutered, micro chipped and given vaccines.</h5>
      </div>

    </div>
  </div>
  <br>
</section>

<section style="background-color:#FFB200;">
<div class="row">
<div class="col-md-1">

  <img src="includes/imageres/cat.png" width="240px;">
</div>

<div class="col">
<br><br><br><br><br><br><br>
          <div class="container">
            <p class="text-center" style="text-shadow: 0px 0px 8px rgb(0,0,0); margin-left:100px; margin-right:100px; font-size:28px; font-family: 'abeezeeregular'; font-weight:bold; color:white;"><label style="font-size:40px; font-family: 'hello_calanthe_demoregular';">Pet Corner Club</label> provides you with the necessary information and 
            resources members need to help their pets live healthier lives.</p>
          </div>
</div>

</div>
</section>
                 
<?php include ('includes/footer.html') ?>