<?php

header('Content-Type: text/html; charset=utf-8');

$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password, "mysql");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$conn->set_charset("utf-8");
$conn->query("SET CHARACTER SET utf8");
$conn->query("SET CHARSET utf8");
$conn->query("SET COLLATION_CONNECTION = 'utf8_unicode_ci'");

session_start();
?>