<?php
require_once "../model/categoryClass.php";
require_once "../model/brandClass.php";

?>
<?php include "files/head.php" ?>

<head>
    <!-- My Stylesheet -->
    <link href="css/myStyle.css" rel="stylesheet">
</head>

<div class="container-fluid position-relative d-flex p-0">
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Sidebar Start -->
    <?php include "files/aside.php" ?>
    <!-- Sidebar End -->


    <!-- Content Start -->
    <div class="content">
        <!-- Navbar Start -->
        <?php include "files/header.php" ?>
        <!-- Navbar End -->

        <!-- php -->
        <div class="container mt-5 d-flex justify-content-center">
            <div class="alert alert-success" role="alert">
                <?php
                // add new product
                $product = new product();
                $id = isset($_GET['id']) ? $_GET['id'] : 0;
                // for view old data in inputs
                $data = $product->searchById($id);

                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    $name = $_POST['name'];
                    $price = $_POST['price'];
                    $quantity = $_POST['quantity'];
                    $discount = $_POST['discount'];
                    $categories = $_POST['categories'];
                    $colors = $_POST['colors'];
                    $brand = $_POST['brand'];
                    $files = $_FILES['files'];
                    $cover_img = $_POST['cover'];
                    $description = $_POST['description'];
                    $btn = $_POST['submitBtn'];
                    if (isset($btn)) {
                        if (empty($name) || empty($price) || empty($quantity) || empty($categories) || empty($colors) || empty($brand) || empty($files)) {
                            echo "Fill all the fields!";
                        } else {
                            $colors = json_encode($colors);

                            $files = ($files == null) ? "" :  mergeJsonArrays($data['images_src'], $product->valilledImg($files, $name, $cover_img));
                            $product->editProduct($id, $name, $price, $quantity, $discount, $colors, $brand, $files, $description, $categories);
                        }
                    }
                }
                // for view old data in inputs
                $data = $product->searchById($id);
                // take tow jsons and return one 
                function mergeJsonArrays($json1, $json2)
                {

                    // Decode the JSON data into associative arrays
                    $array1 = json_decode($json1, true);
                    $array2 = json_decode($json2, true);
                    if (isset($array2['cover'])) {
                        if (isset($array1['cover'])) {
                            $cover = $array1['cover'];
                            unset($array1['cover']);
                            array_push($array1, $cover);
                        }
                    }


                    // Merge the arrays
                    $mergedArray = array_merge($array1, $array2);

                    // Encode the merged array back to JSON
                    $mergedJsonData = json_encode($mergedArray);

                    return $mergedJsonData;
                }
                ?>
            </div>
        </div>
        <!-- php -->

        <!-- Form Start -->
        <div class="container-fluid pt-4 px-4 ">
            <div class="col-sm-12 col-xl-6 mx-auto w-75">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4">Edit Product</h6>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="row g-4">
                            <div class="mb-2 col-sm-12 col-xl-6">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required value="<?= $data['name'] ?>">
                            </div>
                            <div class="mb-2 col-sm-12 col-xl-6">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" class="form-control" id="price" name="price" required value="<?= $data['price'] ?>">
                            </div>
                            <div class="mb-2 col-sm-12 col-xl-6">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" required value="<?= $data['quantity'] ?>">
                            </div>
                            <div class="mb-2 col-sm-12 col-xl-6">
                                <label for="discount" class="form-label">Discount</label>
                                <input type="number" class="form-control" id="discount" name="discount" required value="<?= $data['discount'] ?>">
                            </div>

                            <div class="mb-2 col-sm-12 col-xl-6">
                                <label for="item-select" class="form-label">Select categories</label>
                                <select class="form-select mb-2" id="item-select" name="categories[]" required multiple onchange="handleItemSelection()">
                                    <?php
                                    $category = new category;
                                    $array = $category->search();
                                    $selected_cats = $category->getCatByProductID($data['id']);
                                    print_r($selected_cats);
                                    foreach ($array as $cat) {
                                        if (in_array($cat['name'], array_column($selected_cats, 'name'))) {
                                            echo "<option value='$cat[id]' title='$cat[name]' selected>$cat[name]</option>";
                                        } else
                                            echo "<option value='$cat[id]' title='$cat[name]'>$cat[name]</option>";
                                    }
                                    ?>
                                </select>
                                <div id="badge-container">
                                    <?php

                                    foreach ($selected_cats as $val) {
                                        echo "
                                            <span class='badge badge-primary'>
                                            <span>$val[name]</span>
                                            <span class='badge-close'>&times;</span>
                                        </span>";
                                    }
                                    ?>

                                </div>
                            </div>
                            <div class="mb-2 col-sm-12 col-xl-6">
                                <label for="colors" class="form-label">Select colors</label>
                                <select class="form-select mb-2" id="colors" name="colors[]" required multiple onchange="handleColorsSelection()">
                                    <?php
                                    $myColors = ["aqua", "red", "green", "black", "white", "yellow", "blue", "gray"];
                                    $selected_colors = json_decode($data['colors']);
                                    foreach ($myColors as $val) {
                                        if (in_array($val, $selected_colors))
                                            echo "<option value='$val' selected>$val</option>";
                                        else echo "<option value='$val'>$val</option>";
                                    }
                                    ?>

                                </select>
                                <div id="colors-container">
                                    <?php
                                    foreach ($selected_colors as $val) {
                                        echo "
                                                <span class='color badge badge-primary' style='background-color: $val;'>
                                                <span></span>
                                                </span>";
                                    }
                                    ?>

                                </div>
                            </div>

                            <div class="mb-2 col-sm-12 col-xl-6">
                                <label for="brand" class="form-label">Select a brand</label>
                                <select class="form-select mb-2" name="brand" id="brand" required>
                                    <option selected>Select a brand</option>
                                    <?php
                                    $brand = new Brand;
                                    $result = $brand->search();
                                    foreach ($result as $val) {
                                        $selected_brand = $data['brand'];
                                        if ($selected_brand == $val['name'])
                                            echo "<option value='$val[name]' selected>$val[name]</option>";
                                        else
                                            echo "<option value='$val[name]'>$val[name]</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="mb-3 col-sm-12 col-xl-6">
                                <label for="file-input" class="form-label">Choose Product Images</label>
                                <input class="form-control bg-dark mb-3" type="file" name="files[]" id="file-input" accept="image/*" multiple>
                                <div id="image-container">
                                    <label>Choose the cover image</label><br>
                                    <?php
                                    $images = json_decode($data['images_src'], true);
                                    foreach ($images as $key => $val) {
                                        $selected_img = ($key == "cover") ? "checked" : "";
                                        echo "
                                            <div class='radio-image'>
                                            <img src='$val' alt='$val'>
                                            <input type='radio' name='cover' value='$val' $selected_img>
                                        </div>";
                                    }
                                    ?>
                                </div>
                            </div>

                        </div>

                        <div class="mb-3 ">
                            <label for="description" class="form-label">Write a brief description</label>
                            <textarea name="description" class="form-control bg-dark" id="description"><?= $data['description'] ?></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary" name="submitBtn">Edit</button>
                        <button type="reset" class="btn btn-primary">Cancle</button>
                    </form>
                </div>


            </div>
        </div>
        <!-- Form End -->


        <!-- Footer Start -->
        <div class="container-fluid pt-4 px-4">
            <div class="bg-secondary rounded-top p-4">
                <div class="row">
                    <div class="col-12 col-sm-6 text-center text-sm-start">
                        &copy; <a href="#">Your Site Name</a>, All Right Reserved.
                    </div>
                    <div class="col-12 col-sm-6 text-center text-sm-end">
                        <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                        Designed By <a href="https://htmlcodex.com">HTML Codex</a>
                        <br>Distributed By: <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->
    </div>
    <!-- Content End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>

<script src="js/myscript.js"></script>
<?php include "files/end.php" ?>