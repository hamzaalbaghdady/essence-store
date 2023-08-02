<?PHP
session_start();
session_destroy();
session_unset();
header("Location:../view/signin.php");
exit;
