<?php
require_once "database.php";

class Cart
{

    // add new cart item to database
    public function addToCart($product_id, $user_id, $color, $size)
    {
        try {
            $db = new Database;
            $conn = $db->conn;
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";
            $sql = $conn->prepare("INSERT INTO `cart`(`product_id`, `user_id`, `color`, `size`) VALUES (:p_id,:u_id,:color,:size)");
            $sql->bindParam(':p_id', $product_id);
            $sql->bindParam(':u_id', $user_id);
            $sql->bindParam(':color', $color);
            $sql->bindParam(':size', $size);
            // no results return
            $sql->execute();
            $status = "true";
        } catch (PDOException $ex) {
            // echo "Connection failed: " . $ex->getMessage();
            $status = "false";
        }
        $conn = null;
        return $status;
    }


    // delete  item from cart
    public function deleteFromCart($id)
    {
        try {
            $db = new Database;
            $conn = $db->conn;
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";
            $sql = $conn->prepare("DELETE FROM `cart` WHERE id=:id;");
            $sql->bindParam(':id', $id);
            // no results return
            $sql->execute();
            echo "Record Deleted successfully";
        } catch (PDOException $ex) {
            echo "Connection failed: " . $ex->getMessage();
        }
        $conn = null;
    }

    // return all cart items for a spicefic user based on id
    public function getCartItems($id)
    {
        try {
            $db = new Database;
            $conn = $db->conn;
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";

            $sql = $conn->prepare("SELECT * FROM `cart` c WHERE c.user_id=:id;");
            $sql->bindParam(':id', $id);

            $sql->execute();
            // set the resulting array to associative
            $result = $sql->setFetchMode(PDO::FETCH_ASSOC);
            $result = $sql->fetchAll();
            return $result;
        } catch (PDOException $ex) {
            echo "Connection failed: " . $ex->getMessage();
        }
        $conn = null;
    }
}
