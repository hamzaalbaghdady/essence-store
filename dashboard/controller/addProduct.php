<?PHP
// require_once "../model/productClass.php";

// // add new product
// if ($_SERVER['REQUEST_METHOD'] == "POST") {
//     $name = $_POST['name'];
//     $price = $_POST['price'];
//     $quantity = $_POST['quantity'];
//     $discount = $_POST['discount'];
//     $categories = $_POST['categories'];
//     $colors = $_POST['colors'];
//     $brand = $_POST['brand'];
//     $files = $_FILES['files'];
//     $cover_img = $_POST['cover'];
//     $description = $_POST['description'];
//     $btn = $_POST['submitBtn'];
//     if (isset($btn)) {
//         if (empty($name) || empty($price) || empty($quantity) || empty($categories) || empty($colors) || empty($brand) || empty($files))
//             echo "Fill all the fields!";
//         $product = new product();
//         $colors = json_encode($colors);
//         $files = $product->valilledImg($files, $name, $cover_img);
//         // to make it work you must change the return value to addProduct()
//         $status = $product->addProduct($name, $price, $quantity, $discount, $colors, $brand, $files, $description, $categories);
//     } else echo "Fill all the fields!";
// }

// // include "../view/addProduct.php";
// header("Location:../view/addProduct.php?s=$status");
