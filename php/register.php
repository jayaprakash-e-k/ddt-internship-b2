<?php

include "./config.php";

if (isset($_POST['name']) && isset($_POST['username']) && isset($_POST['pass']) && isset($_POST['cpass'])) {

    $name = $_POST['name'];
    $username = $_POST['username'];
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];

    if ($pass != $cpass) {
        header("Location: ./");
        exit();
    }

    $pass = password_hash($pass, PASSWORD_BCRYPT);

    $result = mysqli_query($conn, "SELECT * FROM users WHERE EMAIL='$username'");

    if (mysqli_num_rows($result) > 0) {
        echo "User already exist";
    } else {
        $result = mysqli_query($conn, "INSERT INTO users (NAME, EMAIL, PASS) VALUES ('$name', '$username', '$pass');");

        if ($result) {
            echo "Registered successfully";
        } else {
            echo "Something went wrong.";
        }
    }
} else {
    header("Location: ./");
    exit();
}
