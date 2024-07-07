<?php
    
include 'connection.php';

session_start();

if(isset($_SESSION['admin_id'])){
    $admin_id = $_SESSION['admin_id'];
}else{
    $admin_id = '';
    header('location:admin_signin.php');
};

$select_feedback = $conn->prepare("SELECT * FROM `feedback` ORDER BY id DESC");
$select_feedback->execute();

?>

<!DOCTYPE html>
<html>
<head>
    <title>View Feedback</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f2f2f2;
}

.container {
    max-width: 800px;
    margin: 40px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.f_title {
    color: #333;
    text-align: center;
    margin-top: 20px;
}

.feedback-item {
    margin-bottom: 20px;
    padding: 20px;
    background-color: #f8f8f8;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.feedback-item h3 {
    margin: 0;
    font-size: 18px;
    color: #333;
}

.feedback-item p {
    margin-top: 10px;
    color: #666;
}

.feedback-item p strong {
    font-weight: bold;
}

.feedback-item p span {
    display: block;
    color: #888;
}

.delete-button{
    position: relative;
    left: 45%;
    border: 1px solid red;
    background-color: red;
    padding: .7rem;
    font-size: 1.3rem;
    color: white;
    border-radius: 5px;
}

.delete-button:hover {
    background-color: white;
    color: red;
}

    </style>
</head>
<body>
    <?php
        include 'admin_header.php';
    ?>
    <h1 class="f_title" >Feedback</h1>
    <div class="container">
        <?php

if ($select_feedback->rowCount() > 0) {
    while ($row = $select_feedback->fetch(PDO::FETCH_ASSOC)) {
        echo "<div class='feedback-item'>";
        echo "<h3>Username: " . $row["username"] . "</h3>";
        echo "<p><strong>Submission Date:</strong> " . $row["sub_date"] . "</p>";
        echo "<p><strong>User ID:</strong> " . $row["user_id"] . "</p>";
        echo "<p><strong>Email:</strong> " . $row["email"] . "</p>";
        echo "<p><strong>Phone Number:</strong> " . $row["phone_number"] . "</p>";
        echo "<p><strong>Message:</strong> " . $row["message"] . "</p>";
        echo "<a class='delete-button' href='delete_feedback.php?fid=" . $row["id"] . "'>Delete</a>";
        echo "</div>";
    }
} else {
    echo "<h1>No feedback found.</h1>";
}

?>

    </div>
</body>
</html>
