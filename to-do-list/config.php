<?php

$conn = mysqli_connect("localhost", "root", "", "to-do-list");

if (!$conn) {
    die("Connection failed!");
}
