<?php session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/album/">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;1,100;1,300;1,400;1,700&family=Montserrat:ital,wght@0,300;1,300&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@1,700&family=Montserrat:ital,wght@0,300;1,300&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    @media (min-width: 576px) {}


    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }


    @media (min-width: 992px) {}


    @media (min-width: 1200px) {}

    .card-title>h3 {
        color: rgb(176, 46, 37);

    }

    @media (min-width: 1400px) {
        .card-title>h3 {
            color: rgb(176, 46, 37);
            font-size: 20px;
            text-align: center;
        }

        .card-text {
            font-size: 16px
        }
    }
</style>

<link type="text/css" href="/E-Commerce/carousel.css" rel="stylesheet">

<body>
    <nav class="navbar navbar-expand-lg navbar-dark" style="font-family: Lato; font-weight:600; background-color: rgb(176, 46, 37);">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">PrinceK</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/E-Commerce">Home</a>
                    </li>
                    <li  class="ml-5 nav-item">    <form action="/E-Commerce/scripts.php" method="post" class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" name="category" aria-label="Search">
                    <button style="display: none;" class="btn btn-outline-success" type="submit">Search</button>
                </form></li>
                </ul>

                <?php
                 include "database.php";
                if (isset($_SESSION['name'] )&& isset($_SESSION['id'])) {
                    $userid= $_SESSION['id'];
                    $sql = "SELECT * FROM carts WHERE `user_id` = $userid";
                    $result=   $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $cart =$result->num_rows;
                    }else{
                        $cart = 0;
                    }



                    echo '
                    <div class="nav-item dropdown">
                    <a style="color:wheat" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        '. $_SESSION['name'].'
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">

                    <li><a class="dropdown-item " href="#"> <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    Cart <span class="badge bg-secondary">'.$cart.'</span></a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li> <form action="/E-Commerce/scripts.php" method="post" class="d-flex">
                        <input <a class="dropdown-item "  name="logout" type="submit" value="Logout" />
                    </form></li>

                    </ul>
                </div>

        </div>
                    ';
                } else {
                    echo '
                    <div class="nav-item">
                <a style="color: wheat;" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal" href="#">Login</a>
                    </div>
                    <div class="nav-item">
                <a style="color: wheat;" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal1" href="#">Register</a>
                    </div>
                    ';
                }
                ?>

            </div>

    </nav>


    <!-- Modal Login-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/E-Commerce/scripts.php" method="POST">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Username</label>
                            <input required name="username" type="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input required name="password" type="password" class="form-control" id="exampleInputPassword1">
                        </div>
                        <div style="display: none;"  class="mb-3">
                            <input name="url" type="text" class="form-control" id="url">
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" name="selectuser" class="btn btn-primary">Login</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Register -->
    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModal1Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModal1Label">Register</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/E-Commerce/scripts.php" method="POST">
                        <div class="mb-3">
                            <label for="exampleInputEmail11" class="form-label">Username</label>
                            <input required name="username" type="text" class="form-control" id="exampleInputEmail11" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input required name="password" type="password" class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="mb-3">
                            <label for="fName" class="form-label">First Name</label>
                            <input required name="fName" type="text" class="form-control" id="fName">
                        </div>
                        <div class="mb-3">
                            <label for="mName" class="form-label">Middle Name</label>
                            <input required name="mName" type="text" class="form-control" id="mName">
                        </div>
                        <div class="mb-3">
                            <label for="lName" class="form-label">Last Name</label>
                            <input required name="lName" type="text" class="form-control" id="lName">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input required name="address" type="text" class="form-control" id="address">
                        </div>
                        <div style="display: none;" class="mb-3">
                            <input name="urla" type="text" class="form-control" id="urla">
                        </div>
                </div>
                <div class="modal-footer">
                    <button name="insertuser" type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                </form>
            </div>
        </div>
    </div>
