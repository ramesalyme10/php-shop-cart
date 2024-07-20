<?php
session_start();
include('db.php');


$sql = 'SELECT * FROM products';
$result = mysqli_query($conn, $sql);
$rows_count = mysqli_num_rows($result);


?>

<!-- <!DOCTYPE html> -->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce php && ajax project</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/shop.css">
    <link rel="stylesheet" href="css/single.css">
    <link rel="stylesheet" href="css/about.css">
    <link rel="stylesheet" href="css/service.css">
    <link rel="stylesheet" href="css/carts.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <!-- Add the slick-theme.css if you want default styling -->


</head>

<body>

   
    <div class=" header-items-dropDown">
        <ul class="dropdown-items" id="drop">
            <li><a href="/shop-cart/">Home</a></li>
            <li><a href="about.php">about</a></li>
            <li><a href="services.php">services</a></li>
            <li><a href="post.php">createPosts</a></li>
            <li><a href="shop.php">shop</a></li>
        

        </ul>
        </li>
        </ul>
    </div>
    <header class="navbar-items shadow-lg">
        <div class="container">
            <div class="header-flex">
                <div class="logo">
                    <a href="/shop-cart/"><img src="./images/logo.png" alt="logo"></a>
                </div>
                <div class="header-navbar-items mt-3">
                    <ul class="header-items-flex">
                        <li><a  class="color" href="/shop-cart/">Home</a></li>
                        <li><a href="about.php">about</a></li>
                        <li><a href="services.php">services</a></li>
                        <li><a href="post.php">createPosts</a></li>
                        <li><a href="shop.php">shop</a></li>
                        
                    </ul>
                </div>
                <div class="header-right">
                    <div class="header-shopping-count">
                        <a href="carts.php"><i class="fa-solid fa-cart-shopping"></i></a>
                        <span><?php echo $rows_count; ?></span>
                    </div>
                    <div class="header-right-bars">
                        <i id="bars_btn" class="fas fa-bars"></i>
                        <i id="times_btn" class="fas fa-times times"></i>
                    </div>
                </div>
            </div>
        </div>
    </header>