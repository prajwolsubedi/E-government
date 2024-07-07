<?php
    
include 'connection.php';

session_start();

if(isset($_SESSION['admin_id'])){
    $admin_id = $_SESSION['admin_id'];
}else{
    $admin_id = '';
    header('location:admin_signin.php');
};

$select_certificates = $conn->prepare("SELECT * FROM `a_certificates` ORDER BY id DESC");
$select_certificates->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approved Certficates</title>

    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <?php
        include 'admin_header.php';
    ?>

    <ul class="data-list">
    <?php
    if($select_certificates->rowCount() > 0){?>

        <h1 class="c1_title">Approved Certificates</h2>

        <?php
        foreach ($select_certificates as $row) {
            $image = $row['pp_image'];
            $full_name = $row['full_name'];
            $dob = $row['date_of_birth'];
        ?>
        
            <li class="data-item">
                <img src="uploaded_img/<?= $image; ?>" alt="Profile Image">
                <div class="data-details">
                    <h3><?php echo $full_name; ?></h3>
                    <p>Date of Birth: <?php echo $dob; ?></p>
                </div>
                <a style="color=black" href="admin_a_view_certificate.php?cid=<?= $row['id']; ?>">View Certificate</a>
            </li>

        <?php
        }
    }
    else{?>
        <h1 class="c1_title" >There are no Approved Certificates!</h1>
    <?php
    }
    ?>
</ul>

<script src="script.js"></script>
</body>
</html>