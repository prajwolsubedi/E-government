<?php

include 'connection.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
};

if(isset($_POST['submit'])){

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_UNSAFE_RAW);
    $pass = sha1($_POST['pass']);
    $pass = filter_var($pass, FILTER_UNSAFE_RAW);

    $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
    $select_user->execute([$email, $pass]);
    $row = $select_user->fetch(PDO::FETCH_ASSOC);

    if($select_user->rowCount() > 0){
        $_SESSION['user_id'] = $row['id'];
        header('location:index.php');
    }else{
        $message[] = 'Incorrect Email or Password!';
    }

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Sign In Form </title>
  <link rel="stylesheet" type="text/css" href="sign.css">
  
</head> 

<body>
<?php
  include 'header.php'
  ?>

  <form name="myForm" action="" method="POST">
    <div class="login-box">

      <h1> Sign In </h1>

      <div class="textbox">

        <input type="email" placeholder="Email" name="email" value="" required>

      </div>
      <div class="textbox">
        <input type="password" placeholder="Password" name="pass" value="" maxlength="8" required>
      </div>

      <input class="btn" type="submit" name="submit" value="Sign in">
      <p > <a href="signup.php"> Don't have an account ? </a>
      <p><a href="admin_signin.php">Are you an admin?</a></p>
    </div>
  </form>


  <script src="script.js"></script>
</body>
</html>