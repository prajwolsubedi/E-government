<?php

include 'connection.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
};

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Birth Registration</title>
    <link rel="stylesheet" href="index.css">
    
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

</head>
<body>
  <?php
  include_once 'header.php'
  ?>
  
      <div class="hero">
        <div class="hero-text">
          <h1>
            Birth registraion site
          </h1>
          This is a birth registration sigh hosted by <span class="red">Government of Nepal</span>
          <p>
            <button class="btn"><a href="birth_form.php">Fill the form</a></button>
          </p>
        </div>
        <div class="hero-image">
          <img src="hero.png" alt="">
        </div>

      </div >


      <?php
  include_once 'footer.php'
  ?>



<script src="script.js"></script>

</body>
</html>