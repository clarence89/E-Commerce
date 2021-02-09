<?php
$host = 'localhost';
$user = 'imamlzix_clarence';
$pass = '89Justletitgo';
$db = 'ecommercephp';
try {
    $conn = new mysqli($host, $user, $pass, $db);
    if ($conn->connect_errno > 0) {
        die('Connection Error: ' . $conn->connect_error);
    }
} catch (Exception $exception) {
    die('Connection Error: ' . $conn->connect_error);
}
