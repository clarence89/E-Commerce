<?php
$host = 'localhost';
$user = 'root';
$pass = 112395;
$db = 'ecommercephp';
try {
$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn){
  die('Connection Error: ' . $conn->mysqli_connect_error());
}
}
catch (Exception $exception){
die('Connection Error: ' . $conn->mysqli_connect_error());
}
