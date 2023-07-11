<?php
session_start();
require "../model/categoryClass.php";
$category = new Category;
$id = $_GET['id'];
$status = $category->deleteCat($id);

header("Location:../view/table.php?deleted=$status");
exit;
