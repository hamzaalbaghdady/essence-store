    <?php
    require_once "dashboard/model/productClass.php";
    require_once "dashboard/model/favoritesClass.php";
    $fav = new Favorites;
    if (isset($_GET['d'])) {
        $fav->delete($_GET['d']);
    }
    ?>
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



            .single-product-wrapper {
                width: 30%;
                margin: 30px auto;
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
                                        <p><span><?= count($fav->getAll($user_id)) ?></span> products found</p>
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

                            $favorites = $fav->getAll($user_id);
                            if (count($favorites) == 0)
                                echo "<h4 style='text-align: center; color:red;'>You haven't added any thing to your favourites!</h4>";
                            foreach ($favorites as $val) {
                                $array = $product->searchById($val['product_id']);
                                $cover_array = json_decode($array['images_src'], true);
                                $caver = ($cover_array['cover'] == null) ? $cover_array[0] : $cover_array['cover'];
                                $date = (calDateDiff($array['date_of_additon']) > 7) ? "" : "<div class='product-badge new-badge'><span>New</span></div>";
                                if ($array['discount'] == 0) {
                                    $discount = "";
                                    $price = $array['price'];
                                    $oldPrice = "";
                                } else {
                                    $discount = "<div class='product-badge offer-badge'><span>$array[discount]%</span></div>";
                                    $price = $array['price'] - ($array['price'] * $array['discount'] * 0.01);
                                    $oldPrice = $array['price'] . "$";
                                }

                                echo "
                                <!-- Single Product -->
                                <div class='single-product-wrapper'>
                                    <!-- Product Image -->
                                    <div class='product-img'>
                                        <img src='dashboard/view/$caver' alt='$array[name]'>
                                        <!-- Product Badge -->
                                        $date $discount
                                        <!-- Favourite -->
                                        <div class='product-favourite'>
                                            <a href='favorite.php?d=$val[id]' class='favme fa fa-heart active'></a>
                                        </div>
                                    </div>
                                    <!-- Product Description -->
                                    <div class='product-description'>
                                        <span>$array[brand]</span>
                                        <a href='productDetails.php?id=$array[id]'>
                                            <h6>$array[name]</h6>
                                        </a>
                                        <p class='product-price'><span class='old-price'>$oldPrice</span>$price$</p>
        
                                        <!-- Hover Content -->
                                        <div class='hover-content'>
                                            <!-- Add to Cart -->
                                            <div class='add-to-cart-btn'>
                                                <a href='productDetails.php?id=$array[id]' class='btn essence-btn'>Add to Cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>";
                            }
                            function calDateDiff($start)
                            {
                                $startDate = new DateTime($start);
                                $endDate = new DateTime(date('Y-m-d'));

                                $interval = $startDate->diff($endDate);
                                $days = $interval->days;

                                return $days;
                            }
                            ?>


                        </div>
                    </div>
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