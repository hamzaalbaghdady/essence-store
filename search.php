<?php

include_once "dashboard/model/productClass.php";
include_once "dashboard/model/categoryClass.php";
include_once "dashboard/model/brandClass.php";
include_once "dashboard/model/favoritesClass.php";
$product = new product;


// Filter result
// get search key word
if (isset($_POST['searchBtn'])) {
    $name = $_POST['search'];
} else if (isset($_GET['search']))
    $name = $_GET['search'];
else $name = "";

if (isset($_GET['sort']))
    $sort = $_GET['sort'];
else $sort = "";

if (isset($_GET['categories']))
    $categoriesx = $_GET['categories'];
else $categoriesx = array();

if (isset($_GET['min_price']))
    $min_price = $_GET['min_price'];
else $min_price = 0;

if (isset($_GET['max_price']))
    $max_price = $_GET['max_price'];
else $max_price = 2000;

if (isset($_GET['colors']))
    $colors = $_GET['colors'];
else $colors = "";

if (isset($_GET['brand']))
    $brandx = $_GET['brand'];
else $brandx = "";
if (isset($_GET['page']))
    $offset = $_GET['page'] * 9;
else $offset = "";


$search_result = $product->Xsearch($name, $sort, $offset, $categoriesx, $min_price, $max_price, $colors, $brandx);


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

        .price-input {
            width: 100%;
            display: flex;
            margin: 30px 0 35px;
        }

        .price-input .field {
            display: flex;
            width: 100%;
            height: 45px;
            align-items: center;
        }

        .field input {
            width: 50%;
            /* height: 100%; */
            outline: none;
            font-size: 12px;
            margin-left: 12px;
            border-radius: 5px;
            text-align: center;
            border: 1px solid #999;
            -moz-appearance: textfield;
        }

        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
        }

        .price-input .separator {
            width: 130px;
            display: flex;
            font-size: 19px;
            align-items: center;
            justify-content: center;
        }

        .slider {
            height: 5px;
            position: relative;
            background: #ddd;
            border-radius: 5px;
        }

        .slider .progress {
            height: 100%;
            left: 0%;
            right: 0%;
            position: absolute;
            border-radius: 5px;
            background: #17a2b8;
        }

        .range-input {
            position: relative;
        }

        .range-input input {
            position: absolute;
            width: 100%;
            height: 5px;
            top: -5px;
            background: none;
            pointer-events: none;
            -webkit-appearance: none;
            -moz-appearance: none;
        }

        input[type="range"]::-webkit-slider-thumb {
            height: 17px;
            width: 17px;
            border-radius: 50%;
            background: #17a2b8;
            pointer-events: auto;
            -webkit-appearance: none;
            box-shadow: 0 0 6px rgba(0, 0, 0, 0.05);
        }

        input[type="range"]::-moz-range-thumb {
            height: 17px;
            width: 17px;
            border: none;
            border-radius: 50%;
            background: #17a2b8;
            pointer-events: auto;
            -moz-appearance: none;
            box-shadow: 0 0 6px rgba(0, 0, 0, 0.05);
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

                        <form action="" method="GET">
                            <input type="hidden" name="search" value="<?= $name ?>">
                            <!-- ##### Single Widget ##### -->
                            <div class="widget catagory mb-50">
                                <!-- Widget Title -->
                                <h6 class="widget-title mb-30">Filter BY:</h6>

                                <div class="product-sorting d-flex justify-content-between mb-30">
                                    <select class="form-select" aria-label="Default select example" name="sort">
                                        <option value="">Sort By:</option>
                                        <option value="id" <?= ($sort == 'id') ? 'selected' : '' ?>>Newest</option>
                                        <option value="rate" <?= ($sort == 'rate') ? 'selected' : '' ?>>Top Rated</option>
                                        <option value="discount" <?= ($sort == 'discount') ? 'selected' : '' ?>>Most Selling</option>
                                    </select>
                                </div>

                                <p class="widget-title2 mb-30">Catagories</p>

                                <!--  Catagories  -->
                                <div class="list-group">
                                    <ul class="list-group">
                                        <li class='list-group-item d-flex justify-content-between align-items-center'>
                                            <a href='search.php' style="font-size: 16px;">All</a>
                                        </li>
                                        <?php
                                        $category = new Category;

                                        $categories = $category->search();
                                        foreach ($categories as $val) {
                                            $c_count = count($product->ProductsPerCategory($val['id']));
                                            echo "<li class='list-group-item d-flex justify-content-between align-items-baseline'><div class='w-100'>";
                                            if (in_array($val['id'], $categoriesx))
                                                echo "<input class='me-1' type='checkbox' name='categories[]' value='$val[id]' id='$val[name]' checked>";
                                            else echo "<input class='me-1' type='checkbox' name='categories[]' value='$val[id]' id='$val[name]'>";
                                            echo "<label for='$val[name]' style='margin-left: 10px;'>$val[name]</label>
                                        </div>
                                        <span class='badge bg-primary rounded-pill'>$c_count</span>
                                        </li>
                                        ";
                                        }
                                        ?>


                                    </ul>
                                </div>
                            </div>


                            <!-- ##### Single Widget ##### -->
                            <div class="widget price mb-50">
                                <!-- Widget Title 2 -->
                                <p class="widget-title2 mb-30">Price</p>

                                <div class="slider">
                                    <div class="progress" style="left: <?= $min_price / 20 ?>%; right: <?= 100 - ($max_price / 20) ?>%;"></div>
                                    <!-- <div class="progress"></div> -->
                                </div>
                                <div class="range-input">
                                    <input type="range" class="range-min" min="0" max="2000" value="<?= $min_price ?>" step="50">
                                    <input type="range" class="range-max" min="0" max="2000" value="<?= $max_price ?>" step="50">
                                </div>

                                <div class="price-input">
                                    <div class="field">
                                        <span>Min</span>
                                        <input type="number" class="input-min" name="min_price" value="<?= $min_price ?>">
                                    </div>
                                    <div class="separator">-</div>
                                    <div class="field">
                                        <span>Max</span>
                                        <input type="number" class="input-max" name="max_price" value="<?= $max_price ?>">
                                    </div>
                                </div>

                            </div>

                            <!-- ##### Single Widget ##### -->
                            <div class="widget color mb-50">
                                <!-- Widget Title 2 -->
                                <p class="widget-title2 mb-30">Color</p>
                                <div class="widget-desc">
                                    <ul class="d-flex">
                                        <!-- <li><a href="search.php?c=white" class="color1"></a></li> -->

                                        <li><a class="color1"><input type="checkbox" value="white" name="colors[]"></a></li>
                                        <li><a class="color2"><input type="checkbox" value="d_gray" name="colors[]"></a></li>
                                        <li><a class="color3"><input type="checkbox" value="black" name="colors[]"></a></li>
                                        <li><a class="color4"><input type="checkbox" value="blue" name="colors[]"></a></li>
                                        <li><a class="color5"><input type="checkbox" value="red" name="colors[]"></a></li>
                                        <li><a class="color6"><input type="checkbox" value="yellow" name="colors[]"></a></li>
                                        <li><a class="color7"><input type="checkbox" value="oreng" name="colors[]"></a></li>
                                        <li><a class="color8"><input type="checkbox" value="aqua" name="colors[]"></a></li>
                                        <li><a class="color9"><input type="checkbox" value="green" name="colors[]"></a></li>
                                        <li><a class="color10"><input type="checkbox" value="parpul" name="colors[]"></a></li>
                                        <li><a class="color11"><input type="checkbox" value="d_green" name="colors[]"></a></li>
                                        <li><a class="color12"><input type="checkbox" value="l_gray" name="colors[]"></a></li>
                                        <li><a class="color13"><input type="checkbox" value="d_blue" name="colors[]"></a></li>
                                        <li><a class="color14"><input type="checkbox" value="d_red" name="colors[]"></a></li>
                                        <li><a class="color15"><input type="checkbox" value="olive" name="colors[]"></a></li>
                                    </ul>
                                </div>
                            </div>

                            <!-- ##### Single Widget ##### -->
                            <div class="widget brands mb-50">
                                <!-- Widget Title 2 -->
                                <p class="widget-title2 mb-30">Brands</p>
                                <div class="widget-desc">
                                    <ul>
                                        <li><a><input type='radio' name='brand' value='' style='margin-right: 5px;'> All</a></li>
                                        <?php
                                        $brand = new brand;

                                        $brands = $brand->search();
                                        foreach ($brands as $b) {
                                            // echo "<li><a href='$_SERVER[PHP_SELF]?$url&b=$b[name]'>$b[name]</a></li>";
                                            if ($b['name'] == $brandx)
                                                echo "<li><a><input type='radio' name='brand' value='$b[name]' checked style='margin-right: 5px;'>$b[name]</a></li>";
                                            else
                                                echo "<li><a><input type='radio' name='brand' value='$b[name]' style='margin-right: 5px;'>$b[name]</a></li>";
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>

                            <!-- ##### Single Widget ##### -->
                            <div class="widget brands mb-50">
                                <button type="submit" name="filter" class="btn btn-primary">Filter</button>
                            </div>

                        </form>
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
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <?php

                            if (count($search_result) == 0)
                                echo "<h3 style='color:red'>No Products Found</h3>";
                            else {
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
                            <li class="page-item <?= ($page_no == 1) ? 'disabled' : ''; ?>"><a class="page-link" href="<?= $_SERVER['PHP_SELF'] . '?' .  '&page=' . ($page_no - 1) ?>"><i class="fa fa-angle-left"></i></a></li>
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

                                echo "<li class='page-item $activeClass'><a class='page-link' $style href='$_SERVER[PHP_SELF]?page=$i'>$i</a></li>";

                                if ($i == 4 && $pages_count > 4) {
                                    echo "<li class='page-item disabled'><a class='page-link' href='#'>...</a></li>";
                                    echo "<li class='page-item'><a class='page-link' href='$_SERVER[PHP_SELF]?page=$pages_count'>$pages_count</a></li>";
                                    break; // Exit the loop after the "..." and last page link
                                }
                            }

                            ?>
                            <li class="page-item <?= ($page_no == $pages_count) ? 'disabled' : ''; ?>"><a class="page-link" href="<?= $_SERVER['PHP_SELF'] . '?'  . '&page=' . ($page_no + 1) ?>"><i class="fa fa-angle-right"></i></a></li>
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
    <script>
        const rangeInput = document.querySelectorAll(".range-input input"),
            priceInput = document.querySelectorAll(".price-input input"),
            range = document.querySelector(".slider .progress");
        let priceGap = 100;

        priceInput.forEach((input) => {
            input.addEventListener("input", (e) => {
                let minPrice = parseInt(priceInput[0].value),
                    maxPrice = parseInt(priceInput[1].value);

                if (maxPrice - minPrice >= priceGap && maxPrice <= rangeInput[1].max) {
                    if (e.target.className === "input-min") {
                        rangeInput[0].value = minPrice;
                        range.style.left = (minPrice / rangeInput[0].max) * 100 + "%";
                    } else {
                        rangeInput[1].value = maxPrice;
                        range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
                    }
                }
            });
        });

        rangeInput.forEach((input) => {
            input.addEventListener("input", (e) => {
                let minVal = parseInt(rangeInput[0].value),
                    maxVal = parseInt(rangeInput[1].value);

                if (maxVal - minVal < priceGap) {
                    if (e.target.className === "range-min") {
                        rangeInput[0].value = maxVal - priceGap;
                    } else {
                        rangeInput[1].value = minVal + priceGap;
                    }
                } else {
                    priceInput[0].value = minVal;
                    priceInput[1].value = maxVal;
                    range.style.left = (minVal / rangeInput[0].max) * 100 + "%";
                    range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
                }
            });
        });
    </script>
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