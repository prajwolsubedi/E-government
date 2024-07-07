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

$delete_certificates = $conn->prepare("DELETE FROM `u_certificates` WHERE id = ?");
$delete_certificates->execute([$cid]);

header('Location: admin_dashboard.php')
?>