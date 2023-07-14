<?php
require_once "database.php";

class Favorites
{

    // add product to favorites
    public function addToFav($user_id, $product_id)
    {
        try {
            $db = new Database;
            $conn = $db->conn;
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";
            $sql = $conn->prepare("INSERT INTO `favorites`(`product_id`, `user_id`) VALUES (:p_id, :u_id);");
            $sql->bindParam(':p_id', $product_id, PDO::PARAM_INT);
            $sql->bindParam(':u_id', $user_id, PDO::PARAM_INT);
            // no results return
            $sql->execute();
        } catch (PDOException $ex) {
            echo "Connection failed: " . $ex->getMessage();
        }
        $conn = null;
    }



    // delete  product from favorites
    public function deleteCat($id)
    {
        try {
            $db = new Database;
            $conn = $db->conn;
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";
            $sql = $conn->prepare("DELETE FROM `favorites` WHERE id=:id;");
            $sql->bindParam(':id', $id);
            // no results return
            $sql->execute();
        } catch (PDOException $ex) {
            echo "Connection failed: " . $ex->getMessage();
        }
        $conn = null;
    }

    /*
    if id is set it returns only one record for specifec category id
    else it returns all categories in category table
    */
    public function getAll()
    {
        try {
            $db = new Database;
            $conn = $db->conn;
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";

            $sql = $conn->prepare("SELECT * FROM `favorites`;");
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
