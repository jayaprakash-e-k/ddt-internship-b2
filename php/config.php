<?php

$dbHost = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "ums";

$conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

if (!$conn) {
    die("Connection failed!");
}
