<?php
include_once "dashboard/model/productClass.php";
include_once "dashboard/model/categoryClass.php";
include_once "dashboard/model/brandClass.php";
include_once "dashboard/model/favoritesClass.php";
$product = new product;

if (isset($_POST['searchBtn'])) {
    $name = $_POST['search'];
} else $name = "";

if (isset($_POST['sort'])) {
    $sort = $_POST['sort'];
} else $sort = "";

if (isset($_POST['min_price'])) {
    $price1 = $_POST['min_price'];
    echo "min price: " . $price1;
} else $price1 = "";

if (isset($_POST['max_price'])) {
    $price2 = $_POST['max_price'];
    echo " Max price: " . $price2;
} else $price2 = "";


if (isset($_GET['page'])) {
    $offset = $_GET['page'] * 9;
} else $offset = "";

if (isset($_GET['cid'])) {
    $category = $_GET['cid'];
} else $category = "";

if (isset($_GET['c'])) {
    $color = $_GET['c'];
} else $color = "";

if (isset($_GET['b'])) {
    $brand = $_GET['b'];
} else $brand = "";
$url = "";

$search_result = $product->Xsearch($name, $sort, $offset, $category, $price1, $price2, $color, $brand);

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
    <title>Essence Search</title>

    <!-- Favicon  -->
    <link rel="icon" href="img/core-img/favicon.ico">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="css/core-style.css">
    <link rel="stylesheet" href="css/style.css">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .single-product-wrapper {
            width: 30%;
            margin: 30px auto;
        }

        li a {
            color: black;
            font-weight: normal;
        }

        .badge {
            color: #fff;
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
                        <h2>Search Results</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->

    <!-- ##### Shop Grid Area Start ##### -->
    <section class="shop_grid_area section-padding-80">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="shop_sidebar_area">

                        <!-- ##### Single Widget ##### -->
                        <div class="widget catagory mb-50">
                            <!-- Widget Title -->
                            <h6 class="widget-title mb-30">Catagories</h6>

                            <!--  Catagories  -->
                            <div class="list-group">
                                <ul class="list-group">
                                    <li class='list-group-item d-flex justify-content-between align-items-center'>
                                        <a href='search.php'>All</a>
                                    </li>
                                    <?php
                                    $category = new Category;

                                    $categories = $category->search();
                                    foreach ($categories as $val) {
                                        $c_count = count($product->ProductsPerCategory($val['id']));
                                        echo "
                                        <li class='list-group-item d-flex justify-content-between align-items-center'>
                                        <a href='$_SERVER[PHP_SELF]?$url&cid=$val[id]'>$val[name]</a>
                                        <span class='badge bg-primary rounded-pill'>$c_count</span>
                                        </li>";
                                    }
                                    ?>

                                </ul>
                            </div>
                        </div>

                        <!-- ##### Single Widget ##### -->
                        <div class="widget price mb-50">
                            <!-- Widget Title -->
                            <h6 class="widget-title mb-30">Filter by</h6>
                            <!-- Widget Title 2 -->
                            <p class="widget-title2 mb-30">Price</p>

                            <div class="widget-desc">
                                <div class="slider-range">
                                    <div data-min="49" data-max="360" data-unit="$" class="slider-range-price ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" data-value-min="49" data-value-max="360" data-label-result="Range:">
                                        <div class="ui-slider-range ui-widget-header ui-corner-all"></div>
                                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                                    </div>
                                    <div class="range-price">Range: $49.00 - $360.00</div>
                                    <!-- <div class="">Range: <?= $_POST['min_price'] . " - " . $_POST['max_price'] ?></div> -->
                                </div>
                            </div>
                        </div>

                        <!-- ##### Single Widget ##### -->
                        <div class="widget color mb-50">
                            <!-- Widget Title 2 -->
                            <p class="widget-title2 mb-30">Color</p>
                            <div class="widget-desc">
                                <ul class="d-flex">
                                    <li><a href="search.php?c=white" class="color1"></a></li>
                                    <li><a href="search.php?c=dgray" class="color2"></a></li>
                                    <li><a href="search.php?c=black" class="color3"></a></li>
                                    <li><a href="search.php?c=blue" class="color4"></a></li>
                                    <li><a href="search.php?c=red" class="color5"></a></li>
                                    <li><a href="search.php?c=yellow" class="color6"></a></li>
                                    <li><a href="search.php?c=oreng" class="color7"></a></li>
                                    <li><a href="search.php?c=aqua" class="color8"></a></li>
                                    <li><a href="search.php?c=green" class="color9"></a></li>
                                    <li><a href="search.php?c=parpul" class="color10"></a></li>
                                    <li><a href="search.php?c=dgreen" class="color11"></a></li>
                                    <li><a href="search.php?c=lgray" class="color12"></a></li>
                                    <li><a href="search.php?c=dblue" class="color13"></a></li>
                                    <li><a href="search.php?c=derd" class="color14"></a></li>
                                    <li><a href="search.php?c=olive" class="color15"></a></li>
                                </ul>
                            </div>
                        </div>

                        <!-- ##### Single Widget ##### -->
                        <div class="widget brands mb-50">
                            <!-- Widget Title 2 -->
                            <p class="widget-title2 mb-30">Brands</p>
                            <div class="widget-desc">
                                <ul>
                                    <li><a href='search.php'>All</a></li>
                                    <?php
                                    $brand = new brand;

                                    $brands = $brand->search();
                                    foreach ($brands as $b) {
                                        echo "<li><a href='$_SERVER[PHP_SELF]?$url&b=$b[name]'>$b[name]</a></li>";
                                    }
                                    ?>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-8 col-lg-9">
                    <div class="shop_grid_product_area">
                        <div class="row">
                            <div class="col-12">
                                <div class="product-topbar d-flex align-items-center justify-content-between">
                                    <!-- Total Products -->
                                    <div class="total-products">
                                        <p><span><?= count($search_result) ?></span> products found</p>
                                    </div>
                                    <!-- Sorting -->
                                    <div class="product-sorting d-flex justify-content-between">
                                        <!-- <p>Sort by:</p> -->
                                        <form action="search.php" method="POST">
                                            <!-- <select name="sort" id="sortByselect">
                                                <option selected value="id">Newest</option>
                                                <option value="rate">Top Rated</option>
                                                <option value="discount">Most Selling</option>
                                            </select>
                                            <input type="submit" class="d-none" value=""> -->
                                            <select class="form-select" aria-label="Default select example" name="sort">
                                                <option selected>Sort By:</option>
                                                <option value="id">Newest</option>
                                                <option value="rate">Top Rated</option>
                                                <option value="discount">Most Selling</option>
                                            </select>
                                            <button type="submit" class="btn btn-dark">Sort</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <?php


                            foreach ($search_result as $val) {
                                $cover_array = json_decode($val['images_src'], true);
                                $cover = ($cover_array['cover'] == null) ? $cover_array[0] : $cover_array['cover'];
                                $date = ($product->calDateDiff($val['date_of_additon']) > 7) ? "" : "<div class='product-badge new-badge'><span>New</span></div>";
                                if ($val['discount'] == 0) {
                                    $discount = "";
                                    $price = $val['price'];
                                    $oldPrice = "";
                                } else {
                                    $discount = "<div class='product-badge offer-badge'><span>$val[discount]%</span></div>";
                                    $price = $val['price'] - ($val['price'] * $val['discount'] * 0.01);
                                    $oldPrice = $val['price'] . "$";
                                }
                                $favorites = new Favorites;
                                $fav = $favorites->getAll($user_id, $val['id']);
                                $is_fav = ($fav == null) ? "" : "active";

                                echo "
                                <!-- Single Product -->
                                <div class='single-product-wrapper'>
                                    <!-- Product Image -->
                                    <div class='product-img'>
                                        <img src='dashboard/view/$cover' alt='$val[name]'>
                                        <!-- Product Badge -->
                                        $date $discount
                                        <!-- Favourite -->
                                        <div class='product-favourite'>
                                            <a href='productDetails.php?id=$val[id]&f=$val[id]' class='favme fa fa-heart $is_fav'></a>
                                        </div>
                                    </div>
                                    <!-- Product Description -->
                                    <div class='product-description'>
                                        <span>$val[brand]</span>
                                        <a href='productDetails.php?id=$val[id]'>
                                            <h6>$val[name]</h6>
                                        </a>
                                        <p class='product-price'><span class='old-price'>$oldPrice</span>$price$</p>
        
                                        <!-- Hover Content -->
                                        <div class='hover-content'>
                                            <!-- Add to Cart -->
                                            <div class='add-to-cart-btn'>
                                                <a href='productDetails.php?id=$val[id]' class='btn essence-btn'>Add to Cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>";
                            }

                            ?>




                        </div>
                    </div>
                    <!-- Pagination -->
                    <nav aria-label="navigation">
                        <ul class="pagination mt-50 mb-70">
                            <?PHP
                            // get page number
                            if (isset($_GET['page']))
                                $page_no = $_GET['page'];
                            else $page_no = null;
                            ?>
                            <li class="page-item <?= ($page_no == 1) ? 'disabled' : ''; ?>"><a class="page-link" href="<?= $_SERVER['PHP_SELF'] . '?' . $url . '&page=' . ($page_no - 1) ?>"><i class="fa fa-angle-left"></i></a></li>
                            <?PHP

                            // get count of pages
                            $pages_count = ceil(count($search_result) / 9);
                            // 
                            for ($i = 1; $i <= $pages_count; $i++) {
                                if ($page_no == $i || (!isset($_GET['page']) && $i == 1)) {
                                    $activeClass = "active";
                                    $style = "style='color:#fff'";
                                } else {
                                    $activeClass = "";
                                    $style = "";
                                }

                                echo "<li class='page-item $activeClass'><a class='page-link' $style href='$_SERVER[PHP_SELF]?$url&page=$i'>$i</a></li>";

                                if ($i == 4 && $pages_count > 4) {
                                    echo "<li class='page-item disabled'><a class='page-link' href='#'>...</a></li>";
                                    echo "<li class='page-item'><a class='page-link' href='$_SERVER[PHP_SELF]?$url&page=$pages_count'>$pages_count</a></li>";
                                    break; // Exit the loop after the "..." and last page link
                                }
                            }

                            ?>
                            <li class="page-item <?= ($page_no == $pages_count) ? 'disabled' : ''; ?>"><a class="page-link" href="<?= $_SERVER['PHP_SELF'] . '?' . $url . '&page=' . ($page_no + 1) ?>"><i class="fa fa-angle-right"></i></a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Shop Grid Area End ##### -->

    <!-- ##### Footer Area Start ##### -->
    <?php include "files/footer.php" ?>
    <!-- ##### Footer Area End ##### -->
    <?php
    // echo "<pre>"; 
    // print_r($_SERVER);
    // echo "</pre>";
    ?>
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