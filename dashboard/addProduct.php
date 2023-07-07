<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Add Product</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- My Stylesheet -->
    <link href="css/myStyle.css" rel="stylesheet">
</head>

<body>
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


            <!-- Form Start -->
            <div class="container-fluid pt-4 px-4 ">
                <div class="col-sm-12 col-xl-6 mx-auto w-75">
                    <div class="bg-secondary rounded h-100 p-4">
                        <h6 class="mb-4">Add New Product</h6>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="row g-4">
                                <div class="mb-2 col-sm-12 col-xl-6">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>
                                <div class="mb-2 col-sm-12 col-xl-6">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="number" class="form-control" id="price" name="price">
                                </div>
                                <div class="mb-2 col-sm-12 col-xl-6">
                                    <label for="quantity" class="form-label">Quantity</label>
                                    <input type="number" class="form-control" id="quantity" name="quantity">
                                </div>
                                <div class="mb-2 col-sm-12 col-xl-6">
                                    <label for="discount" class="form-label">Discount</label>
                                    <input type="number" class="form-control" id="discount" name="discount">
                                </div>

                                <div class="mb-2 col-sm-12 col-xl-6">
                                    <label for="item-select" class="form-label">Select categories</label>
                                    <select class="form-select mb-2" id="item-select" name="categories[]" multiple onchange="handleItemSelection()">
                                        <option value="1" title="One">One</option>
                                        <option value="2" title="Two">Two</option>
                                        <option value="3" title="Three">Three</option>
                                    </select>
                                    <div id="badge-container"></div>
                                </div>
                                <div class="mb-2 col-sm-12 col-xl-6">
                                    <label for="colors" class="form-label">Select colors</label>
                                    <select class="form-select mb-2" id="colors" name="colors[]" multiple onchange="handleColorsSelection()">
                                        <option value="aqua">aqua</option>
                                        <option value="red">red</option>
                                        <option value="green">green</option>
                                        <option value="black">black</option>
                                        <option value="white">white</option>
                                        <option value="yellow">yellow</option>
                                        <option value="blue">blue</option>
                                        <option value="gray">gray</option>
                                        <option value="transparent">Other</option>
                                    </select>
                                    <div id="colors-container"></div>
                                </div>

                                <div class="mb-2 col-sm-12 col-xl-6">
                                    <label for="brand" class="form-label">Select a brand</label>
                                    <select class="form-select mb-2" name="brand" id="brand">
                                        <option selected>Select a brand</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>

                                <div class="mb-3 col-sm-12 col-xl-6">
                                    <label for="file-input" class="form-label">Choose Product Images</label>
                                    <input class="form-control bg-dark mb-3" type="file" name="files[]" id="file-input" accept="image/*" multiple>
                                    <div id="image-container"></div>
                                </div>

                            </div>

                            <div class="mb-3 ">
                                <label for="description" class="form-label">Write a brief description</label>
                                <textarea name="description" class="form-control bg-dark" id="description"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary" name="submitBtn">Add</button>
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

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>