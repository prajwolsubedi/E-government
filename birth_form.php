<?php

include 'connection.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
    header('location:signin.php');
};

if(isset($_POST['submit'])){

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

    $photo1_name = $_FILES['photo1']['name'];
    $photo1_tmp_name = $_FILES['photo1']['tmp_name'];
    $photo1_type = $_FILES['photo1']['type'];
    $photo1_error = $_FILES['photo1']['error'];
    $photo1_size = $_FILES['photo1']['size'];
    $photo1_folder = 'uploaded_img/'.$photo1_name;

    $photo2_name = $_FILES['photo2']['name'];
    $photo2_tmp_name = $_FILES['photo2']['tmp_name'];
    $photo2_type = $_FILES['photo2']['type'];
    $photo2_error = $_FILES['photo2']['error'];
    $photo2_size = $_FILES['photo2']['size'];
    $photo2_folder = 'uploaded_img/'.$photo2_name;

    $photo3_name = $_FILES['photo3']['name'];
    $photo3_tmp_name = $_FILES['photo3']['tmp_name'];
    $photo3_type = $_FILES['photo3']['type'];
    $photo3_error = $_FILES['photo3']['error'];
    $photo3_size = $_FILES['photo3']['size'];
    $photo3_folder = 'uploaded_img/'.$photo3_name;

    $select_certificates = $conn->prepare("SELECT * FROM `u_certificates` WHERE user_id = ?");
    $select_certificates->execute([$user_id]);

    if($select_certificates->rowCount() < 6){
        $insert_certificates = $conn->prepare("INSERT INTO `u_certificates`(full_name, date_of_birth, time_of_birth, gender, pp_image, document_image, father_name, citizenship_image, mother_name, grandfather_name, p_city, p_ward, p_district, p_municipality, p_province, t_city, t_ward, t_district, t_municipality, t_province, user_id, citizenship_no) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $insert_certificates->execute([$full_name, $dob, $tob, $gender, $photo1_name, $photo2_name, $father_name, $photo3_name, $mother_name, $grandfather_name, $p_city, $p_ward, $p_district, $p_municipality, $p_province, $t_city, $t_ward, $t_district, $t_municipality, $t_province, $user_id, $citizenship_no]);
        if($insert_certificates){
            if($photo1_size > 2000000 OR $photo2_size > 2000000 OR $photo3_size > 2000000){
                $message[] = 'Image size is too large!';
            }else{
                move_uploaded_file($photo1_tmp_name, $photo1_folder);
                move_uploaded_file($photo2_tmp_name, $photo2_folder);
                move_uploaded_file($photo3_tmp_name, $photo3_folder);
                $message[] = 'Registration Successfull! Please wait for approval to view the Birth Certificate.';
            }
        }
    else{
        $message[] = 'You already have 10 registrations!';
    }  
    }

};
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Birth Registration Form</title>

    <link rel="stylesheet" href="birth_form.css">
</head>
<body>

    <?php
    include 'header.php';
    ?>

    <section>
    <h1>Birth Registration Form</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <table>
            <tr>
                <th colspan="2">Personal Information</th>
            </tr>
            <tr>
                <td>Full Name</td>
                <td><input type="text" name="full_name" required></td>
            </tr>
            <tr>
                <td>Date of Birth</td>
                <td><input type="date" name="dob" required></td>
            </tr>
            <tr>
                <td>Time of Birth</td>
                <td><input type="time" name="tob" required></td>
            </tr>
            <tr>
                <td>Gender</td>
                <td>
                    <select name="gender">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Passport-sized Photo</td>
                <td>
                    <input type="file" id="photo1" name="photo1" accept="image/jpg, image/jpeg, image/png, image/webp" onchange="loadPhoto(event, 'preview1')" required>
                    <img id="preview1" src="#" alt="Passport-sized photo preview">
                </td>
            </tr>
            <tr>
                <td>Hospital-document Photo</td>
                <td>
                    <input type="file" id="photo2" name="photo2" accept="image/jpg, image/jpeg, image/png, image/webp" onchange="loadPhoto(event, 'preview2')" required>
                    <img id="preview2" src="#" alt="Document photo preview">
                </td>
            </tr>
        </table>
    
        <table>
            <tr>
                <th colspan="2">Parent Information</th>
            </tr>
            <tr>
                <td>Father's Name</td>
                <td><input type="text" name="father_name" required></td>
            </tr>
            <tr>
                <td>Father's Citizenship Number</td>
                <td><input type="text" name="citizenship_no" required></td>
            </tr>
            <tr>
                <td>Father's Citizenship Photo</td>
                <td>
                    <input type="file" id="photo3" name="photo3" accept="image/jpg, image/jpeg, image/png, image/webp" onchange="loadPhoto(event, 'preview3')" required>
                    <img id="preview3" src="#" alt="Citizenship photo preview">
                </td>
            </tr>
            <tr>
                <td>Mother's Name</td>
                <td><input type="text" name="mother_name" required></td>
            </tr>
            <tr>
                <td>Grandfather's Name</td>
                <td><input type="text" name="grandfather_name" required></td>
            </tr>
        </table>
    
        <table>
            <tr>
                <th colspan="2">Permanent Address Information</th>
            </tr>
            <tr>
                <td>City/Village</td>
                <td><input type="text" name="p_city" required></td>
            </tr>
            <tr>
                <td>Ward Number</td>
                <td><input type="number" name="p_ward" required></td>
            </tr>
            <tr>
                <td>District</td>
                <td><input type="text" name="p_district" required></td>
            </tr>
            <tr>
                <td>Municipality</td>
                <td><input type="text" name="p_municipality" required></td>
            </tr>
            <tr>
                <td>Province</td>
                <td>
                    <select name="p_province" required>
                        <option value="Province1">Province-1</option>
                        <option value="Province2">Province-2</option>
                        <option value="Province3">Province-3</option>
                        <option value="Province4">Province-4</option>
                        <option value="Province5">Province-5</option>
                        <option value="Province6">Province-6</option>
                        <option value="Province7">Province-7</option>
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
                <td><input type="text" name="t_city" required></td>
            </tr>
            <tr>
                <td>Ward Number</td>
                <td><input type="number" name="t_ward" required></td>
            </tr>
            <tr>
                <td>District</td>
                <td><input type="text" name="t_district" required></td>
            </tr>
            <tr>
                <td>Municipality</td>
                <td><input type="text" name="t_municipality" required></td>
            </tr>
            <tr>
                <td>Province</td>
                <td>
                    <select name="t_province" required>
                        <option value="Province1">Province-1</option>
                        <option value="Province2">Province-2</option>
                        <option value="Province3">Province-3</option>
                        <option value="Province4">Province-4</option>
                        <option value="Province5">Province-5</option>
                        <option value="Province6">Province-6</option>
                        <option value="Province7">Province-7</option>
                    </select>
                </td>
            </tr>
        </table>

        <input type="submit" value="Register" name="submit">
    </form>
    </section>

    <script src="script.js"></script>
    <script>
        // function previewImage(event) {
        //   var reader = new FileReader();
        //   reader.onload = function() {
        //     var preview = document.getElementById('preview-image');
        //     preview.src = reader.result;
        //     preview.style.display = 'block';
        //   };
        //   reader.readAsDataURL(event.target.files[0]);
        // }

        function loadPhoto(event, previewId) {
        var preview = document.getElementById(previewId);
        preview.src = URL.createObjectURL(event.target.files[0]);
        
        // var icon = document.getElementById(iconId);
        // icon.style.display = 'none';
        
        preview.style.display = 'block';
        }
    </script>
</body>
</html>
