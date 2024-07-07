<?php

include 'connection.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
};


?>
<!DOCTYPE html>
<html>
  <head>
    <title>Feedback Page</title>
    <style>
      .container-feedback {
        max-width: 600px;
        margin: 0 auto;
        background-color: #fff;
        border-radius: 5px;
        padding: 40px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      }

      h1 {
        text-align: center;
        margin-top: 0;
        color: #333;
        font-size: 28px;
        margin-bottom: 30px;
      }

      .form-group {
        margin-bottom: 30px;
      }

      label {
        display: block;
        font-weight: bold;
        color: #555;
        margin-bottom: 10px;
      }

      input[type="text"],
      textarea {
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        background-color: #f5f5f5;
        color: #333;
      }

      textarea {
        resize: vertical;
        min-height: 100px;
      }

      .btn {
        display: inline-block;
        background-color: #0093e9;;
        color: #fff;
        text-decoration: none;
        padding: 12px 20px;
        border-radius: 5px;
        transition: background-color 0.3s;
        font-size: 16px;
        cursor: pointer;
      }

      .btn:hover {
        background-color: teal;
      }
    </style>
  </head>
  <body>
    <div>
    <?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>
    <?php
  include_once 'header.php'
  ?>
    </div>
    <div class="container-feedback">
      <h1>Feedback Form</h1>
      <form id="feedbackForm">
        <div class="form-group">
          <label for="name">Name:</label>
          <input type="text" id="name" name="name" required />
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="text" id="email" name="email" required />
        </div>
        <div class="form-group">
          <label for="message">Message:</label>
          <textarea id="message" name="message" rows="5" required></textarea>
        </div>
        <div class="form-group">
          <input type="submit" class="btn" value="Submit" />
        </div>
      </form>
    </div>
    <?php
  include_once 'footer.php'
  ?>
    <script>
      document
        .getElementById("feedbackForm")
        .addEventListener("submit", function (event) {
          event.preventDefault();
          // Perform form submission or AJAX request here

          // Clear form fields after submission
          document.getElementById("feedbackForm").reset();
        });
    </script>
  </body>
</html>
