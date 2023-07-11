<?php
require_once "database.php";

class Brand
{

    // add new category to database
    public function addBrand($name)
    {
        try {
            $db = new Database;
            $conn = $db->conn;
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";
            $sql = $conn->prepare("INSERT INTO `brand`(`name`) VALUES (:name);");
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
    public function editBrand($id, $name)
    {
        try {
            $db = new Database;
            $conn = $db->conn;
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";
            $sql = $conn->prepare("UPDATE `brand` b SET `name`=:name WHERE b.id=:id;");

            $sql->bindParam(':id', $id);
            $sql->bindParam(':name', $name);
            // no results return
            $sql->execute();
            echo "Record Edited successfully";
        } catch (PDOException $ex) {
            echo "Connection failed: " . $ex->getMessage();
        }
        $conn = null;
    }

    // delete  category in database
    public function deleteBrand($id)
    {
        try {
            $status = 'true';
            $db = new Database;
            $conn = $db->conn;
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";
            $sql = $conn->prepare("DELETE FROM `brand`  WHERE id=:id;");
            $sql->bindParam(':id', $id);
            // no results return
            $sql->execute();
            echo "Record Deleted successfully";
        } catch (PDOException $ex) {
            echo "Connection failed: " . $ex->getMessage();
            $status = 'false';
        }
        $conn = null;
        return  $status;
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
                $sql = $conn->prepare("SELECT * FROM `brand`;");
            } else {
                $sql = $conn->prepare("SELECT * FROM `brand` b WHERE b.id=:id;");
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
}
