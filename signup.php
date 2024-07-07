<?php

include 'connection.php';

session_start();

if(isset($_SESSION['user_id'])){
  $user_id = $_SESSION['user_id'];
}else{
  $user_id = '';
};

if(isset($_POST['signup'])){

  $username = $_POST['username'];
  $username = filter_var($username, FILTER_UNSAFE_RAW);
  $email = $_POST['email'];
  $email = filter_var($email, FILTER_UNSAFE_RAW);
  $phone = $_POST['phone'];
  $phone = filter_var($phone, FILTER_UNSAFE_RAW);
  $pass = sha1($_POST['pass']);
  $pass = filter_var($pass, FILTER_UNSAFE_RAW);
  $cpass = sha1($_POST['cpass']);
  $cpass = filter_var($cpass, FILTER_UNSAFE_RAW);


  $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
  $select_user->execute([$email,]);
  $row = $select_user->fetch(PDO::FETCH_ASSOC);

  if($select_user->rowCount() > 0){
      $message[] = 'Email already exists!';
  }else{
      if($pass != $cpass){
          $message[] = 'Confirm password not matched!';
      }else{
          $insert_user = $conn->prepare("INSERT INTO `users`(username, email, phone, password) VALUES(?,?,?,?)");
          $insert_user->execute([$username, $email, $phone, $cpass]);
          $message[] = 'Registered successfully, Login now please!';
          header('location:signin.php');
      }
    }
}

?>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Sign Up Form </title>
  <link rel="stylesheet" type="text/css" href="sign.css">
</head>

<body>
<?php
  include_once 'header.php'
  ?>

  <form from="myForm" action="" method="POST">

    <div class="login-box">

      <h1> Sign Up </h1>

      <div class="textbox">
        <input type="text" placeholder="Username" id="fname" name="username" value="" required>
      </div>

      <div class="textbox">
        <input type="text" placeholder="Email" id="email" name="email" value="" required
        pattern="[a-z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-z0-9-]+.[a-z]{2,4}" title="Invalid Email">
      </div>

      <div class="textbox">
        <input type="text" placeholder="Phone" id="phone" name="phone" value="" required 
        onkeypress="return /[0-9]/i.test(event.key)" maxlength="10" pattern="([0-9]){10,}">
      </div>

      <div class="textbox">
        <input type="password" placeholder="Password" id="password" name="pass" value="" maxlength="8"
          pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
          title="Password must contain at least one number and one uppper case and one lowercase letter and 8 characters"
          required>
      </div>

      <div class="textbox">
        <input type="password" placeholder="Confirm Password" id="password" name="cpass" value="" required>
      </div>

      <input class="btn" type="submit" name="signup" value="Sign Up"> <br> <br>

      
      <a href="signin.php"> Already have an account ? </a>
        
      </div>

  </form>


  <script src="script.js"></script>
</body>

</html>