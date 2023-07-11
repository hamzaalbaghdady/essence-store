<?php
require_once "../model/brandClass.php";

$id = $_GET['id'];
$brand = new Brand;
$status = $brand->deleteBrand($id);
header("location:../view/table.php?deleted=$status");
exit;
