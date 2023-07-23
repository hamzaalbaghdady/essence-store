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
            $status = "true";
        } catch (PDOException $ex) {
            echo "Error:  " . $ex->getMessage();
            $status = "false";
        }
        $conn = null;
        return $status;
    }



    // delete  product from favorites
    public function delete($id)
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
            echo "Error:  " . $ex->getMessage();
        }
        $conn = null;
    }

    /*
    if id is set it returns only one record for specifec category id
    else it returns all categories in category table
    */
    public function getAll($user_id, $product_id = "")
    {
        try {
            $db = new Database;
            $conn = $db->conn;
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";
            if ($product_id != "") {
                $sql = $conn->prepare("SELECT * FROM `favorites` WHERE user_id=:uid AND product_id=:pid ORDER by id DESC;");
                $sql->bindParam(':uid', $user_id);
                $sql->bindParam(':pid', $product_id);
            } else {
                $sql = $conn->prepare("SELECT * FROM `favorites` WHERE user_id=:uid ORDER by id DESC;");
                $sql->bindParam(':uid', $user_id);
            }


            $sql->execute();
            // set the resulting array to associative
            $result = $sql->setFetchMode(PDO::FETCH_ASSOC);
            $result = $sql->fetchAll();
            return $result;
        } catch (PDOException $ex) {
            echo "Error:  " . $ex->getMessage();
        }
        $conn = null;
    }
}
