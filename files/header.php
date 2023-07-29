<?php
session_start();
require_once "dashboard/model/cartClass.php";
require_once "dashboard/model/productClass.php";
require_once "dashboard/model/userClass.php";
$cart = new Cart;
$product = new product;
$user_id = 0;

if (isset($_SESSION['user'])) {
    $user_email = $_SESSION['user'];
    $user = new user;
    $user = $user->getUser($user_email);
    $user_id = $user['id'];
    $user_name = $user['f_name'];
    $log = "out";
} else {
    // checks if cookie already exists
    if (isset($_COOKIE['userid']))
        $user_id = $_COOKIE['userid'];
    else { // create a new cookie
        $user_id = rand(100000, 1000000);
        setcookie("userid", $user_id, time() + 60 * 60 * 24 * 30, '/');
    }
    $user_name = "<i class='fa-solid fa-arrow-right-to-bracket'></i>";
    $log = "in";
}
$items = $cart->getCartItems($user_id);


?>

<header class="header_area">
    <div class="classy-nav-container breakpoint-off d-flex align-items-center justify-content-between">
        <!-- Classy Menu -->
        <nav class="classy-navbar" id="essenceNav">
            <!-- Logo -->
            <a class="nav-brand" href="index.php"><img src="img/core-img/logo.png" alt=""></a>
            <!-- Navbar Toggler -->
            <div class="classy-navbar-toggler">
                <span class="navbarToggler"><span></span><span></span><span></span></span>
            </div>
            <!-- Menu -->
            <div class="classy-menu">
                <!-- close btn -->
                <div class="classycloseIcon">
                    <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                </div>
                <!-- Nav Start -->
                <div class="classynav">
                    <ul>
                        <li><a href="#">Shop</a>
                            <div class="megamenu">
                                <ul class="single-mega cn-col-4">
                                    <li class="title">Women's Collection</li>
                                    <li><a href="search.php?categories%5B%5D=5&categories%5B%5D=3">Dresses</a></li>
                                    <li><a href="search.php?categories%5B%5D=5">Blouses &amp; Shirts</a></li>
                                    <li><a href="search.php?categories%5B%5D=5">T-shirts</a></li>
                                    <li><a href="search.php?categories%5B%5D=5">Rompers</a></li>
                                    <li><a href="search.php?categories%5B%5D=5">Bras &amp; Panties</a></li>
                                </ul>
                                <ul class="single-mega cn-col-4">
                                    <li class="title">Men's Collection</li>
                                    <li><a href="search.php?categories%5B%5D=6">T-Shirts</a></li>
                                    <li><a href="search.php?categories%5B%5D=6">Polo</a></li>
                                    <li><a href="search.php?categories%5B%5D=6">Shirts</a></li>
                                    <li><a href="search.php?categories%5B%5D=6">Jackets</a></li>
                                    <li><a href="search.php?categories%5B%5D=6">Trench</a></li>
                                </ul>
                                <ul class="single-mega cn-col-4">
                                    <li class="title">Kid's Collection</li>
                                    <li><a href="search.php?categories%5B%5D=7">Dresses</a></li>
                                    <li><a href="search.php?categories%5B%5D=7">Shirts</a></li>
                                    <li><a href="search.php?categories%5B%5D=7">T-shirts</a></li>
                                    <li><a href="search.php?categories%5B%5D=7">Jackets</a></li>
                                    <li><a href="search.php?categories%5B%5D=7">Trench</a></li>
                                </ul>
                                <div class="single-mega cn-col-4">
                                    <img src="img/bg-img/bg-6.jpg" alt="">
                                </div>
                            </div>
                        </li>
                        <li><a href="#">Pages</a>
                            <ul class="dropdown">
                                <li><a href="index.php">Home</a></li>
                                <li><a href="shop.php">Shop</a></li>
                                <li><a href="productDetails.php">Product Details</a></li>
                                <li><a href="checkout.php">Checkout</a></li>
                                <li><a href="blog.php">Blog</a></li>
                                <li><a href="single-blog.php">Single Blog</a></li>
                                <li><a href="regular-page.php">Regular Page</a></li>
                                <li><a href="contact.php">Contact</a></li>
                            </ul>
                        </li>
                        <li><a href="blog.php">Blog</a></li>
                        <li><a href="contact.php">Contact</a></li>
                    </ul>
                </div>
                <!-- Nav End -->
            </div>
        </nav>

        <!-- Header Meta Data -->
        <div class="header-meta d-flex clearfix justify-content-end">
            <!-- Search Area -->
            <div class="search-area">
                <form action="search.php" method="post">
                    <input type="search" name="search" id="headerSearch" placeholder="Type for search">
                    <button type="submit" name="searchBtn"><i class="fa fa-search" aria-hidden="true"></i></button>
                </form>
            </div>
            <!-- Favourite Area -->
            <div class="favourite-area">
                <a href="favorite.php" title="Favourites"><i class="fa-solid fa-heart"></i></a>
            </div>
            <!-- User Login Info -->
            <div class="user-login-info">
                <a <?= ($log == 'in') ? "href='Login.php'" : "onclick='alert_confirm()'"; ?> title="Log<?= $log ?>"><?= $user_name ?></a>

            </div>
            <!-- Cart Area -->
            <div class="cart-area">
                <a href="#" title="Cart" id="essenceCartBtn"><i class="fa-solid fa-cart-shopping"></i> <span>
                        <?= count($items) ?></span></a>
            </div>
        </div>

    </div>
</header>