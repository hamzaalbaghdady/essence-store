<?php require_once "dashboard/model/salesClass.php"; ?>
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
                        <h2>Checkout</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->
    <div class="container d-flex justify-content-center mt-3">
        <?php

        if (count($cart->getCartItems($user_id)) == 0) {
            alert("Your cart is empty", "danger");
        } else {
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $f_name = $_POST['f_name'];
                $l_name = $_POST['l_name'];
                $email = $_POST['email'];
                $city = $_POST['city'];
                $address = $_POST['address'];
                $postcode = $_POST['postcode'];
                $phone = $_POST['phone'];
                $Pmethod = $_POST['Pmethod'];
                //
                $paypal_email = $_POST['paypal_email'];
                $ssn = $_POST['ssn'];
                $card_no = $_POST['card_no'];
                $exp_date = $_POST['exp_date'];
                $cv_code = $_POST['cv_code'];
                $cardOwner_name = $_POST['cardOwnerName'];
                $bank_name = $_POST['bank_name'];
                $account_no = $_POST['account_no'];
                $account_name = $_POST['account_name'];
                //
                $TC = $_POST['T&C'];
                $submitBtn = $_POST['submitBtn'];
                if (isset($submitBtn)) {
                    if (empty($f_name) || empty($l_name) || empty($email) || empty($city) || empty($TC) || empty($address) || empty($postcode) || empty($phone) || empty($Pmethod)) {
                        alert("Fill all the fields", "danger");
                    } else {
                        $pay_status = true;
                        $Pmethod_info = array();
                        switch ($Pmethod) {
                            case 'paypal':
                                if (empty($paypal_email)) {
                                    alert("Fill the paypal email field!", "danger");
                                    $pay_status = false;
                                } else $Pmethod_info = ["name" => $Pmethod, "paypal_email" => $paypal_email];
                                break;

                            case 'creditCard':
                                if (empty($card_no) || empty($exp_date) || empty($cv_code) || empty($cardOwner_name)) {
                                    alert("Fill all the Credit Card fields", "danger");
                                    $pay_status = false;
                                } else $Pmethod_info = ["name" => $Pmethod, "card_no" => $card_no, "exp_date" => $exp_date,  "cv_code" => $cv_code,  "cardOwner_name" => $cardOwner_name];
                                break;

                            case 'cash':
                                if (empty($ssn)) {
                                    alert("Fill the cash ssn field", "danger");
                                    $pay_status = false;
                                } else $Pmethod_info = ["name" => $Pmethod, "ssn" => $ssn];
                                break;

                            case 'bank':
                                if (empty($bank_name) || empty($account_no) || empty($account_name)) {
                                    alert("Fill all the Bank fields", "danger");
                                    $pay_status = false;
                                } else $Pmethod_info = ["name" => $Pmethod, "bank_name" => $bank_name, "account_name" => $account_name, "account_no" => $account_no];
                                break;
                        }
                        if ($pay_status) {
                            $info = ['city' => $city, 'address' => $address, 'postcode' => $postcode, 'phone' => $phone, 'Pmethod' => $Pmethod, 'TC' => $TC, 'payment_method' => $Pmethod_info];
                            $info = json_encode($info);
                            $users = new user;
                            // check if user already exists
                            if ($users->userExists($email)) {
                                $users->editUser($user_id, $f_name, $l_name, $email, $info);
                            } else $users->createUser($f_name, $l_name, '', $email, 'not member', $info);
                            // add sale
                            $Sale = new Sale;
                            foreach ($items as $item) {
                                // get product data
                                $product_id = $item['product_id'];
                                $resultx = $product->searchById($product_id);
                                // get price
                                if ($resultx['discount'] == 0) {
                                    $pricex = $resultx['price'];
                                } else {
                                    $pricex = $resultx['price'] - ($resultx['price'] * $resultx['discount'] * 0.01);
                                }
                                $Sale->addSale($product_id, $user_id, $pricex);
                            }
                            $cart->removeAll($user_id);
                            alert("All good!", "success");
                            // header("location:checkout.php?s=c");
                        }
                    }
                }
            }
        }


        function alert($message, $type)
        {
            echo "<div class='alert alert-$type' role='alert'>
            $message
          </div>";
        }
        ?>
    </div>
    <!-- ##### Checkout Area Start ##### -->
    <div class="checkout_area section-padding-80">
        <div class="container">
            <div class="row">

                <div class="col-12 col-md-6">
                    <div class="checkout_details_area mt-50 clearfix">

                        <div class="cart-page-heading mb-30">
                            <h5>Billing Address</h5>
                            <!-- Get user location -->
                            <p>
                                <?php
                                // $ip = $_SERVER['REMOTE_ADDR']; // Get the user's IP address
                                $ip = '213.6.149.217';

                                // Make a request to the IP Geolocation API
                                $response = file_get_contents("http://ip-api.com/json/{$ip}");

                                // Decode the JSON response into an associative array
                                $data = json_decode($response, true);

                                if ($data['status'] === 'success') {
                                    $country = $data['country'];
                                    $region = $data['regionName'];
                                    $city = $data['city'];

                                    echo "User location: {$city}, {$region}, {$country}";
                                } else {
                                    echo "Unable to retrieve user location.";
                                }
                                ?>
                            </p>
                        </div>

                        <form action="#" method="post">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="first_name">First Name <span>*</span></label>
                                    <input type="text" class="form-control" id="first_name" name="f_name" value="<?= isset($_POST['f_name']) ? $_POST['f_name'] : ''; ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="last_name">Last Name <span>*</span></label>
                                    <input type="text" class="form-control" id="last_name" name="l_name" value="<?= isset($_POST['l_name']) ? $_POST['l_name'] : ''; ?>" required>
                                </div>
                                <div class="col-12 mb-4">
                                    <label for="email_address">Email Address <span>*</span></label>
                                    <input type="email" class="form-control" id="email_address" name="email" value="<?= isset($_POST['email']) ? $_POST['email'] : ''; ?>" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="country">City <span>*</span></label>
                                    <select class="w-100" name="city" id="city" required>
                                        <?PHP
                                        if (isset($_POST['city'])) {
                                            $city = $_POST['city'];
                                        } else $city = "";
                                        ?>
                                        <option value="jer" <?= ($city == 'jer') ? 'selected' : ''; ?>>Jerusalem</option>
                                        <option value="ram" <?= ($city == 'ram') ? 'selected' : ''; ?>>Ramallah</option>
                                        <option value="gza" <?= ($city == 'gza') ? 'selected' : ''; ?>>Gaza</option>
                                        <option value="heb" <?= ($city == 'heb') ? 'selected' : ''; ?>>Hebron</option>
                                        <option value="jen" <?= ($city == 'jen') ? 'selected' : ''; ?>>Jenin</option>
                                        <option value="jer" <?= ($city == 'jer') ? 'selected' : ''; ?>>Jericho</option>
                                        <option value="nab" <?= ($city == 'nab') ? 'selected' : ''; ?>>Nablus</option>
                                        <option value="isr" <?= ($city == 'isr') ? 'selected' : ''; ?>>Is real</option>
                                    </select>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="street_address">Address <span>*</span></label>
                                    <input type="text" class="form-control mb-3" id="street_address" name="address" value="<?= isset($_POST['address']) ? $_POST['address'] : ''; ?>" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="postcode">Postcode <span>*</span></label>
                                    <input type="text" class="form-control" id="postcode" name="postcode" value="<?= isset($_POST['postcode']) ? $_POST['postcode'] : ''; ?>" required>
                                </div>

                                <div class="col-12 mb-3">
                                    <label for="phone_number">Phone No <span>*</span></label>
                                    <input type="number" class="form-control" id="phone_number" min="0" name="phone" value="<?= isset($_POST['phone']) ? $_POST['phone'] : ''; ?>" placeholder="05" required>
                                </div>
                                <?php
                                $pp = '';
                                $cash = '';
                                $cc = '';
                                $bank = '';
                                if (isset($_POST['Pmethod'])) {
                                    $Pmethod = $_POST['Pmethod'];
                                    $pp = ($Pmethod == 'paypal');
                                    $cash = ($Pmethod == 'cash');
                                    $cc = ($Pmethod == 'creditCard');
                                    $bank = ($Pmethod == 'bank');
                                }

                                ?>

                                <div class="col-12 mb-3">
                                    <label>Payment method <span>*</span></label>
                                    <div id="accordion" role="tablist" class="mb-4">
                                        <div class="form-check card-header pe-2" role="tab" id="heading1">
                                            <input type="radio" name="Pmethod" class="form-check-input <?= ($pp ? '' : 'collapsed') ?>" data-toggle="collapse" href="#collapse1" aria-expanded="<?= ($pp ? 'true' : 'false') ?>" aria-controls="collapseTwo" id="Pmethod" min="0" required value="paypal" <?= ($pp ? 'checked' : '') ?>>
                                            <label for="1" class="form-check-label">Paypal <i class="fa-brands fa-paypal"></i></label>
                                            <div id="collapse1" class="collapse <?= ($pp ? 'show' : '') ?>" role="tabpanel" aria-labelledby="heading1" data-parent="#accordion">
                                                <div class="card-body">
                                                    <label for="email"> Your Paypal Email</label>
                                                    <input id="email" name="paypal_email" value="<?= isset($_POST['paypal_email']) ? $_POST['paypal_email'] : ''; ?>" type="email" class="form-control" placeholder="Email or mobile number">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-check card-header " role="tab" id="heading2">
                                            <input type="radio" name="Pmethod" class="form-check-input <?= ($cash ? '' : 'collapsed') ?>" data-toggle="collapse" href="#collapse2" aria-expanded="<?= ($cash ? 'true' : 'false') ?>" aria-controls="collapse2" id="Pmethod" min="0" required value="cash" <?= ($cash ? 'checked' : '') ?>>
                                            <label for="2" class="form-check-label">Cash on delievery <i class="fa-solid fa-sack-dollar"></i></label>
                                            <div id="collapse2" class="collapse <?= ($cash ? 'show' : '') ?>" role="tabpanel" aria-labelledby="heading2" data-parent="#accordion">
                                                <div class="card-body">
                                                    <label for="ssn"> Your SSN</label>
                                                    <input id="ssn" name="ssn" value="<?= isset($_POST['ssn']) ? $_POST['ssn'] : ''; ?>" type="text" class="form-control" placeholder="SSN or ID">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-check card-header ps-2 " role="tab" id="heading3">
                                            <input type="radio" name="Pmethod" class="form-check-input <?= ($cc ? '' : 'collapsed') ?>" data-toggle="collapse" href="#collapse3" aria-expanded="<?= ($cc ? 'true' : 'false') ?>" aria-controls="collapse3" id="Pmethod" min="0" required value="creditCard" <?= ($cc ? 'checked' : '') ?>>
                                            <label for="3" class="form-check-label">Credit card <i class="fa-regular fa-credit-card"></i></label>
                                            <div id="collapse3" class="collapse <?= ($cc ? 'show' : '') ?>" role="tabpanel" aria-labelledby="heading3" data-parent="#accordion">
                                                <div class="card-body">
                                                    <div calss="col mb-3">
                                                        <label for="">CARD NUMBER</label>
                                                        <input type="text" name="card_no" value="<?= isset($_POST['card_no']) ? $_POST['card_no'] : ''; ?>" id="" class="form-control" placeholder="Valid Card Number">
                                                    </div>
                                                    <br>
                                                    <div calss="row m-5" style="display: flex;">
                                                        <div class="col-6 p-0">
                                                            <label for="">EXPIRATION DATE</label>
                                                            <input type="text" name="exp_date" value="<?= isset($_POST['exp_date']) ? $_POST['exp_date'] : ''; ?>" id="" class="form-control" placeholder="MM/DD">
                                                        </div>
                                                        <div class="col-6 ps-1">
                                                            <label for="">CV CODE</label>
                                                            <input type="text" name="cv_code" value="<?= isset($_POST['cv_code']) ? $_POST['cv_code'] : ''; ?>" id="" class="form-control" placeholder="CVC">
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div calss="col mb-3">
                                                        <label for="">CARD OWNER</label>
                                                        <input type="text" name="cardOwnerName" value="<?= isset($_POST['cardOwnerName']) ? $_POST['cardOwnerName'] : ''; ?>" id="card_owner" class="form-control" placeholder="Card Owner Name">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-check card-header " role="tab" id="heading4">
                                            <input type="radio" name="Pmethod" class="form-check-input <?= ($bank ? '' : 'collapsed') ?>" data-toggle="collapse" href="#collapse4" aria-expanded="<?= ($bank ? 'true' : 'false') ?>" aria-controls="collapse4" id="4" min="0" required value="bank" <?= ($bank ? 'checked' : '') ?>>
                                            <label for="4" class="form-check-label">Direct bank transfer <i class="fa-solid fa-money-bill-transfer"></i></label>
                                            <div id="collapse4" class="collapse <?= ($bank ? 'show' : '') ?>" role="tabpanel" aria-labelledby="heading4" data-parent="#accordion">
                                                <div class="card-body">

                                                    <div class="col-12 mb-3 p-0">
                                                        <select name="bank_name" class="form-control w-100">
                                                            <?PHP
                                                            if (isset($_POST['bank_name'])) {
                                                                $bankName = $_POST['bank_name'];
                                                            } else $bankName = "";
                                                            ?>
                                                            <option selected>Select Bank</option>
                                                            <option <?= ($bankName == 'bp') ? 'selected' : ''; ?> value="bp">Bank of Palestine</option>
                                                            <option <?= ($bankName == 'aib') ? 'selected' : ''; ?> value="aib">Arab Islamic Bank</option>
                                                            <option <?= ($bankName == 'aqb') ? 'selected' : ''; ?> value="aqb">Al Quds Bank</option>
                                                            <option <?= ($bankName == 'pinb') ? 'selected' : ''; ?> value="pinb">Palestine Investment Bank</option>
                                                            <option <?= ($bankName == 'tnb') ? 'selected' : ''; ?> value="tnb">The National Bank TNB</option>
                                                            <option <?= ($bankName == 'ab') ? 'selected' : ''; ?> value="ab">Arab Bank</option>
                                                            <option <?= ($bankName == 'bj') ? 'selected' : ''; ?> value="bj">Bank of Jordan</option>
                                                            <option <?= ($bankName == 'bi') ? 'selected' : ''; ?> value="bi">Bank of Israel</option>
                                                        </select>
                                                    </div>
                                                    <br>

                                                    <div calss="col mb-3">
                                                        <br>
                                                        <label for="">Acount NO</label>
                                                        <input type="text" name="account_no" value="<?= isset($_POST['account_no']) ? $_POST['account_no'] : ''; ?>" id="" class="form-control" placeholder="Acount NO">
                                                    </div>
                                                    <br>

                                                    <div calss="col mb-3">
                                                        <label for="">Account Holder Name</label>
                                                        <input type="text" name="account_name" value="<?= isset($_POST['account_name']) ? $_POST['account_name'] : ''; ?>" id="" class="form-control" placeholder="Account Holder Name">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-12">
                                    <div class="custom-control custom-checkbox d-block mb-2">
                                        <input type="checkbox" class="custom-control-input" name="T&C" value="true" id="customCheck1" required>
                                        <label class="custom-control-label" for="customCheck1">Terms and conitions <span>*</span></label>
                                    </div>
                                    <div class="custom-control custom-checkbox d-block mb-2">
                                        <input type="checkbox" class="custom-control-input" name="create_account" value="true" id="customCheck2">
                                        <label class="custom-control-label" for="customCheck2">Create an accout</label>
                                    </div>
                                    <div class="custom-control custom-checkbox d-block">
                                        <input type="checkbox" class="custom-control-input" name="subscribe" value="true" id="customCheck3">
                                        <label class="custom-control-label" for="customCheck3">Subscribe to our newsletter</label>
                                    </div>
                                </div>
                                <div class="col-12 mt-5">
                                    <input type="submit" class="btn essence-btn" name="submitBtn" value="Place Order">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-5 ml-lg-auto">
                    <div class="order-details-confirmation" style="position: sticky; top: 100px;">

                        <div class="cart-page-heading">
                            <h5>Your Order</h5>
                            <p>The Details</p>
                        </div>

                        <ul class="order-details-form mb-4">
                            <li><span>Product</span> <span>Price</span></li>
                            <?php
                            foreach ($items as $item) {
                                // get product data
                                $product_id = $item['product_id'];
                                $resultx = $product->searchById($product_id);
                                // get cover image

                                // get price
                                if ($resultx['discount'] == 0) {
                                    $price = $resultx['price'];
                                } else {
                                    $price = $resultx['price'] - ($resultx['price'] * $resultx['discount'] * 0.01);
                                }
                                echo "<li><span>$resultx[name]</span> <span>$price$</span></li>";
                            }
                            ?>
                            <li><span>Subtotal</span> <span><?= $subtotal ?>$</span></li>
                            <li><span>Shipping</span> <span>Free</span></li>
                            <li><span>Total</span> <span><?= $total ?>$</span></li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Checkout Area End ##### -->

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