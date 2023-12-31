<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-secondary navbar-dark">
        <a href="index.php" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>DarkPan</h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                </div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">Jhon Doe</h6>
                <span>Admin</span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="index.php" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>

            <!--  -->
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa-solid fa-user me-2"></i>Users</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="#" class="dropdown-item">Home</a>
                    <a href="editUser.php" class="dropdown-item">Edit User</a>
                    <a href="#" class="dropdown-item">Delete User</a>
                    <a href="#" class="dropdown-item">Block User</a>
                </div>
            </div>
            <!--  -->

            <!--  -->
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa-solid fa-list me-2"></i>Categories</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="addCategory.php" class="dropdown-item">Add Category</a>
                    <a href="editCategory.php" class="dropdown-item">Edit Category</a>
                    <a href="deleteCategory.php" class="dropdown-item">Delete Category</a>
                </div>
            </div>
            <!--  -->

            <!--  -->
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa-solid fa-gift me-2"></i>Products</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="addProduct.php" class="dropdown-item">Add Product</a>
                    <a href="editProduct.php" class="dropdown-item">Edit Product</a>
                    <a href="deleteProduct.php" class="dropdown-item">Delete Product</a>
                </div>
            </div>
            <!--  -->
            <!--  -->
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa-solid fa-flag me-2"></i>Brands</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="addBrand.php" class="dropdown-item">Add Brand</a>
                    <a href="editBrand.php" class="dropdown-item">Edit Brand</a>
                    <a href="deleteBrand.php" class="dropdown-item">Delete Brand</a>
                </div>
            </div>
            <!--  -->


            <a href="table.php" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Tables</a>
            <a href="chart.php" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Charts</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Pages</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="signin.php" class="dropdown-item">Sign In</a>
                    <a href="signup.php" class="dropdown-item">Sign Up</a>
                    <a href="404.php" class="dropdown-item">404 Error</a>
                    <a href="blank.php" class="dropdown-item">Blank Page</a>
                </div>
            </div>
        </div>
    </nav>
</div>