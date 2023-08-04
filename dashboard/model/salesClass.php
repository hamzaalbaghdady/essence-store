<?php
require_once "database.php";

class Sale
{

    // add new cart item to database
    public function addSale($product_id, $user_id, $amount)
    {
        try {
            $db = new Database;
            $conn = $db->conn;
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";
            $sql = $conn->prepare("INSERT INTO `sales`(`user_id`, `product_id`, `amount`) 
            VALUES (:u_id, :p_id, :amount);");
            $sql->bindParam(':p_id', $product_id);
            $sql->bindParam(':u_id', $user_id);
            $sql->bindParam(':amount', $amount);
            // no results return
            $sql->execute();
            $status = "true";
        } catch (PDOException $ex) {
            // echo "Error:  " . $ex->getMessage();
            $status = "false";
        }
        $conn = null;
        return $status;
    }


    // return all cart items for a spicefic user based on id
    public function getAll()
    {
        try {
            $db = new Database;
            $conn = $db->conn;
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";

            $sql = $conn->prepare("SELECT * FROM `sales` ORDER by id DESC LIMIT 15;");
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
    public function review($user_id, $product_id)
    {
        try {
            $db = new Database;
            $conn = $db->conn;
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";

            $sql = $conn->prepare("SELECT * FROM `sales` s WHERE s.user_id= :u_id AND s.product_id= :p_id  LIMIT 1;");
            $sql->bindParam(':p_id', $product_id);
            $sql->bindParam(':u_id', $user_id);
            $sql->execute();

            // set the resulting array to associative
            $result = $sql->setFetchMode(PDO::FETCH_ASSOC);
            $result = $sql->fetch();
        } catch (PDOException $ex) {
            echo "Error:  " . $ex->getMessage();
        }
        $conn = null;
        if ($result == null)
            return false;
        else return true;
    }
    // return all cart items for a spicefic user based on id
    public function getSalesSum($date = '')
    {
        try {
            $db = new Database;
            $conn = $db->conn;
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";
            if ($date == '') {
                $sql = $conn->prepare("SELECT sum(amount) AS 'sum' FROM `sales`");
            } else {
                $date = date('Y-m-d');
                $sql = $conn->prepare("SELECT sum(amount) AS 'sum' FROM `sales` WHERE dateTime_Of_operation= '$date'");
            }

            $sql->execute();

            // set the resulting array to associative
            $result = $sql->setFetchMode(PDO::FETCH_ASSOC);
            $result = $sql->fetch();
            return $result['sum'];
        } catch (PDOException $ex) {
            echo "Error:  " . $ex->getMessage();
        }
        $conn = null;
    }
}
