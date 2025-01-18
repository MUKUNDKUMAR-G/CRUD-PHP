<?php
$conn = mysqli_connect("localhost", "root", "", "curd_app");

if (!$conn) {
    die("Connection Failed" . mysqli_connect_error);
}
