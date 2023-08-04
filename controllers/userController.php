
<?php
require_once "../dashboard/model/userClass.php";
// log out
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['l'])) {
        session_start();
        // When the user logs out, unset the 'user' session variable
        unset($_SESSION['user']);

        // Destroy the session
        session_destroy();
        echo "logged out successfully";
        header("Location:../index.php");
    }
}

// save user dadta
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user = new user;
    if (isset($_POST['signupBtn'])) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        if (empty($fname) || empty($lname) || empty($email) || empty($pass)) {
            echo "Fill all the fields";
        } else {
            $user->createUser($fname, $lname, $pass, $email, 'Member', '');
            header("Location:../login.php?s=l");
        }
    } else if (isset($_POST['loginBtn'])) {
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        // $rm = $_POST['remembe_me'];
        if (empty($email) || empty($pass)) {
            echo "Fill all the fields";
        } else {
            if ($user->valliedUser($email, $pass)) {
                $data = $user->getUser($email);
                $stat = $data['status'];
                $id = $data['id'];
                if ($stat === "Blocked") {
                    header("Location:../Blocked_user.php?id=$id");
                } else {
                    session_start();
                    $_SESSION['user'] = $email;
                    header("Location:../index.php");
                }
            } else header("Location:../login.php?s=f");
        }
    } else echo "You are not allowed here mother fucker";
}
?>