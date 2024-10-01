<?php
session_start();

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] != true || !isset($_SESSION['uname']) || !isset($_SESSION['role']) || $_SESSION['role'] != "user") {
    header("Location: ../logout.php");
}
