<?php

session_start();

include "./config.php";

if (isset($_POST['username']) && isset($_POST['pass'])) {
    $uname = $_POST['username'];
    $pass = $_POST['pass'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE EMAIL='$uname'");

    if (mysqli_num_rows($result) == 1) {

        $user = mysqli_fetch_assoc($result);

        if (password_verify($pass, $user['PASS'])) {

            $_SESSION['loggedIn'] = true;
            $_SESSION['uname'] = $user['EMAIL'];
            $_SESSION['id'] = $user['ID'];
            $_SESSION['name'] = $user['NAME'];
            $_SESSION['role'] = $user['ROLE'];

            header("Location: user/index.php");
        }
    } else {
        echo "Incorrect username or password";
    }
} else {
    echo "Incorrect username or password";
}
