<?php
require_once "config.php";

if (isset($_POST['submit'])) {
    $name = trim($_POST['name']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($name) || empty($username) || empty($email) || empty($password)) {
        die("Please fill in all required fields.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    if ($password !== $confirm_password ) {

        die("Passwords do not match!")
    }

    $sql = "SELECT id FROM users WHERE username = :username OR email = :email";

    $check = $conn -> prepare($sql);

    $check ->execute([
        ':username => username,
        :email => email'
    ]);


    if($check ->fetch ){
         die('Username or Email alredy exists!')
    }

    $hashedPassword = password_hash(
        $password,
        PASSWORD DEFAULT
    )


    $sql = "INSERT INTO users (name, username, email, password, confirm_password, is_admin) VALUES (:name, :username, :email, :password, :confirm_password, 0"

    $insert = $conn prepare($sql);

    $insert = $conn execute(

        ':name' = $name,
        ':username' = $username,
        ':email' = $email,
        ':password' = $hashedPassword,
        ':confirm_password' = '',
    )

    header("location: login.php")


} else {

    header("location: index.php")
}