<?php

include 'connection.php';

session_start();

if(isset($_SESSION['admin_id'])){
    $admin_id = $_SESSION['admin_id'];
}else{
    $admin_id = '';
    header('location:admin_signin.php');
};

$fid = $_GET['fid'];

$delete_feedback = $conn->prepare("DELETE FROM `feedback` WHERE id = ?");
$delete_feedback->execute([$fid]);

header('Location: view_feedback.php')
?>