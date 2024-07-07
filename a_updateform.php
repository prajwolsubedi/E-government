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

$fetch_certificates = $select_certificates->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['update'])){

    $full_name = $_POST['full_name'];
    $full_name = filter_var($full_name, FILTER_UNSAFE_RAW);
    $dob = $_POST['dob'];
    $dob = filter_var($dob, FILTER_UNSAFE_RAW);
    $tob = $_POST['tob'];
    $tob = filter_var($tob, FILTER_UNSAFE_RAW);
    $gender = $_POST['gender'];
    $gender = filter_var($gender, FILTER_UNSAFE_RAW);
    $father_name = $_POST['father_name'];
    $father_name = filter_var($father_name, FILTER_UNSAFE_RAW);
    $mother_name = $_POST['mother_name'];
    $mother_name = filter_var($mother_name, FILTER_UNSAFE_RAW);
    $grandfather_name = $_POST['grandfather_name'];
    $grandfather_name = filter_var($grandfather_name, FILTER_UNSAFE_RAW);
    $p_city = $_POST['p_city'];
    $p_city = filter_var($p_city, FILTER_UNSAFE_RAW);
    $p_ward = $_POST['p_ward'];
    $p_ward = filter_var($p_ward, FILTER_UNSAFE_RAW);
    $p_district = $_POST['p_district'];
    $p_district = filter_var($p_district, FILTER_UNSAFE_RAW);
    $p_municipality = $_POST['p_municipality'];
    $p_municipality = filter_var($p_municipality, FILTER_UNSAFE_RAW);
    $p_province = $_POST['p_province'];
    $p_province = filter_var($p_province, FILTER_UNSAFE_RAW);
    $t_city = $_POST['t_city'];
    $t_city = filter_var($t_city, FILTER_UNSAFE_RAW);
    $t_ward = $_POST['t_ward'];
    $t_ward = filter_var($t_ward, FILTER_UNSAFE_RAW);
    $t_district = $_POST['t_district'];
    $t_district = filter_var($t_district, FILTER_UNSAFE_RAW);
    $t_municipality = $_POST['t_municipality'];
    $t_municipality = filter_var($t_municipality, FILTER_UNSAFE_RAW);
    $t_province = $_POST['t_province'];
    $t_province = filter_var($t_province, FILTER_UNSAFE_RAW);
    $citizenship_no = $_POST['citizenship_no'];
    $citizenship_no = filter_var($citizenship_no, FILTER_UNSAFE_RAW);
    $user_id = $_POST['user_id'];
 
    $update_product = $conn->prepare("UPDATE `a_certificates` SET full_name = ?, date_of_birth = ?, time_of_birth = ?, gender = ?, father_name = ?, mother_name = ?, grandfather_name = ?, p_city = ?, p_ward = ?, p_district = ?, p_municipality = ?, p_province = ?, t_city = ?, t_ward = ?, t_district = ?, t_municipality = ?, t_province = ?, user_id = ?, citizenship_no = ? WHERE id = ?");
    $update_product->execute([$full_name, $dob, $tob, $gender, $father_name, $mother_name, $grandfather_name, $p_city, $p_ward, $p_district, $p_municipality, $p_province, $t_city, $t_ward, $t_district, $t_municipality, $t_province, $user_id, $citizenship_no, $cid]);
 
 
    $old_image_01 = $_POST['old_image_01'];
    $photo1 = $_FILES['photo1']['name'];
   //$photo1 = filter_var($photo1, FILTER_SANITIZE_STRING);
   $photo1_size = $_FILES['photo1']['size'];
   $photo1_tmp_name = $_FILES['photo1']['tmp_name'];
   $photo1_folder = 'uploaded_img/'.$photo1;

   if(!empty($photo1)){
      if($photo1_size > 2000000){
         $message[] = 'Image size is too large!';
      }else{
         $update_image_01 = $conn->prepare("UPDATE `a_certificates` SET pp_image = ? WHERE id = ?");
         $update_image_01->execute([$photo1, $cid]);
         move_uploaded_file($photo1_tmp_name, $photo1_folder);
         unlink('uploaded_img/'.$old_image_01);
         //$message[] = 'image 01 updated successfully!';
      }
   }

   $old_image_02 = $_POST['old_image_02'];
   $photo2 = $_FILES['photo2']['name'];
  //$photo1 = filter_var($photo1, FILTER_SANITIZE_STRING);
  $photo2_size = $_FILES['photo2']['size'];
  $photo2_tmp_name = $_FILES['photo2']['tmp_name'];
  $photo2_folder = 'uploaded_img/'.$photo2;

  if(!empty($photo2)){
     if($photo2_size > 2000000){
        $message[] = 'Image size is too large!';
     }else{
        $update_image_02 = $conn->prepare("UPDATE `a_certificates` SET document_image = ? WHERE id = ?");
        $update_image_02->execute([$photo2, $cid]);
        move_uploaded_file($photo2_tmp_name, $photo2_folder);
        unlink('uploaded_img/'.$old_image_02);
        //$message[] = 'image 01 updated successfully!';
     }
  }

  $old_image_03 = $_POST['old_image_03'];
  $photo3 = $_FILES['photo3']['name'];
 //$photo1 = filter_var($photo1, FILTER_SANITIZE_STRING);
 $photo3_size = $_FILES['photo3']['size'];
 $photo3_tmp_name = $_FILES['photo3']['tmp_name'];
 $photo3_folder = 'uploaded_img/'.$photo3;

 if(!empty($photo3)){
    if($photo3_size > 2000000){
       $message[] = 'Image size is too large!';
    }else{
       $update_image_03 = $conn->prepare("UPDATE `a_certificates` SET citizeship_image = ? WHERE id = ?");
       $update_image_03->execute([$photo3, $cid]);
       move_uploaded_file($photo3_tmp_name, $photo3_folder);
       unlink('uploaded_img/'.$old_image_03);
       //$message[] = 'image 01 updated successfully!';
    }
 }

     $message[] = 'Updated successfully!';
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Form</title>
    <style>
        #old1, #old2, #old3{
            max-width: 200px;
            display: block;
            margin-top: 10px;
        }
    </style>

    <link rel="stylesheet" href="birth_form.css">
