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
// Insert Users
if ($_POST['insertuser']) {
}
// Update Users
if ($_POST['updateuser']) {
}
// Delete Users
if ($_POST['deleteuser']) {
}
