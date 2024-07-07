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
    <link rel="stylesheet" href="style.css">
    
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

</head>
<body>
  <?php
  include_once 'admin_header.php'
  ?>
  
  <main>
    <section id="mission">
      <div class="container">
        <h2 class="section-title">Our Mission</h2>
        <p class="section-text">Our mission is to establish a comprehensive birth registration system that safeguards the rights of every child and citizen. We aim to facilitate the timely and accurate registration of births, ensuring the availability of vital records for legal, administrative, and statistical purposes.</p>
      </div>
    </section>

    <section id="importance">
      <div class="container">
        <h2 class="section-title">Why Birth Registration Matters?</h2>
        <div class="image-container">
          <img src="image/family.jpg" alt="Happy Family" class="section-image">
        </div>
        <p class="section-text">Birth registration is a fundamental human right and a crucial step in recognizing and protecting an individual's legal identity. It provides a legal framework for individuals to access essential services, including education, healthcare, social security, and inheritance rights. Moreover, birth registration plays a vital role in ensuring the overall development and well-being of individuals and societies.</p>
      </div>
    </section>

    <section id="services">
      <div class="container">
        <h2 class="section-title">Our Services</h2>
        <ul class="service-list">
          <li>Birth Registration</li>
          <li>Legal Documentation</li>
          <li>Data Protection</li>
        </ul>
      </div>
    </section>

    <section id="commitment">
      <div class="container">
        <h2 class="section-title">Our Commitment</h2>
        <ul class="commitment-list">
          <li>Accessibility</li>
          <li>Accuracy</li>
          <li>Customer Support</li>
        </ul>
        <div class="image-container">
          <img src="image/security.webp" alt="Digital Security" class="security-image">
        </div>
      </div>
    </section>
  </main>
  
<script src="script.js"></script>

<?php
include 'footer.php';
?>
</body>
</html>