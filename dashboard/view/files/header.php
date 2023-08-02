<head>
    <!-- Favicon  -->
    <!-- <link rel="icon" href="../img/core-img/favicon.ico"> -->
    <link rel="icon" href="../img/core-img/favicon.ico">
    <style>
        /* scrollbar  */
        ::-webkit-scrollbar {
            width: 7px;
        }

        ::-webkit-scrollbar-track {
            background: white;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: #EB1616;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #a30808;

        }

        /* ***************** */
    </style>
</head>
<nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
    <a href="index.php" class="navbar-brand d-flex d-lg-none me-4">
        <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
    </a>
    <a href="#" class="sidebar-toggler flex-shrink-0">
        <i class="fa fa-bars"></i>
    </a>
    <form class="d-none d-md-flex ms-4" action="test.php" method="post" title="Press Enter to search">
        <input class="form-control bg-dark border-0 me-1" type="search" placeholder="Search" name="search">
        <select name="field" class="form-select w-25">
            <option selected value="x">Field</option>
            <option value="Users">Users</option>
            <option value="Products">Products</option>
            <option value="Categories">Categories</option>
            <option value="Brands">Brands</option>
        </select>
    </form>

    <div class="navbar-nav align-items-center ms-auto">
        <div class="nav-item">
            <button id="mode-toggle" class="nav-link" style="background-color: transparent;border: none;"><i class="fa-regular fa-sun"></i></button>
        </div>

        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <i class="fa fa-envelope me-lg-2"></i>
                <span class="d-none d-lg-inline-flex">Message</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                <?php
                require_once "../model/userClass.php";
                $u = new user;

                $messages = $u->getMessages(3);
                foreach ($messages as $message) {
                    $date_time = $u->getTimeDifference($message['date_time']);
                    echo "
                    <a href='messages.php' class='dropdown-item'>
                        <div class='d-flex align-items-center'>
                            <img class='rounded-circle' src='img/enduser.jpg' alt='' style='width: 40px; height: 40px;'>
                            <div class='ms-2'>
                                <h6 class='fw-normal mb-0'>$message[email]</h6>
                                <small>$date_time</small>
                            </div>
                        </div>
                    </a>
                    <hr class='dropdown-divider'>";
                }
                ?>

                <a href="messages.php" class="dropdown-item text-center">See all message</a>
            </div>
        </div>
        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <i class="fa fa-bell me-lg-2"></i>
                <span class="d-none d-lg-inline-flex">Notificatin</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                <a href="#" class="dropdown-item">
                    <h6 class="fw-normal mb-0">Profile updated</h6>
                    <small>15 minutes ago</small>
                </a>
                <hr class="dropdown-divider">
                <a href="#" class="dropdown-item">
                    <h6 class="fw-normal mb-0">New user added</h6>
                    <small>15 minutes ago</small>
                </a>
                <hr class="dropdown-divider">
                <a href="#" class="dropdown-item">
                    <h6 class="fw-normal mb-0">Password changed</h6>
                    <small>15 minutes ago</small>
                </a>
                <hr class="dropdown-divider">
                <a href="#" class="dropdown-item text-center">See all notifications</a>
            </div>
        </div>
        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <img class="rounded-circle me-lg-2" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                <span class="d-none d-lg-inline-flex">John Doe</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                <a href="#" class="dropdown-item">My Profile</a>
                <a href="#" class="dropdown-item">Settings</a>
                <a href="../controller/logout.php" class="dropdown-item">Log Out</a>
            </div>
        </div>

    </div>
</nav>