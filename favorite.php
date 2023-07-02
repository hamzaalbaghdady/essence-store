<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>Essence Favorites</title>

    <!-- Favicon  -->
    <link rel="icon" href="img/core-img/favicon.ico">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="css/core-style.css">
    <link rel="stylesheet" href="css/style.css">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .fa-heart {
            color: red;
        }
    </style>
</head>

<body>
    <!-- ##### Header Area Start ##### -->
    <?php include "files/header.php" ?>
    <!-- ##### Header Area End ##### -->

    <!-- ##### Right Side Cart Area ##### -->
    <?php include "files/cart.php" ?>
    <!-- ##### Right Side Cart End ##### -->

    <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb_area bg-img" style="background-image: url(img/bg-img/breadcumb.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2>Favorites</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->

    <!-- ##### Shop Grid Area Start ##### -->
    <section class="shop_grid_area section-padding-80">
        <div class="container">

            <div class="">
                <div class="shop_grid_product_area">
                    <div class="row">
                        <div class="col-12">
                            <div class="product-topbar d-flex align-items-center justify-content-between">
                                <!-- Total Products -->
                                <div class="total-products">
                                    <p><span>186</span> products found</p>
                                </div>
                                <!-- Sorting -->
                                <div class="product-sorting d-flex">
                                    <p>Sort by:</p>
                                    <form action="#" method="get">
                                        <select name="select" id="sortByselect">
                                            <option value="value">Highest Rated</option>
                                            <option value="value">Newest</option>
                                            <option value="value">Price: $$ - $</option>
                                            <option value="value">Price: $ - $$</option>
                                        </select>
                                        <input type="submit" class="d-none" value="">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <?php
                        for ($i = 0; $i < 10; $i++) {
                            echo "<!-- Single Product -->
                                <div class='col-12 col-sm-6 col-lg-4'>
                                    <div class='single-product-wrapper'>
                                        <!-- Product Image -->
                                        <div class='product-img'>
                                            <img src='img/product-img/product-1.jpg' alt=''>
        
                                            <!-- Product Badge -->
                                            <div class='product-badge offer-badge'>
                                                <span>-30%</span>
                                            </div>
                                            <!-- Favourite -->
                                            <div class='product-favourite'>
                                                <a href='#' class='favme fa fa-heart active'></a>
                                            </div>
                                        </div>
        
                                        <!-- Product Description -->
                                        <div class='product-description'>
                                            <span>topshop</span>
                                            <a href='single-product-details.php'>
                                                <h6>Knot Front Mini Dress</h6>
                                            </a>
                                            <p class='product-price'><span class='old-price'>$75.00</span> $55.00</p>
        
                                            <!-- Hover Content -->
                                            <div class='hover-content'>
                                                <!-- Add to Cart -->
                                                <div class='add-to-cart-btn'>
                                                    <a href='#' class='btn essence-btn'>Add to Cart</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>";
                        }
                        ?>

                        <!-- Single Product -->
                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="single-product-wrapper">
                                <!-- Product Image -->
                                <div class="product-img">
                                    <img src="img/product-img/product-1.jpg" alt="">
                                    <!-- Hover Thumb -->
                                    <img class="hover-img" src="img/product-img/product-2.jpg" alt="">

                                    <!-- Product Badge -->
                                    <div class="product-badge offer-badge">
                                        <span>-30%</span>
                                    </div>
                                    <!-- Favourite -->
                                    <div class="product-favourite">
                                        <a href="#" class="favme fa fa-heart"></a>
                                    </div>
                                </div>

                                <!-- Product Description -->
                                <div class="product-description">
                                    <span>topshop</span>
                                    <a href="single-product-details.php">
                                        <h6>Knot Front Mini Dress</h6>
                                    </a>
                                    <p class="product-price"><span class="old-price">$75.00</span> $55.00</p>

                                    <!-- Hover Content -->
                                    <div class="hover-content">
                                        <!-- Add to Cart -->
                                        <div class="add-to-cart-btn">
                                            <a href="#" class="btn essence-btn">Add to Cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Single Product -->
                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="single-product-wrapper">
                                <!-- Product Image -->
                                <div class="product-img">
                                    <img src="img/product-img/product-2.jpg" alt="">
                                    <!-- Hover Thumb -->
                                    <img class="hover-img" src="img/product-img/product-3.jpg" alt="">

                                    <!-- Favourite -->
                                    <div class="product-favourite">
                                        <a href="#" class="favme fa fa-heart"></a>
                                    </div>
                                </div>

                                <!-- Product Description -->
                                <div class="product-description">
                                    <span>topshop</span>
                                    <a href="single-product-details.php">
                                        <h6>Knot Front Mini Dress</h6>
                                    </a>
                                    <p class="product-price">$80.00</p>

                                    <!-- Hover Content -->
                                    <div class="hover-content">
                                        <!-- Add to Cart -->
                                        <div class="add-to-cart-btn">
                                            <a href="#" class="btn essence-btn">Add to Cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Single Product -->
                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="single-product-wrapper">
                                <!-- Product Image -->
                                <div class="product-img">
                                    <img src="img/product-img/product-3.jpg" alt="">
                                    <!-- Hover Thumb -->
                                    <img class="hover-img" src="img/product-img/product-4.jpg" alt="">

                                    <!-- Product Badge -->
                                    <div class="product-badge new-badge">
                                        <span>New</span>
                                    </div>

                                    <!-- Favourite -->
                                    <div class="product-favourite">
                                        <a href="#" class="favme fa fa-heart"></a>
                                    </div>
                                </div>

                                <!-- Product Description -->
                                <div class="product-description">
                                    <span>topshop</span>
                                    <a href="single-product-details.php">
                                        <h6>Knot Front Mini Dress</h6>
                                    </a>
                                    <p class="product-price">$80.00</p>

                                    <!-- Hover Content -->
                                    <div class="hover-content">
                                        <!-- Add to Cart -->
                                        <div class="add-to-cart-btn">
                                            <a href="#" class="btn essence-btn">Add to Cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Single Product -->
                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="single-product-wrapper">
                                <!-- Product Image -->
                                <div class="product-img">
                                    <img src="img/product-img/product-4.jpg" alt="">
                                    <!-- Hover Thumb -->
                                    <img class="hover-img" src="img/product-img/product-5.jpg" alt="">

                                    <!-- Favourite -->
                                    <div class="product-favourite">
                                        <a href="#" class="favme fa fa-heart"></a>
                                    </div>
                                </div>

                                <!-- Product Description -->
                                <div class="product-description">
                                    <span>topshop</span>
                                    <a href="single-product-details.php">
                                        <h6>Knot Front Mini Dress</h6>
                                    </a>
                                    <p class="product-price">$80.00</p>

                                    <!-- Hover Content -->
                                    <div class="hover-content">
                                        <!-- Add to Cart -->
                                        <div class="add-to-cart-btn">
                                            <a href="#" class="btn essence-btn">Add to Cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Single Product -->
                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="single-product-wrapper">
                                <!-- Product Image -->
                                <div class="product-img">
                                    <img src="img/product-img/product-5.jpg" alt="">
                                    <!-- Hover Thumb -->
                                    <img class="hover-img" src="img/product-img/product-6.jpg" alt="">

                                    <!-- Product Badge -->
                                    <div class="product-badge offer-badge">
                                        <span>-30%</span>
                                    </div>

                                    <!-- Favourite -->
                                    <div class="product-favourite">
                                        <a href="#" class="favme fa fa-heart"></a>
                                    </div>
                                </div>

                                <!-- Product Description -->
                                <div class="product-description">
                                    <span>topshop</span>
                                    <a href="single-product-details.php">
                                        <h6>Knot Front Mini Dress</h6>
                                    </a>
                                    <p class="product-price"><span class="old-price">$75.00</span> $55.00</p>

                                    <!-- Hover Content -->
                                    <div class="hover-content">
                                        <!-- Add to Cart -->
                                        <div class="add-to-cart-btn">
                                            <a href="#" class="btn essence-btn">Add to Cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Single Product -->
                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="single-product-wrapper">
                                <!-- Product Image -->
                                <div class="product-img">
                                    <img src="img/product-img/product-6.jpg" alt="">
                                    <!-- Hover Thumb -->
                                    <img class="hover-img" src="img/product-img/product-7.jpg" alt="">

                                    <!-- Favourite -->
                                    <div class="product-favourite">
                                        <a href="#" class="favme fa fa-heart"></a>
                                    </div>
                                </div>

                                <!-- Product Description -->
                                <div class="product-description">
                                    <span>topshop</span>
                                    <a href="single-product-details.php">
                                        <h6>Knot Front Mini Dress</h6>
                                    </a>
                                    <p class="product-price">$80.00</p>

                                    <!-- Hover Content -->
                                    <div class="hover-content">
                                        <!-- Add to Cart -->
                                        <div class="add-to-cart-btn">
                                            <a href="#" class="btn essence-btn">Add to Cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Single Product -->
                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="single-product-wrapper">
                                <!-- Product Image -->
                                <div class="product-img">
                                    <img src="img/product-img/product-7.jpg" alt="">
                                    <!-- Hover Thumb -->
                                    <img class="hover-img" src="img/product-img/product-8.jpg" alt="">

                                    <!-- Product Badge -->
                                    <div class="product-badge new-badge">
                                        <span>New</span>
                                    </div>

                                    <!-- Favourite -->
                                    <div class="product-favourite">
                                        <a href="#" class="favme fa fa-heart"></a>
                                    </div>
                                </div>

                                <!-- Product Description -->
                                <div class="product-description">
                                    <span>topshop</span>
                                    <a href="single-product-details.php">
                                        <h6>Knot Front Mini Dress</h6>
                                    </a>
                                    <p class="product-price">$80.00</p>

                                    <!-- Hover Content -->
                                    <div class="hover-content">
                                        <!-- Add to Cart -->
                                        <div class="add-to-cart-btn">
                                            <a href="#" class="btn essence-btn">Add to Cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Single Product -->
                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="single-product-wrapper">
                                <!-- Product Image -->
                                <div class="product-img">
                                    <img src="img/product-img/product-8.jpg" alt="">
                                    <!-- Hover Thumb -->
                                    <img class="hover-img" src="img/product-img/product-9.jpg" alt="">

                                    <!-- Favourite -->
                                    <div class="product-favourite">
                                        <a href="#" class="favme fa fa-heart"></a>
                                    </div>
                                </div>

                                <!-- Product Description -->
                                <div class="product-description">
                                    <span>topshop</span>
                                    <a href="single-product-details.php">
                                        <h6>Knot Front Mini Dress</h6>
                                    </a>
                                    <p class="product-price">$80.00</p>

                                    <!-- Hover Content -->
                                    <div class="hover-content">
                                        <!-- Add to Cart -->
                                        <div class="add-to-cart-btn">
                                            <a href="#" class="btn essence-btn">Add to Cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Single Product -->
                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="single-product-wrapper">
                                <!-- Product Image -->
                                <div class="product-img">
                                    <img src="img/product-img/product-9.jpg" alt="">
                                    <!-- Hover Thumb -->
                                    <img class="hover-img" src="img/product-img/product-1.jpg" alt="">

                                    <!-- Favourite -->
                                    <div class="product-favourite">
                                        <a href="#" class="favme fa fa-heart"></a>
                                    </div>
                                </div>

                                <!-- Product Description -->
                                <div class="product-description">
                                    <span>topshop</span>
                                    <a href="single-product-details.php">
                                        <h6>Knot Front Mini Dress</h6>
                                    </a>
                                    <p class="product-price">$80.00</p>

                                    <!-- Hover Content -->
                                    <div class="hover-content">
                                        <!-- Add to Cart -->
                                        <div class="add-to-cart-btn">
                                            <a href="#" class="btn essence-btn">Add to Cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Pagination -->
                <nav aria-label="navigation">
                    <ul class="pagination mt-50 mb-70 justify-content-center">
                        <li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-left"></i></a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">...</a></li>
                        <li class="page-item"><a class="page-link" href="#">21</a></li>
                        <li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-right"></i></a>
                        </li>
                    </ul>
                </nav>
            </div>
    </section>
    <!-- ##### Shop Grid Area End ##### -->

    <!-- ##### Footer Area Start ##### -->
    <?php include "files/footer.php" ?>
    <!-- ##### Footer Area End ##### -->

    <!-- jQuery (Necessary for All JavaScript Plugins) -->
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="js/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Plugins js -->
    <script src="js/plugins.js"></script>
    <!-- Classy Nav js -->
    <script src="js/classy-nav.min.js"></script>
    <!-- Active js -->
    <script src="js/active.js"></script>

</body>

</html>