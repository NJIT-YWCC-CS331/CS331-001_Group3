<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$conn = new mysqli("localhost", "root", "", "Bookstore");
$conn->set_charset("utf8mb4");
?>
