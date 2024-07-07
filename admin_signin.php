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
    $pass = $_POST['pass'];
    $pass = filter_var($pass, FILTER_UNSAFE_RAW);

    $select_user = $conn->prepare("SELECT * FROM `admin` WHERE email = ? AND password = ?");
    $select_user->execute([$email, $pass]);
    $row = $select_user->fetch(PDO::FETCH_ASSOC);

    if($select_user->rowCount() > 0){
        $_SESSION['admin_id'] = $row['id'];
        header('location:admin_dashboard.php');
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
    <title>Admin Sign In</title>

    <link rel="stylesheet" href="admin.css">
</head>
<body>
<?php
  include 'header.php'
  ?>

  <form name="myForm" action="" method="POST">
    <div class="login-box">

      <h1>Admin Sign In </h1>

      <div class="textbox">

        <input type="email" placeholder="Email" name="email" value="" required>

      </div>
      <div class="textbox">
        <input type="password" placeholder="Password" name="pass" value="" required>
      </div>

      <input class="btn" type="submit" name="submit" value="Sign in">
      <p><a href="signin.php">Are you a user?</a></p>
    </div>
  </form>


  <script src="script.js"></script>
</body>
</html>