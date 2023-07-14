<?PHP
include_once "dashboard/model/productClass.php";
include_once "dashboard/model/cartClass.php";
$cart = new Cart;
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Call your removeProduct() function passing the ID
    $cart->deleteFromCart($id);
    header("Refresh: 1");
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
    <title>Essence Fashion Ecommerce</title>

    <!-- Favicon  -->
    <link rel="icon" href="img/core-img/favicon.ico">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="css/core-style.css">
    <link rel="stylesheet" href="css/style.css">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .product-img {
            height: 285px;
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

    <!-- ##### Welcome Area Start ##### -->
    <section class="welcome_area bg-img background-overlay" style="background-image: url(img/bg-img/bg-1.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="hero-content">
                        <h6>asoss</h6>
                        <h2>New Collection</h2>
                        <a href="shop.php" class="btn essence-btn">view collection</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Welcome Area End ##### -->

    <!-- ##### Top Catagory Area Start ##### -->
    <div class="top_catagory_area section-padding-80 clearfix">
        <div class="container">
            <div class="row justify-content-center">
                <!-- Single Catagory -->
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="single_catagory_area d-flex align-items-center justify-content-center bg-img" style="background-image: url(img/bg-img/bg-2.jpg);">
                        <div class="catagory-content">
                            <a href="clothing.php">Clothing</a>
                        </div>
                    </div>
                </div>
                <!-- Single Catagory -->
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="single_catagory_area d-flex align-items-center justify-content-center bg-img" style="background-image: url(img/bg-img/bg-3.jpg);">
                        <div class="catagory-content">
                            <a href="shoes.php">Shoes</a>
                        </div>
                    </div>
                </div>
                <!-- Single Catagory -->
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="single_catagory_area d-flex align-items-center justify-content-center bg-img" style="background-image: url(img/bg-img/bg-4.jpg);">
                        <div class="catagory-content">
                            <a href="accessories.php">Accessories</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Top Catagory Area End ##### -->

    <!-- ##### CTA Area Start ##### -->
    <div class="cta-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="cta-content bg-img background-overlay" style="background-image: url(img/bg-img/bg-5.jpg);">
                        <div class="h-100 d-flex align-items-center justify-content-end">
                            <div class="cta--text">
                                <h6>-60%</h6>
                                <h2>Global Sale</h2>
                                <a href="shop.php" class="btn essence-btn">Buy Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### CTA Area End ##### -->

    <!-- ##### New Arrivals Area Start ##### -->
    <section class="new_arrivals_area section-padding-80 clearfix">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading text-center">
                        <h2>Newest Products</h2>
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
                        $result = $product->getLast10Products();
                        foreach ($result as $val) {
                            $cover_array = json_decode($val['images_src'], true);
                            $caver = ($cover_array['cover'] == null) ? $cover_array[0] : $cover_array['cover'];

                            echo "
                                <!-- Single Product -->
                                <div class='single-product-wrapper'>
                                    <!-- Product Image -->
                                    <div class='product-img'>
                                        <img src='dashboard/view/$caver' alt='$val[name]'>
                                        <!-- Product Badge -->
                                        <div class='product-badge new-badge'>
                                        <span>New</span>
                                        </div>
                                        <!-- Favourite -->
                                        <div class='product-favourite'>
                                            <a href='#' class='favme fa fa-heart'></a>
                                        </div>
                                    </div>
                                    <!-- Product Description -->
                                    <div class='product-description'>
                                        <span>$val[brand]</span>
                                        <a href='productDetails.php?id=$val[id]'>
                                            <h6>$val[name]</h6>
                                        </a>
                                        <p class='product-price'>$val[price]$</p>
        
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
            </div>
        </div>
    </section>
    <!-- ##### New Arrivals Area End ##### -->

    <!-- ##### New Arrivals Area Start ##### -->
    <section class="new_arrivals_area section-padding-80 clearfix">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading text-center">
                        <h2>Top Rated Products</h2>
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
                        $result = $product->getTopRatedProducts();
                        foreach ($result as $val) {
                            $cover_array = json_decode($val['images_src'], true);
                            $caver = ($cover_array['cover'] == null) ? $cover_array[0] : $cover_array['cover'];
                            $date = (calDateDiff($val['date_of_additon']) > 7) ? "" : "<div class='product-badge new-badge'><span>New</span></div>";
                            if ($val['discount'] == 0) {
                                $discount = "";
                                $price = $val['price'];
                                $oldPrice = "";
                            } else {
                                $discount = "<div class='product-badge offer-badge'><span>$val[discount]%</span></div>";
                                $price = $val['price'] - ($val['price'] * $val['discount'] * 0.01);
                                $oldPrice = $val['price'] . "$";
                            }

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
                                            <a href='#' class='favme fa fa-heart'></a>
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
        </div>
    </section>
    <!-- ##### New Arrivals Area End ##### -->

    <!-- ##### Brands Area Start ##### -->
    <div class="brands-area d-flex align-items-center justify-content-between">
        <!-- Brand Logo -->
        <div class="single-brands-logo">
            <img src="img/core-img/brand1.png" alt="">
        </div>
        <!-- Brand Logo -->
        <div class="single-brands-logo">
            <img src="img/core-img/brand2.png" alt="">
        </div>
        <!-- Brand Logo -->
        <div class="single-brands-logo">
            <img src="img/core-img/brand3.png" alt="">
        </div>
        <!-- Brand Logo -->
        <div class="single-brands-logo">
            <img src="img/core-img/brand4.png" alt="">
        </div>
        <!-- Brand Logo -->
        <div class="single-brands-logo">
            <img src="img/core-img/brand5.png" alt="">
        </div>
        <!-- Brand Logo -->
        <div class="single-brands-logo">
            <img src="img/core-img/brand6.png" alt="">
        </div>
    </div>
    <!-- ##### Brands Area End ##### -->

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