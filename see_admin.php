<?php

$db_name = 'mysql:host=localhost;dbname=birth_certificates';
$user_name = 'root';
$user_password = '';

$conn = new PDO($db_name, $user_name, $user_password);

?>
<!DOCTYPE html>
<html>
<head>
    <style>
        .container-see {
            width: 400px;
            margin: 100px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .delete-btn {
            background-color: #ff0000;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .delete-btn:hover {
            background-color: #cc0000;
        }
    </style>
</head>
<body>
    <div class="conatiner">
    <?php
include 'admin_header.php';
?>


<!-- Rest of your HTML content -->

    </div>
    <div class="container-see">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Database connection details
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "birth_certificates";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Check if delete button is clicked
                if (isset($_POST['delete'])) {
                    $id = $_POST['id'];
                    $deleteSql = "DELETE FROM admin WHERE id = $id";
                    if ($conn->query($deleteSql) === TRUE) {
                        echo "Record deleted successfully.";
                    } else {
                        echo "Error deleting record: " . $conn->error;
                    }
                }

                // SQL query to retrieve username and email from the database
                $sql = "SELECT id, name, email FROM admin";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>
                                <form method='post'>
                                    <input type='hidden' name='id' value='" . $row["id"] . "'>
                                    <button type='submit' class='delete-btn' name='delete'>Delete</button>
                                </form>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No results found.</td></tr>";
                }

                // Close the database connection
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
