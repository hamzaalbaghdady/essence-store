<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // if (isset($_POST['Search'])) {
    $search = $_POST['search'];
    $field = $_POST['field'];
    echo "Field is : " . $_POST['field'] . " " . "Search is: " . $_POST['search'];
    switch ($field) {
        case 'x';
            header("location:index.php");
            break;
        case 'Users';
            header("location:table.php#u");
            break;
        case 'Products';
            header("location:../../search.php?search=$search");
            break;
        case 'Categories';
            header("location:table.php#c");
            break;
        case 'Brands';
            header("location:table.php#b");
            break;
    }
    // }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    echo "Field is : " . $_POST['field'] . " " . "Search is: " . $_POST['search'];
    ?>
</body>

</html>