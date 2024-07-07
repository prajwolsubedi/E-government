<?php

include 'connection.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
};

if(isset($_POST['submit'])){
    if(isset($_SESSION['user_id'])){
    $select_users = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
    $select_users->execute([$user_id]);

    $fetch_users = $select_users->fetch(PDO::FETCH_ASSOC);

    $username = $fetch_users['username'];
    $email = $fetch_users["email"];
    $ph = $fetch_users["phone"];
    $currentDate = date('Y-m-d');
    $msg = $_POST['message'];
    $msg = filter_var($msg, FILTER_UNSAFE_RAW);

    $insert_feedback = $conn->prepare("INSERT INTO `feedback`(user_id, username, email, phone_number, message, sub_date) VALUES (?,?,?,?,?,?)");
    $insert_feedback->execute([$user_id, $username, $email, $ph, $msg, $currentDate]);
    $message[] = 'Feedback Submitted Successfully!';
    }
    else{
        $message[] = 'Please Sign In First!';
    }
};
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contact</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f2f2f2;
}

.container {
    max-width: 600px;
    margin: 40px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
    color: #333;
    text-align: center;
}

.container p {
    color: #666;
    text-align: center;
    margin-bottom: 20px;
}

form {
    text-align: center;
}

label {
    display: block;
    font-weight: bold;
    margin-bottom: 10px;
}

textarea {
    width: 100%;
    resize: vertical;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    margin-bottom: 10px;
}

input[type="submit"] {
    background-color: #0093e9;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    font-size: 1.1rem;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: white;
    color: #0093e9;
    border: 1px solid black;
}

    </style>
</head>
<body>
    <?php
        include 'header.php';
    ?>
    <div class="container">
        <h2>Contact Us</h2>
        <p>We value your feedback and concerns. Please feel free to send us a message.</p>

        <form action="" method="POST">
            <label for="message">Message:</label>
            <textarea id="message" name="message" rows="5" required></textarea>

            <input type="submit" name="submit" value="Send Message">
        </form>
    </div>

    <?php
        include 'footer.php';
    ?>

    <script src="script.js"></script>
</body>
</html>
