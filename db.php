<?php
$host = 'localhost';
$user = 'root';
$password = '391S=O9/mJm+';
$database = 'webshopp';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>