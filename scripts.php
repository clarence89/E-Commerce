<?php
session_start();
ob_start();
include "database.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (isset($_POST['logout'])) {
  session_destroy();
  header('Location: /E-Commerce/');
}
if (isset($_POST['addcart'])) {
  $id = $conn->real_escape_string($_POST['id']);
  $userid = $_SESSION['id'];
  $quantity = $conn->real_escape_string($_POST['quantity']);
  $url = $conn->real_escape_string($_POST['urlb']);
  $stmt = $conn->prepare("INSERT INTO `carts`(user_id,product_id, quantity) VALUES (?, ?, ?)");
  $stmt->bind_param("iii", $userid, $id, $quantity);
  if (!$stmt->execute()) {
    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
  }
  header('Location:' . $url);
}
if (isset($_POST['category'])) {
  header('Location: /E-Commerce/category/' . $_POST['category']);
}
// Insert Products
if (isset($_POST['insertprod'])) {
  $prodname = $conn->real_escape_string($_POST['prodname']);
  $proddesc = $conn->real_escape_string($_POST['proddesc']);
  $prodimage = $conn->real_escape_string($_POST['prodimage']);
  $prodcateg = $conn->real_escape_string($_POST['prodcateg']);
  $prodquantity = $conn->real_escape_string($_POST['prodquantity']);
  $prodprice = $conn->real_escape_string($_POST['prodprice']);
  $isfeatured = $conn->real_escape_string($_POST['isfeatured']);
  $stmt = $conn->prepare("INSERT INTO `products`(prodname, proddesc, prodimage, prodcateg, prodquantity, prodprice, isfeatured) VALUES (?,?,?,?,?,?,?)");
  $stmt->bind_param("ssssiis", "", "", "", "", "", "", "");
  if (!$stmt->execute()) {
    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
  }
}
// Update Products
if (isset($_POST['updateprod'])) {
}
// Delete Products
if (isset($_POST['deleteprod'])) {
}
// Select User
if (isset($_POST['selectuser'])) {
  $username = $conn->real_escape_string($_POST['username']);
  $password = md5($conn->real_escape_string($_POST['password']));
  $url = $conn->real_escape_string($_POST['url']);
  $query = "SELECT * FROM `users` WHERE `username` = ? AND `pass` = ?";
  $stmt =   $conn->prepare($query);
  $stmt->bind_param("ss", $username, $password);
  if (!$stmt->execute()) {
    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
  }
  $result = $stmt->get_result();
  $user = $result->fetch_object();
  $_SESSION['id'] = $user->id;
  $_SESSION['name'] = $user->fName . " " . $user->mName . " " . $user->lName;
  header('Location:' . $url);
}
// Insert Users
if (isset($_POST['insertuser'])) {
  $username = $conn->real_escape_string($_POST['username']);
  $password =  md5($conn->real_escape_string($_POST['password']));
  $image = null;
  $fName = $conn->real_escape_string($_POST['fName']);
  $mName = $conn->real_escape_string($_POST['mName']);
  $lName = $conn->real_escape_string($_POST['lName']);
  $address = $conn->real_escape_string($_POST['address']);
  $url = $conn->real_escape_string($_POST['urla']);
  $query = "INSERT INTO `users`(username, pass, img, fName, mName, lName, addr) VALUES (?,?,?,?,?,?,?)";
  $stmt =   $conn->prepare($query);
  $stmt->bind_param("sssssss", $username, $password, $image, $fName, $mName, $lName, $address);
  if (!$stmt->execute()) {
    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
  }
  $_SESSION['id'] = $conn->real_escape_string($_POST['username']);;
  $_SESSION['name'] =  $conn->real_escape_string($_POST['fName']) . " " .  $conn->real_escape_string($_POST['mName']) . " " . $conn->real_escape_string($_POST['lName']);
  header('Location:' . $url);
}
// Update Users
if (isset($_POST['updateuser'])) {
}
// Delete Users
if (isset($_POST['deleteuser'])) {
}
