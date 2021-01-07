<?php
$host = 'localhost';
$user = 'root';
$pass = 112395;
$db = 'ecommercephp';
try {
    $conn = new mysqli($host, $user, $pass, $db);
    if ($conn->connect_errno > 0) {
        die('Connection Error: ' . $conn->connect_error);
    }
} catch (Exception $exception) {
    die('Connection Error: ' . $conn->connect_error);
}