</head>
<body>

    <?php
    include 'admin_header.php';
    ?>

    <section>
    <h1>Update Form</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="user_id" value="<?= $fetch_certificates['user_id']; ?>">
        <input type="hidden" name="old_image_01" value="<?= $fetch_certificates['pp_image']; ?>">
        <input type="hidden" name="old_image_02" value="<?= $fetch_certificates['document_image']; ?>">
        <input type="hidden" name="old_image_03" value="<?= $fetch_certificates['citizenship_image']; ?>">
        <table>
            <tr>
                <th colspan="2">Personal Information</th>
            </tr>
            <tr>
                <td>Full Name</td>
                <td><input type="text" name="full_name" required value="<?= $fetch_certificates['full_name']; ?>"></td>
            </tr>
            <tr>
                <td>Date of Birth</td>
                <td><input type="date" name="dob" required value="<?= $fetch_certificates['date_of_birth']; ?>"></></td>
            </tr>
            <tr>
                <td>Time of Birth</td>
                <td><input type="time" name="tob" required value="<?= $fetch_certificates['time_of_birth']; ?>"></td>
            </tr>
            <tr>
                <td>Gender</td>
                <td>
                    <select name="gender">
                        <option value="Male" <?php if ($fetch_certificates['gender'] === 'Male') echo 'selected'; ?>>Male</option>
                        <option value="Female" <?php if ($fetch_certificates['gender'] === 'Female') echo 'selected'; ?>>Female</option>
                        <option value="Other" <?php if ($fetch_certificates['gender'] === 'Other') echo 'selected'; ?>>Other</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Passport-sized Photo</td>
                <td>
                    <input type="file" id="photo1" name="photo1" accept="image/jpg, image/jpeg, image/png, image/webp" onchange="loadPhoto(event, 'preview1', 'old1')">
                    <img id="preview1" src="#" alt="Passport-sized photo preview">
                    <img src="uploaded_img/<?= $fetch_certificates['pp_image']; ?>" alt="" id="old1">
                </td>
            </tr>
            <tr>
                <td>Hospital-document Photo</td>
                <td>
                    <input type="file" id="photo2" name="photo2" accept="image/jpg, image/jpeg, image/png, image/webp" onchange="loadPhoto(event, 'preview2', 'old2')">
                    <img id="preview2" src="#" alt="Document photo preview">
                    <img src="uploaded_img/<?= $fetch_certificates['document_image']; ?>" alt="" id="old2">
                </td>
            </tr>
        </table>
    
        <table>
            <tr>
                <th colspan="2">Parent Information</th>
            </tr>
            <tr>
                <td>Father's Name</td>
                <td><input type="text" name="father_name" value="<?= $fetch_certificates['father_name']; ?>"></></td>
            </tr>
            <tr>
                <td>Father's Citizenship Number</td>
                <td><input type="text" name="citizenship_no" value="<?= $fetch_certificates['citizenship_no']; ?>"></></td>
            </tr>
            <tr>
                <td>Father's Citizenship Photo</td>
                <td>
                    <input type="file" id="photo3" name="photo3" accept="image/jpg, image/jpeg, image/png, image/webp" onchange="loadPhoto(event, 'preview3', 'old3')">
                    <img id="preview3" src="#" alt="Citizenship photo preview">
                    <img src="uploaded_img/<?= $fetch_certificates['citizenship_image']; ?>" alt="" id="old3">
                </td>
            </tr>
            <tr>
                <td>Mother's Name</td>
                <td><input type="text" name="mother_name" value="<?= $fetch_certificates['mother_name']; ?>"></></td>
            </tr>
            <tr>
                <td>Grandfather's Name</td>
                <td><input type="text" name="grandfather_name" value="<?= $fetch_certificates['grandfather_name']; ?>"></></td>
            </tr>
        </table>
    
        <table>
            <tr>
                <th colspan="2">Permanent Address Information</th>
            </tr>
            <tr>
                <td>City/Village</td>
                <td><input type="text" name="p_city" value="<?= $fetch_certificates['p_city']; ?>"></></td>
            </tr>
            <tr>
                <td>Ward Number</td>
                <td><input type="number" name="p_ward" value="<?= $fetch_certificates['p_ward']; ?>"></td>
            </tr>
            <tr>
                <td>District</td>
                <td><input type="text" name="p_district" value="<?= $fetch_certificates['p_district']; ?>"></td>
            </tr>
            <tr>
                <td>Municipality</td>
                <td><input type="text" name="p_municipality" value="<?= $fetch_certificates['p_municipality']; ?>"></td>
            </tr>
            <tr>
                <td>Province</td>
                <td>
                    <select name="p_province">
                        <option value="Province1" <?php if ($fetch_certificates['p_province'] === 'Province1') echo 'selected'; ?>>Province-1</option>
                        <option value="Province2" <?php if ($fetch_certificates['p_province'] === 'Province2') echo 'selected'; ?>>Province-2</option>
                        <option value="Province3" <?php if ($fetch_certificates['p_province'] === 'Province3') echo 'selected'; ?>>Province-3</option>
                        <option value="Province4" <?php if ($fetch_certificates['p_province'] === 'Province4') echo 'selected'; ?>>Province-4</option>
                        <option value="Province5" <?php if ($fetch_certificates['p_province'] === 'Province5') echo 'selected'; ?>>Province-5</option>
                        <option value="Province6" <?php if ($fetch_certificates['p_province'] === 'Province6') echo 'selected'; ?>>Province-6</option>
                        <option value="Province7" <?php if ($fetch_certificates['p_province'] === 'Province7') echo 'selected'; ?>>Province-7</option>
                    </select>
                </td>
            </tr>
        </table>

        <table>
            <tr>
                <th colspan="2">Temporary Address Information</th>
            </tr>
            <tr>
                <td>City/Village</td>
                <td><input type="text" name="t_city" value="<?= $fetch_certificates['t_city']; ?>"></td>
            </tr>
            <tr>
                <td>Ward Number</td>
                <td><input type="number" name="t_ward" value="<?= $fetch_certificates['t_ward']; ?>"></td>
            </tr>
            <tr>
                <td>District</td>
                <td><input type="text" name="t_district" value="<?= $fetch_certificates['t_district']; ?>"></td>
            </tr>
            <tr>
                <td>Municipality</td>
                <td><input type="text" name="t_municipality" value="<?= $fetch_certificates['t_municipality']; ?>"></td>
            </tr>
            <tr>
                <td>Province</td>
                <td>
                    <select name="t_province">
                        <option value="Province1" <?php if ($fetch_certificates['t_province'] === 'Province1') echo 'selected'; ?>>Province-1</option>
                        <option value="Province2" <?php if ($fetch_certificates['t_province'] === 'Province2') echo 'selected'; ?>>Province-2</option>
                        <option value="Province3" <?php if ($fetch_certificates['t_province'] === 'Province3') echo 'selected'; ?>>Province-3</option>
                        <option value="Province4" <?php if ($fetch_certificates['t_province'] === 'Province4') echo 'selected'; ?>>Province-4</option>
                        <option value="Province5" <?php if ($fetch_certificates['t_province'] === 'Province5') echo 'selected'; ?>>Province-5</option>
                        <option value="Province6" <?php if ($fetch_certificates['t_province'] === 'Province6') echo 'selected'; ?>>Province-6</option>
                        <option value="Province7" <?php if ($fetch_certificates['t_province'] === 'Province7') echo 'selected'; ?>>Province-7</option>
                    </select>
                </td>
            </tr>
        </table>

        <input type="submit" value="Update" name="update">
    </form>
    </section>

    <script src="script.js"></script>
    <script>
        function loadPhoto(event, previewId, oldId) {
        var preview = document.getElementById(previewId);
        preview.src = URL.createObjectURL(event.target.files[0]);
        
        preview.style.display = 'block';
        var old = document.getElementById(oldId);
        old.style.display = 'none';
        }
    </script>
</body>
</html>
