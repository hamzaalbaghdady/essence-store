<?php
require_once "../model/productClass.php";
$product = new product;
$id = $_GET['id'];

$status = $product->deleteProduct($id);
header("location:../view/table.php?deleted=$status");
exit;
