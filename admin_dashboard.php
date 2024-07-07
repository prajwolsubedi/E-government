<?php

include 'connection.php';
session_start();

if(isset($_SESSION['admin_id'])){
    $admin_id = $_SESSION['admin_id'];
}else{
    $admin_id = '';
};

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <?php
        include 'admin_header.php';
    ?>

    <h1 style="font-size: 4rem; text-align: center; text-decoration: underline; color: #0093e9;">Dashboard</h1>
    <section class="dashboard">
        <div class="box-container">
            <div class="box">
                <?php
                    $select_users = $conn->prepare("SELECT * FROM `users`");
                    $select_users->execute();
                    $number_of_users = $select_users->rowCount()
                ?>
                <h3><?= $number_of_users; ?></h3>
                <p>Users</p>
                <a href="see_users.php" class="btn">View List</a>
            </div>

            <div class="box">
                <?php
                    $select_u_certificates = $conn->prepare("SELECT * FROM `u_certificates`");
                    $select_u_certificates->execute();
                    $number_of_u_certificates = $select_u_certificates->rowCount()
                ?>
                <h3><?= $number_of_u_certificates; ?></h3>
                <p>Unapproved Certificates</p>
                <a href="see_u_certificates.php" class="btn">View List</a>
            </div>

            <div class="box">
                <?php
                    $select_a_certificates = $conn->prepare("SELECT * FROM `a_certificates`");
                    $select_a_certificates->execute();
                    $number_of_a_certificates = $select_a_certificates->rowCount()
                ?>
                <h3><?= $number_of_a_certificates; ?></h3>
                <p>Approved Certificates</p>
                <a href="see_a_certificates.php" class="btn">View List</a>
            </div>

            <div class="box">
                <?php
                    $select_admin = $conn->prepare("SELECT * FROM `admin`");
                    $select_admin->execute();
                    $number_of_admin = $select_admin->rowCount()
                ?>
                <h3><?= $number_of_admin; ?></h3>
                <p>Admin</p>
                <a href="see_admin.php" class="btn">View List</a>
            </div>

            <div class="box">
                <?php
                    $select_feedback = $conn->prepare("SELECT * FROM `feedback`");
                    $select_feedback->execute();
                    $number_of_feedback = $select_feedback->rowCount()
                ?>
                <h3><?= $number_of_feedback; ?></h3>
                <p>Feedback</p>
                <a href="view_feedback.php" class="btn">View List</a>
            </div>

        </div>
    </section>

    <script src="script.js"></script>
</body>
</html>