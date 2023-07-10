<?php
session_start();
require "../model/categoryClass.php";
$category = new Category;
$id = $_GET['id'];
$status = $category->deleteCat($id);
$_SESSION['del_stat'] = true;
header("Location:../view/table.php");
exit;
