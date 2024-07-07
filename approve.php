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

$select_certificates = $conn->prepare("SELECT * FROM `u_certificates` WHERE id = ?");
$select_certificates->execute([$cid]);

$fetch_certificates = $select_certificates->fetch(PDO::FETCH_ASSOC);

$tob = $fetch_certificates['time_of_birth'];
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
$user_id = $fetch_certificates["user_id"];

$insert_certificates = $conn->prepare("INSERT INTO `a_certificates`(full_name, date_of_birth, time_of_birth, gender, pp_image, document_image, father_name, citizenship_image, mother_name, grandfather_name, p_city, p_ward, p_district, p_municipality, p_province, t_city, t_ward, t_district, t_municipality, t_province, user_id, citizenship_no) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
$insert_certificates->execute([$full_name, $dob, $tob, $gender, $pp_image, $doc_image, $father_name, $c_image, $mother_name, $grandfather_name, $p_city, $p_ward, $p_district, $p_municipality, $p_province, $t_city, $t_ward, $t_district, $t_municipality, $t_province, $user_id, $c_no]);

$delete_certificates = $conn->prepare("DELETE FROM `u_certificates` WHERE id = ?");
$delete_certificates->execute([$cid]);

header('Location: see_u_certificates.php');
?>