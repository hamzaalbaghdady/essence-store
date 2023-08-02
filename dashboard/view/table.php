<?php

require_once "../model/categoryClass.php";
require_once "../model/brandClass.php";

$brand = new Brand;
$category = new Category;
?>
<?php include "files/head.php" ?>

<style>
    td .fa-solid {
        color: #EB1616;
    }

    td .fa-solid:hover {
        color: #a30808;
    }

    td {
        white-space: nowrap;
        /* Prevent text wrapping */
        overflow: hidden;
        text-overflow: ellipsis;
        min-width: 70px;
        max-width: 100px;
    }

    .x {
        overflow-y: scroll;
        max-height: 400px !important;
    }

    .x::-webkit-scrollbar {
        width: 5px;
        height: 5px;
    }

    table {
        text-align: center;
    }
</style>

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


        <!-- Table Start -->
        <div class="container-fluid pt-4 px-4" id="u">
            <div class="row g-4">
                <div class="col-12">
                    <div class="bg-secondary rounded h-100 p-4">
                        <h6 class="mb-4">Users Table</h6>
                        <div class="table-responsive x">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">First Name</th>
                                        <th scope="col">Last Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $users = $user->getALL();
                                    foreach ($users as $u) {
                                        echo "<tr>
                                                <td>$u[id]</td>
                                                <td>$u[f_name]</td>
                                                <td>$u[l_name]</td>
                                                <td>$u[email]</td>
                                                <td>$u[status]</td>
                                                
                                                <td><a href='#'><i class='fa-solid fa-pen-to-square me-2' title='Edit'></i></a> 
                                                <a onclick='alert_confirm(\"#\")'><i class='fa-solid fa-trash-can me-2' title='Delete'></i></a>
                                                <a href='#'><i class='fa-solid fa-shield me-2' title='Block'></i></a>
                                                <a href='#'><i class='fa-solid fa-circle-info me-2' title='Info'></i></a>
                                                </td>
                                                </tr>";
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Table End -->


        <!-- Table Start -->
        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                <div class="col-12">
                    <div class="bg-secondary rounded h-100 p-4">
                        <h6 class="mb-4">Products Table</h6>
                        <div class="table-responsive x">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Discount</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Rate</th>
                                        <th scope="col">Brand</th>
                                        <th scope="col">Categories</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Colors</th>
                                        <th scope="col">Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $p_result = $product->search();
                                    foreach ($p_result as $val) {

                                        $cats = $category->getCatByProductID($val['id']);
                                        $categories = array_column($cats, 'name'); // to convert assoc_array to Indexed_array
                                        $categories_Json = empty($categories) ? 'Null' : json_encode($categories); // convert array to json

                                        echo "<tr>
                                                <td>$val[id]</td>
                                                <td title='$val[name]'>$val[name]</td>
                                                <td>$val[price]$</td>
                                                <td>$val[discount]</td>
                                                <td>$val[quantity]</td>
                                                <td>$val[rate]</td>
                                                <td>$val[brand]</td>
                                                <td title='$categories_Json'>$categories_Json</td>
                                                <td>$val[date_of_additon]</td>
                                                <td title='$val[colors]'>$val[colors]</td>
                                                <td><a href='editProduct.php?id=$val[id]'><i class='fa-solid fa-pen-to-square me-2' title='Edit'></i></a> 
                                                <a onclick='alert_confirm(\"deleteProduct.php?id=$val[id]\")'><i class='fa-solid fa-trash-can me-2' title='Delete'></i></a>
                                                <a href='../../productDetails.php?id=$val[id]'><i class='fa-solid fa-eye' title='View'></i></a></td>
                                                </tr>";
                                    }
                                    ?>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Table End -->

        <!-- Recent Sales Start -->
        <div class="container-fluid pt-4 px-4">
            <div class="bg-secondary text-center rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Recent Salse</h6>
                </div>
                <div class="table-responsive x">
                    <table class="table text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr class="text-white">
                                <th scope="col">ID</th>
                                <th scope="col">User ID</th>
                                <th scope="col">Product ID</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sales_r = $sales->getAll();
                            foreach ($sales_r as $val) {
                                $p_name = $product->searchById($val['product_id']);
                                $p_name = $p_name['name'];
                                echo "
                                    <tr>
                                    <td>$val[id]</td>
                                    <td>$val[user_id]</td>
                                    <td>$val[product_id]</td>
                                    <td>$val[amount]</td>
                                    <td>$val[dateTime_Of_operation]</td>
                                    </tr>
                                    ";
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Recent Sales End -->


        <!-- Table Start -->
        <div class="container-fluid pt-4 px-4" id="c">
            <div class="row g-4">
                <div class="col-sm-12 col-xl-6">
                    <div class="bg-secondary rounded h-100 p-4 x">
                        <h6 class="mb-4">Categories Table</h6>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Count</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $c_result = $category->search();
                                foreach ($c_result as $val) {
                                    $c_count = count($product->ProductsPerCategory($val['id']));
                                    $delete = ($c_count > 0) ? "alert_error()" : "alert_confirm(\"deleteCategory.php?id=$val[id]\")";
                                    echo "<tr>
                                            <th>$val[id]</th>
                                            <td>$val[name]</td>
                                            <td>$c_count</td>
                                            <td><a href='editCategory.php?id=$val[id]'><i class='fa-solid fa-pen-to-square me-2' title='Edit'></i></a>
                                            <a onclick='$delete'><i class='fa-solid fa-trash-can me-2' title='Delete'></i></a></td>
                                            </tr>";
                                }
                                ?>


                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-sm-12 col-xl-6" id="b">
                    <div class="bg-secondary rounded h-100 p-4 x">
                        <h6 class="mb-4">Brands Table</h6>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Count</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $b_result = $brand->search();
                                foreach ($b_result as $val) {
                                    $b_count = count($product->ProductsPerBrand($val['name']));
                                    echo "<tr>
                                            <th>$val[id]</th>
                                            <td>$val[name]</td>
                                            <td>$b_count</td>
                                            <td><a href='editBrand.php?id=$val[id]'><i class='fa-solid fa-pen-to-square me-2' title='Edit'></i></a> 
                                            <a onclick='alert_confirm(\"deleteBrand.php?id=$val[id]\")'><i class='fa-solid fa-trash-can me-2' title='Delete'></i></a></td>
                                            </tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        <!-- Table End -->



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
<script>
    function alert_confirm(url) {

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '../controller/' + url;
                // Swal.fire(
                //     'Deleted!',
                //     'Your file has been deleted.',
                //     'success'
                // )
            }
        })
    }

    function alert_error() {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'You can not delete a category with any product. ',
        })
    }

    // Call the function when the page is loaded
    window.addEventListener('DOMContentLoaded', alert_delete);

    function alert_delete() {
        const search = window.location.search;
        if (search === '?deleted=true') {
            Swal.fire({
                icon: 'success',
                title: 'Deleted',
                text: 'The item has been deleted successfully.',
            })
        } else if (search === '?deleted=false') {
            Swal.fire({
                icon: 'error',
                title: 'Erorr',
                text: 'Erorr: The item was not deleted successfully!',
            })
        }
    }
</script>
<?php include "files/end.php" ?>