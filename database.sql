CREATE DATABASE birth_certificates;

USE birth_certificates;

CREATE TABLE `users` (
    `id` int(100) AUTO_INCREMENT PRIMARY KEY,
    `username` varchar(20) NOT NULL,
    `email` varchar(50) NOT NULL,
    `phone` varchar(50) NOT NULL,
    `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `u_certificates` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `full_name` VARCHAR(255) NOT NULL,
    `date_of_birth` DATE NOT NULL,
    `time_of_birth` TIME NOT NULL,
    `gender` VARCHAR(255) NOT NULL,
    `pp_image` VARCHAR(255) NOT NULL,
    `document_image` VARCHAR(255) NOT NULL,
    `father_name` VARCHAR(255) NOT NULL,
    `citizenship_image` VARCHAR(255) NOT NULL,
    `mother_name` VARCHAR(255) NOT NULL,
    `grandfather_name` VARCHAR(255) NOT NULL,
    `p_city` VARCHAR(255) NOT NULL,
    `p_ward` VARCHAR(255) NOT NULL,
    `p_district` VARCHAR(255) NOT NULL,
    `p_municipality` VARCHAR(255) NOT NULL,
    `p_province` VARCHAR(255) NOT NULL,
    `t_city` VARCHAR(255) NOT NULL,
    `t_ward` VARCHAR(255) NOT NULL,
    `t_district` VARCHAR(255) NOT NULL,
    `t_municipality` VARCHAR(255) NOT NULL,
    `t_province` VARCHAR(255) NOT NULL,
    `user_id` INT(11) NOT NULL,
    `citizenship_no` VARCHAR(255) NOT NULL
);

CREATE TABLE admin (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

INSERT INTO admin (name, email, password)
VALUES ('admin1', 'admin1@example.com', 'password1'),
        ('admin1', 'admin2@example.com', 'password2'),
        ('admin1', 'admin3@example.com', 'password3');


CREATE TABLE `a_certificates` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `full_name` VARCHAR(255) NOT NULL,
    `date_of_birth` DATE NOT NULL,
    `time_of_birth` TIME NOT NULL,
    `gender` VARCHAR(255) NOT NULL,
    `pp_image` VARCHAR(255) NOT NULL,
    `document_image` VARCHAR(255) NOT NULL,
    `father_name` VARCHAR(255) NOT NULL,
    `citizenship_image` VARCHAR(255) NOT NULL,
    `mother_name` VARCHAR(255) NOT NULL,
    `grandfather_name` VARCHAR(255) NOT NULL,
    `p_city` VARCHAR(255) NOT NULL,
    `p_ward` VARCHAR(255) NOT NULL,
    `p_district` VARCHAR(255) NOT NULL,
    `p_municipality` VARCHAR(255) NOT NULL,
    `p_province` VARCHAR(255) NOT NULL,
    `t_city` VARCHAR(255) NOT NULL,
    `t_ward` VARCHAR(255) NOT NULL,
    `t_district` VARCHAR(255) NOT NULL,
    `t_municipality` VARCHAR(255) NOT NULL,
    `t_province` VARCHAR(255) NOT NULL,
    `user_id` INT(11) NOT NULL,
    `citizenship_no` VARCHAR(255) NOT NULL
);

CREATE TABLE feedback (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  username VARCHAR(50) NOT NULL,
  email VARCHAR(100) NOT NULL,
  phone_number VARCHAR(20) NOT NULL,
  message TEXT NOT NULL,
  sub_date DATE
);