<?php include "files/head.php";
$user_id = $_GET['id'];
$data = $user->getUserById($user_id)
?>
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
            <div>
                <?php
                function alert($message, $type)
                {
                    echo "<div class='alert alert-$type w-50 mx-auto my-3' role='alert'>
                            $message
                          </div>";
                }

                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    if (isset($_POST['submitBtn'])) {
                        $email = $_POST['email'];
                        $f_name = $_POST['f_name'];
                        $l_name = $_POST['l_name'];
                        $info = $data['info'];
                        if (empty($email) || empty($f_name) || empty($l_name))
                            alert("Fill all the fields!", "danger");
                        else if (filter_var($email, FILTER_VALIDATE_EMAIL) === false)
                            alert("Unvalide email!", "danger");
                        else {
                            $user->editUser($user_id, $f_name, $l_name, $email, $info);
                            alert("User has been Editted successfully", "success");
                        }
                    }
                }
                $data = $user->getUserById($user_id)
                ?>
            </div>
            <div class="col-sm-12 col-xl-6 mx-auto w-50">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4">Edit User</h6>
                    <form action="" method="POST">
                        <div class="mb-3 row">
                            <div class="col-6"> <label for="fname" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="fname" name="f_name" value="<?= $data['f_name'] ?>">
                            </div>
                            <div class="col-6"> <label for="lname" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lname" name="l_name" value="<?= $data['l_name'] ?>">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= $data['email']  ?>">
                        </div>
                        <div class="mb-3">
                            <label for="pass" class="form-label">Password</label>
                            <input type="text" class="form-control" id="pass" name="pass" value="<?= $data['pass']  ?>" disabled>
                        </div>

                        <button type="submit" name="submitBtn" class="btn btn-primary">Edit</button>
                        <a href="table.php" class="btn btn-primary">Cancle</a>
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