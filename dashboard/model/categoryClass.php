<?php
require_once "database.php";

class Category
{

    // add new category to database
    public function addCat($name)
    {
        try {
            $db = new Database;
            $conn = $db->conn;
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";
            $sql = $conn->prepare("INSERT INTO `categories`(`name`) VALUES (:name);");
            $sql->bindParam(':name', $name);
            // no results return
            $sql->execute();
            echo "New record created successfully";
        } catch (PDOException $ex) {
            echo "Connection failed: " . $ex->getMessage();
        }
        $conn = null;
    }

    // edit  category in database
    public function editCat($id, $name)
    {
        try {
            $status = 'true';
            $db = new Database;
            $conn = $db->conn;
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";
            $sql = $conn->prepare("UPDATE `categories` c SET `name`=:name WHERE c.id=:id;");

            $sql->bindParam(':id', $id);
            $sql->bindParam(':name', $name);
            // no results return
            $sql->execute();
            echo "Record Edited successfully";
        } catch (PDOException $ex) {
            echo "Connection failed: " . $ex->getMessage();
            $status = 'false';
        }
        $conn = null;
        return $status;
    }

    // delete  category in database
    public function deleteCat($id)
    {
        try {
            $status = 'true';
            $db = new Database;
            $conn = $db->conn;
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";
            $sql = $conn->prepare("DELETE FROM `categories`  WHERE id=:id;");
            $sql->bindParam(':id', $id);
            // no results return
            $sql->execute();
            echo "Record Deleted successfully";
        } catch (PDOException $ex) {
            echo "Connection failed: " . $ex->getMessage();
            $status = 'false';
        }
        $conn = null;
        return $status;
    }

    /*
    if id is set it returns only one record for specifec category id
    else it returns all categories in category table
    */
    public function search($id = "")
    {
        try {
            $db = new Database;
            $conn = $db->conn;
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";
            if ($id == "") {
                // return only one record
                $sql = $conn->prepare("SELECT * FROM `categories`;");
            } else {
                $sql = $conn->prepare("SELECT * FROM `categories` c WHERE c.id=:id;");
                $sql->bindParam(':id', $id);
            }
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

    // returns an array of categoris names for single product by its id
    public function getCatByProductID($id)
    {
        try {
            $db = new Database;
            $conn = $db->conn;
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";

            $sql = $conn->prepare("SELECT c.name, pc.id, pc.category_id, pc.product_id 
            FROM products p
            JOIN product_category pc ON p.id = pc.product_id
            JOIN categories c ON pc.category_id = c.id WHERE p.id=:id;");
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
