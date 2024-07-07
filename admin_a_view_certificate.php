<?php

include 'connection.php';

session_start();

if(isset($_SESSION['admin_id'])){
    $admin_id = $_SESSION['admin_id'];
}else{
    $admin_id = '';
    header('location:admin_signin.php');
};

$cid = $_GET['cid'];

$select_certificates = $conn->prepare("SELECT * FROM `a_certificates` WHERE id = ?");
$select_certificates->execute([$cid]);

if($select_certificates->rowCount() > 0){
$fetch_certificates = $select_certificates->fetch(PDO::FETCH_ASSOC);

$tob = date("h:i A", strtotime($fetch_certificates['time_of_birth']));
$full_name = $fetch_certificates["full_name"];
$dob = $fetch_certificates["date_of_birth"];
$pp_image = $fetch_certificates["pp_image"];
$doc_image = $fetch_certificates["document_image"];
$c_image = $fetch_certificates["citizenship_image"];
$gender = $fetch_certificates["gender"];
$father_name = $fetch_certificates["father_name"];
$c_no = $fetch_certificates["citizenship_no"];
$mother_name = $fetch_certificates["mother_name"];
$grandfather_name = $fetch_certificates["grandfather_name"];
$p_city = $fetch_certificates["p_city"];
$p_ward = $fetch_certificates["p_ward"];
$p_district = $fetch_certificates["p_district"];
$p_municipality = $fetch_certificates["p_municipality"];
$p_province = $fetch_certificates["p_province"];
$t_city = $fetch_certificates["t_city"];
$t_ward = $fetch_certificates["t_ward"];
$t_district = $fetch_certificates["t_district"];
$t_municipality = $fetch_certificates["t_municipality"];
$t_province = $fetch_certificates["t_province"];
}
else{
    header('Location: see_a_certificates.php');
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Birth Certificate</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12pt;
            margin: 0;
            padding: 0;
        }

        #title{
            font-size: 4rem;
            margin: 0;
        }
        .container {
            width: 800px;
            margin: 3rem auto;
            padding: 20px;
            background-color: #f5f5f5;
            border: 1px solid #ddd;
        }
        .container h1 {
            font-size: 40px;
            text-align: center;
            margin-top: 5rem;
            padding: 0;
        }
        h2 {
            font-size: 30px;
            margin: 20px 0 10px;
            padding: 0;
        }
        .info {
            margin: 10px 0;
            font-size: 20px;
        }

        /* label {
            display: inline-block;
            width: 120px;
            font-weight: bold;
        } */

        /* .container img {
            height: 200px;
            width: 200px;
            
        } */

        .image-container {
            cursor: pointer;
        }

        .image-container img {
            max-width: 200px;
            transition: transform 0.3s;
        }

        .image-container img:hover {
            transform: scale(1.1);
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .overlay img {
            max-width: 80%;
            max-height: 80%;
            object-fit: contain;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 24px;
            color: #fff;
            cursor: pointer;
        }

        .avc-button {
            height: 80px;
            /* background-color: gray; */
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin: 3rem 11rem;
        }

        .avc-button a {
            font-size: 2rem;
            border: 1px solid black;
            padding: 1rem 2rem;
            border-radius: .5rem;
            background-color: #f5f5f5;
            transition: transform .3s;
        }

        .avc-button a:hover {
            color: white;
            transform: scale(1.1);
        }

        .avc-button #l1:hover,
        .avc-button #l4:hover {
            background-color: #3CA8E8;
            border-color: #3CA8E8;
        }

        .avc-button #l2 {
            background-color: green;
            color: white;
            border: none;
            transform: none;
        }

        .avc-button #l3:hover {
            background-color: red;
            border-color: red;
        }
    </style>
</head>
<body>

    <?php
        include 'admin_header.php';
    ?>
    <div class="container">
        <h1 id="title">BIRTH CERTIFICATE</h1>

        <h1>Personal Information</h1>
        <h2>Full Name</h2>
        <p class="info"><?php echo $full_name; ?></p>
        <h2>Date of Birth</h2>
        <p class="info"><?php echo $dob; ?></p>
        <h2>Time of Birth</h2>
        <p class="info"><?php echo $tob; ?></p>
        <h2>Gender</h2>
        <p class="info"><?php echo $gender; ?></p>
        <h2>Passport-size Photo</h2>
        <div class="image-container">
            <img src="uploaded_img/<?= $pp_image; ?>" alt="Image 1">
        </div>
        <h2>Hospital Photo</h2>
        <div class="image-container">
            <img src="uploaded_img/<?= $doc_image; ?>" alt="Image 2">
        </div>
        
        <h1>Parent's Information</h1>
        <h2>Father's Name</h2>
        <p class="info"><?php echo $father_name; ?></p>
        <h2>Father's Citizenship Number</h2>
        <p class="info"><?php echo $c_no; ?></p>
        <h2>Father's Citizenship Photo</h2>
        <div class="image-container">
            <img src="uploaded_img/<?= $c_image; ?>" alt="Image 3">
        </div>
        <h2>Mother's Name</h2>
        <p class="info"><?php echo $mother_name; ?></p>
        <h2>Grandfather's Name</h2>
        <p class="info"><?php echo $grandfather_name; ?></p>

        <h1>Permanent Address Information</h1>
        <h2>City/Village</h2>
        <p class="info"><?php echo $p_city; ?></p>
        <h2>Ward Number</h2>
        <p class="info"><?php echo $p_ward; ?></p>
        <h2>District</h2>
        <p class="info"><?php echo $p_district; ?></p>
        <h2>Municipality</h2>
        <p class="info"><?php echo $p_municipality; ?></p>
        <h2>Province</h2>
        <p class="info"><?php echo $p_province; ?></p>

        <h1>Temporary Address Information</h1>
        <h2>City/Village</h2>
        <p class="info"><?php echo $t_city; ?></p>
        <h2>Ward Number</h2>
        <p class="info"><?php echo $t_ward; ?></p>
        <h2>District</h2>
        <p class="info"><?php echo $t_district; ?></p>
        <h2>Municipality</h2>
        <p class="info"><?php echo $t_municipality; ?></p>
        <h2>Province</h2>
        <p class="info"><?php echo $t_province; ?></p>
    </div>

    <div class="overlay">
        <span class="close-btn">&times;</span>
        <img src="" alt="Large Image">
    </div>

    <div class="avc-button">
        <a id="l1" href="a_updateform.php?cid=<?= $cid; ?>">Update &uarr;</a>
        <a id="l2" href="#">Approved &#10003;</a>
        <a id="l3" href="a_delete.php?cid=<?= $cid; ?>">Delete &#128465;</a>
        <a id="l4" href="see_a_certificates.php">Go Back &#8592;</a>
    </div>

    <script src="script.js"></script>
    <script>
        const imageContainers = document.querySelectorAll('.image-container');
        const overlay = document.querySelector('.overlay');
        const overlayImg = overlay.querySelector('img');
        const closeBtn = document.querySelector('.close-btn');

        imageContainers.forEach(function(container) {
        container.addEventListener('click', function() {
                const imgSrc = this.querySelector('img').getAttribute('src');
                overlayImg.src = imgSrc;
                overlay.style.display = 'flex';
            });
        });

        closeBtn.addEventListener('click', function() {
            overlay.style.display = 'none';
        });
    </script>
</body>
</html>
