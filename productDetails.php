<?PHP
require_once "dashboard/model/productClass.php";
require_once "dashboard/model/categoryClass.php";
require_once "dashboard/model/cartClass.php";
require_once "dashboard/model/favoritesClass.php";

$product = new product;
$fav = new Favorites;

$id = $_GET['id'];
$result = $product->searchById($id);
// get discount 
if ($result['discount'] == 0) {
    $price = $result['price'];
    $oldPrice = "";
} else {
    $price = $result['price'] - ($result['price'] * $result['discount'] * 0.01);
    $oldPrice = $result['price'] . "$";
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
    <title>Essence - Fashion Ecommerce Template</title>

    <!-- Favicon  -->
    <link rel="icon" href="img/core-img/favicon.ico">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="css/core-style.css">
    <link rel="stylesheet" href="css/style.css">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65">
    <style>
        .fa-star {
            color: gray;
            font-size: 20px;
            margin-left: 2px;
        }

        .gold {
            color: gold;
        }

        .rating {
            margin: 20px 0px;
            padding: 10px 0px;
        }

        .clearfix img {
            overflow: hidden;

        }

        img {
            max-height: 600px;
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

    <div class=" d-flex justify-content-center">
        <?php
        // check if user have an acount 
        if (isset($_SESSION['user'])) {
            // add to cart
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $product_id = $id;
                $size = $_POST['size'];
                $color = $_POST['color'];
                $btn = $_POST['submitBtn'];
                if (isset($btn)) {
                    if (empty($size) || empty($color)) {
                        echo "<div class='alert alert-danger' role='alert'>Fill all the fields!</div>";
                    } else if ($result['quantity'] <= 1) {
                        echo "<div class='alert alert-danger' role='alert'>We dont have this product in Stock at the moment, try later. Thanks </div>";
                    } else {
                        $cart = new Cart;
                        $stat = $cart->addToCart($product_id, $user_id, $color, $size);
                        if ($stat == "true") {
                            echo "<div class='alert alert-success' role='alert'>Product has been added to your cart successfully.</div>";
                        } else echo "<div class='alert alert-warning' role='alert'>The product has been already added to your cart!</div>";
                    }
                }
            }
            // add to Favourites
            if (isset($_GET['f'])) {
                $statf = $fav->addToFav($user_id, $id);
                if ($statf == "true") {
                    echo "<div class='alert alert-success' role='alert'>Product has been added to your favourites successfully.</div>";
                } else echo "<div class='alert alert-warning' role='alert'>The product has been already added to your favourites!</div>";
            }
        } else echo "<div class='alert alert-danger' role='alert'>You need to have an account to add to cart or favourites!</div>";
        ?>

    </div>
    </div>


    <!-- ##### Single Product Details Area Start ##### -->
    <section class="single_product_details_area d-flex align-items-center">

        <!-- Single Product Thumb -->
        <div class="single_product_thumb clearfix">
            <div class="product_thumbnail_slides owl-carousel">
                <?php
                $images = json_decode($result['images_src'], true);
                echo "<img src='dashboard/view/$images[cover]' alt='$result[name]'>";
                foreach ($images as $src) {
                    echo "<img src='dashboard/view/$src' alt='$result[name]'>";
                }
                ?>

            </div>
        </div>

        <!-- Single Product Description -->
        <div class="single_product_desc clearfix">
            <span><?= $result['brand'] ?></span>
            <a href="cart.php">
                <h2><?= $result['name'] ?></h2>
            </a>

            <p class="product-price"><span class="old-price"><?= $oldPrice ?></span> <?= $price ?>$</p>
            <p class="product-desc"><?= $result['description'] ?></p>
            <p> <?= ($result['quantity'] > 1) ? "<span style='color:#30fc03'>In Stock</span>" : "<span style='color:#f00'>Temporarily Unavailable</span>" ?></p>


            <!-- Form -->
            <form class="cart-form clearfix" method="POST">
                <!-- Select Box -->
                <div class="select-box d-flex mt-50 mb-30">
                    <select name="size" id="productSize" class="mr-5">
                        <option value="XXXL">Size: XXXL</option>
                        <option value="XXL">Size: XXL</option>
                        <option value="XL" selected>Size: XL</option>
                        <option value="L">Size: L</option>
                        <option value="M">Size: M</option>
                        <option value="S">Size: S</option>
                    </select>
                    <select name="color" id="productColor">
                        <?php
                        $colors = json_decode($result['colors'], true);
                        foreach ($colors as $color) {
                            echo "<option value='$color'>Color: $color</option>";
                        }
                        ?>

                    </select>
                </div>
                <!-- Cart & Favourite Box -->
                <div class="cart-fav-box d-flex align-items-center">
                    <!-- Cart -->
                    <button type="submit" name="submitBtn" id="openCart" value="5" class="btn essence-btn">Add to cart</button>
                    <!-- Favourite -->
                    <div class="product-favourite ml-4">
                        <?php
                        $fav_item = $fav->getAll($user_id, $id);
                        $is_fav = ($fav_item == null) ? "" : "active";
                        ?>
                        <a href="productDetails.php?id=<?= $id ?>&f=<?= $id ?>" class="favme fa fa-heart <?= $is_fav ?>"></a>
                    </div>
                </div>
            </form>
            <div class="rating">
                <?php
                $rate = $result['rate'];
                echo "<b>$rate</b>";
                for ($i = 0; $i < $rate; $i++) {
                    echo "<i class='fa-solid fa-star gold'></i>";
                }
                $ungolden = 5 - $rate;
                for ($i = 0; $i < $ungolden; $i++) {
                    echo "<i class='fa-regular fa-star '></i>";
                }
                ?>
            </div>
        </div>
        <!-- see also -->
    </section>
    <section class="new_arrivals_area section-padding-80 clearfix">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading text-center">
                        <h3>See also</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="popular-products-slides owl-carousel">
                        <?php
                        $product = new product;
                        $categoty = new Category;
                        $cats = $categoty->getCatByProductID($id);
                        $result2 = $product->seeAlso($cats, $result['brand']);

                        foreach ($result2 as $val) {
                            $cover_array = json_decode($val['images_src'], true);
                            $caver = ($cover_array['cover'] == null) ? $cover_array[0] : $cover_array['cover'];
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
                                        <img src='dashboard/view/$caver' alt='$val[name]'>
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
                        // }

                        ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Single Product Details Area End ##### -->

    <!-- ##### Footer Area Start ##### -->
    <?php include "files/footer.php" ?>
    <!-- ##### Footer Area End ##### -->
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

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
    <script>
        function openCart() {
            const cartButton = document.getElementById('openCart');
            cartButton.addEventListener('click', function() {
                const cartElements1 = document.querySelectorAll('.cart-bg-overlay');

                cartElements1.forEach(function(cartElement) {
                    cartElement.classList.toggle('cart-bg-overlay cart-bg-overlay-on');
                });

                const cartElements2 = document.querySelectorAll('.right-side-cart-area');

                cartElements2.forEach(function(cartElement) {
                    cartElement.classList.toggle('right-side-cart-area cart-on');
                });
            });
        }
    </script>

</body>

</html>