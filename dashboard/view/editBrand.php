<?php
require_once "../model/brandClass.php";
?>
<?php include "files/head.php" ?>
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
                $brand = new Brand;
                // add new product
                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    $name = $_POST['name'];
                    $id = $_GET['id'];
                    $btn = $_POST['submitBtn'];
                    if (isset($btn)) {
                        if (empty($name))
                            echo "Fill all the fields!";
                        $brand->editBrand($id, $name);
                    } else echo "Fill all the fields!";
                }
                $id = isset($_GET['id']) ? $_GET['id'] : null;
                $result = $brand->search($id);
                ?>
            </div>
        </div>
        <!-- php -->

        <!-- Form Start -->
        <div class="container-fluid pt-4 px-4 ">
            <div class="col-sm-12 col-xl-6 mx-auto w-75">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4">Edit Brand</h6>
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= $result[0]['name'] ?>">

                        </div>

                        <button type="submit" name="submitBtn" class="btn btn-primary">Edit</button>
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

<?php include "files/end.php" ?>