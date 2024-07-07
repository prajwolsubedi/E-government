<?php
    if(isset($message)){
        foreach($message as $message){
            echo '
            <div class="message">
                <span>'.$message.'</span>
                <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
            </div>
            ';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="admin.css">
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>
<div class="nav">
    <div class="headLogo">
        <a href="#"><img class="loogo" src="logo.png" alt="headLogo"></a>
    </div>
        
    <h1 id="admin_title">Admin Panel</h1>

    <ul class="nav-links">
        <li><a href="admin_dashboard.php" >Home</a></li>
        <li><a href="admin_about.php" >About Us</a></li>
        <li><a href="#" id="myButton">Profile</a></li>
    </ul>

</div>

<div id="profile">
         <?php          
            $select_profile = $conn->prepare("SELECT * FROM `admin` WHERE id = ?");
            $select_profile->execute([$admin_id]);
            if($select_profile->rowCount() > 0){
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p><?= $fetch_profile["name"]; ?></p>
         <a href="signout.php" class="delete-btn" onclick="return confirm('Logout from the website?');">Logout</a> 
         <?php
            }else{
         ?>
         <p id="para2">Please Login or Register first!</p>
         <div class="flex-btn">
            <a href="signup.php" class="option-btn">Register</a>
            <a href="signin.php" class="option-btn">Login</a>
         </div>
         <?php
            }
         ?>      
         
      </div>
</body>
</html>
