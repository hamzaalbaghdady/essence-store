<?php
require_once "dashboard/model/cartClass.php";
require_once "dashboard/model/productClass.php";
// require_once "dashboard/model/userClass.php";

$cart = new Cart;
$product = new product;
$items = $cart->getCartItems($user_id);

?>

<head>
    <style>
        .fa-close {
            font-size: 20px;
            cursor: pointer;
        }

        .fa-close:hover {
            color: red;
        }
    </style>
</head>
<div class="cart-bg-overlay"></div>

<div class="right-side-cart-area">

    <!-- Cart Button -->
    <div class="cart-button">
        <a href="#" id="rightSideCart"><i class="fa-solid fa-cart-shopping"></i> <span> <?= count($items) ?></span></a>
    </div>

    <div class="cart-content d-flex">

        <!-- Cart List Area -->
        <div class="cart-list">
            <?php
            $subtotal = 0;
            $discount = 0;
            $total = 0;

            foreach ($items as $item) {
                // get product data
                $product_id = $item['product_id'];
                $resultx = $product->searchById($product_id);
                // get cover image
                $cover_array = json_decode($resultx['images_src'], true);
                $cover = ($cover_array['cover'] == null) ? $cover_array[0] : $cover_array['cover'];
                // get price
                if ($resultx['discount'] == 0) {
                    $pricex = $resultx['price'];
                } else {
                    $pricex = $resultx['price'] - ($resultx['price'] * $resultx['discount'] * 0.01);
                }
                $subtotal += $resultx['price'];
                $discount += $resultx['discount'];
                $total += $pricex;
                echo "<!-- Single Cart Item -->
                    <div class='single-cart-item'>
                        <a  class='product-image'>
                            <img src='dashboard/view/$cover' class='cart-thumb' alt='$resultx[name]'>
                            <!-- Cart Item Desc -->
                            <div class='cart-item-desc'>
                            <span class='product-remove'><i class='fa fa-close' aria-hidden='true' onclick='remove($item[id])'></i></span>
                                <span class='badge'>$resultx[brand]</span>
                                <h6>$resultx[name]</h6>
                                <p class='size'>Size: $item[size]</p>
                                <p class='color'>Color: $item[color]</p>
                                <p class='price'>$pricex $</p>
                            </div>
                        </a>
                    </div>";
            }
            ?>
            <!-- <form><button type='submit' value='id'><i class='fa fa-close' aria-hidden='true'></button></form> -->

        </div>

        <!-- Cart Summary -->
        <div class="cart-amount-summary">
            <?php
            if (count($items) == 0) {
                echo "<h4>You haven't added any products to your cart yet!</h4><br><br>
                <i class='fa-solid fa-cart-plus' style='font-size:300px;'></i></i>";
            } else {
                echo "
                    <h2>Summary</h2>
                    <ul class='summary-table'>
                        <li><span>subtotal:</span> <span> $subtotal$</span></li>
                        <li><span>delivery:</span> <span>Free</span></li>
                        <li><span>discount:</span> <span>-$discount%</span></li>
                        <li><span>total:</span> <span>$total$</span></li>
                    </ul>
                    <div class='checkout-btn mt-100'>
                        <a href='checkout.php' class='btn essence-btn'>check out</a>
                    </div>";
            }
            ?>


        </div>
    </div>
</div>
<script>
    function remove(id) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'index.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    var response = xhr.responseText;
                    // Process the response from the PHP script
                    console.log(response);
                    location.reload();
                } else {
                    // Handle error cases
                    console.error('Request failed with status:', xhr.status);
                }
            }
        };

        var data = 'id=' + encodeURIComponent(id);
        xhr.send(data);
    }
</script>