<?php
    
include 'connection.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
    header('location:signin.php');
};

$cid = $_GET['cid'];

$select_certificates = $conn->prepare("SELECT * FROM `a_certificates` WHERE id = ?");
$select_certificates->execute([$cid]);

$fetch_certificates = $select_certificates->fetch(PDO::FETCH_ASSOC);

$tob = date("h:i A", strtotime($fetch_certificates['time_of_birth']));

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Birth Certificates</title>
  <link rel="stylesheet" href="certificate.css">
</head>
<body>

<?php

include 'header.php';

?>


<div class="certificate">
            
  <div class="container" width="100%" height="100%">
    <div class="head">
      <img src="image/Coat-of-arms-of-Nepal-01.png">
      <p style="color:	#87CEEB";>Government of Nepal
        <br>Ministry of Health and Population<br>
      Kamaladi, Kathmandu</p>
      <img id="pp_image" src="uploaded_img/<?= $fetch_certificates['pp_image']; ?>" alt="">
      <!-- <img src="image/Flag_of_Nepal.png" alt=""> -->
    </div>

    <div class="header">
      <h1>Birth Certificate</h1>

    </div>

    <div class="content">
      <p>This is to certify that <span><?= $fetch_certificates['full_name'] ?></span> son/daughther of Mr. <span><?= $fetch_certificates['father_name'] ?></span> and Ms. <span><?= $fetch_certificates['mother_name'] ?></span> 
      grandson/daughter of</p>
         <p> Mr. <span><?= $fetch_certificates['grandfather_name'] ?></span> was born on date: <span><?= $fetch_certificates['date_of_birth'] ?></span> at <span><?= $tob?></span>. The permanent address of the child is <span><?= $fetch_certificates['p_city'] ?></span>, Ward No.-<span><?= $fetch_certificates['p_ward'] ?></span>,</p> 
         <p><span><?= $fetch_certificates['p_municipality'] ?></span> Municipality, <span><?= $fetch_certificates['p_district'] ?></span> District, <span><?= $fetch_certificates['p_province'] ?></span>. Father's citizenship number is <span><?= $fetch_certificates['citizenship_no'] ?></span>.
         This certificate is</p>
         <p>issued in accordance with Government of Nepal laws and regulations governing registration of births. It attests to the fact that the child described</p>
         <p>above was born to the parents mentioned. This certificate serves as an official record of the child's birth and is valid for all legal purposes.</p>
        
        
</div>

    <div class="bottom">
      <div class="district-head">
        <img src="image/Screenshot 2023-05-30 092127.png" alt="">
        <h4 style="font-size: 20px;">..........................</h4>
        <h5 style="font-size: 20px;">Head of the CDO</h5>
      </div>
      <div class="issued">
          <p>Issued by:<br>
            Central District Office<br>
            Kathmandu<BR>
              Date:2080-01-05
          </p>
      </div>
      <div class="gov-stamp">
        <img src="image/logo-b-1.png" alt="">
        <h4>Government Stamp</h4>
      </div>

    </div>


  </div>

</div>


<script src="script.js"></script>
</body>
</html>