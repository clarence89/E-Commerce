<?php
include "database.php";

if ($_POST['category']) {
    header('Location: /E-Commerce/category/'.$_POST['category']);
  }
  // Insert Products
if ($_POST['insertprod']) {
    $prodname = $conn->real_escape_string($_POST['prodname']);
    $proddesc = $conn->real_escape_string($_POST['proddesc']);
    $prodimage = $conn->real_escape_string($_POST['prodimage']);
    $prodcateg = $conn->real_escape_string($_POST['prodcateg']);
    $prodquantity = $conn->real_escape_string($_POST['prodquantity']);
    $prodprice = $conn->real_escape_string($_POST['prodprice']);
    $isfeatured = $conn->real_escape_string($_POST['isfeatured']);
    $stmt = $conn->prepare("INSERT INTO `products`(prodname, proddesc, prodimage, prodcateg, prodquantity, prodprice, isfeatured) VALUES (?,?,?,?,?,?,?)");
    $stmt->bind_param("ssssiis", "", "", "", "", "", "", "");
    $stmt->execute();
}
// Update Products
if ($_POST['updateprod']) {
}
// Delete Products
if ($_POST['deleteprod']) {
}
// Select User
if ($_POST['selectuser']) {
  $username = $conn->real_escape_string($_POST['username']);
  $password = $conn->real_escape_string($_POST['password']);
  $query = "SELECT * FROM `users` WHERE `username` = ? AND `password` = ?";
  $stmt =   $conn->prepare($query);
  $stmt->bind_param("ss", $username, md5($password));
  $stmt->execute();
  $result = $stmt->get_result();
  $user = $result->fetch_object();
}
// Insert Users
if ($_POST['insertuser']) {
  $username = $conn->real_escape_string($_POST['username']);
  $password = $conn->real_escape_string($_POST['password']);
  $image = $conn->real_escape_string($_POST['image']);
  $fName = $conn->real_escape_string($_POST['fName']);
  $mName = $conn->real_escape_string($_POST['mName']);
  $lName = $conn->real_escape_string($_POST['lName']);
  $address = $conn->real_escape_string($_POST['address']);
  $query = "INSERT INTO `products`(username, password, image, fName, mName, lName, address) VALUES (?,?,?,?,?,?,?)";
  $stmt =   $conn->prepare($query);
  $stmt->bind_param("sssssss", $username, md5($password),$image,$fName, $mName,$lName,$address);
  $stmt->execute();
}
// Update Users
if ($_POST['updateuser']) {
}
// Delete Users
if ($_POST['deleteuser']) {
}
