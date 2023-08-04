<?php
require_once "../model/userClass.php";
$user = new user;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $user->deleteUser($id);
    header("Location:../view/table.php");
}
