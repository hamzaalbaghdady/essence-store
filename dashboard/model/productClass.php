
<?php
require_once "database.php";

class store
{
    // private $s_id;
    // private $s_name;
    // private $address;
    // private $phone_num;
    // private $rate;
    // private $cat_no;
    // private $img_src;

    // add store to database, no return value
    public function addStore($name, $address, $phone_num, $src, $cat_no)
    {
        try {
            $db = new Database;
            $conn = $db->conn;
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";
            $sql = $conn->prepare("INSERT INTO `store`( `s_name`, `address`, `phone_num`, `img_src`, `cat_no`)
             VALUES (:name,:address,:phone,:img,:cat);");
            // parameters
            $sql->bindParam(':name', $name);
            $sql->bindParam(':address', $address);
            $sql->bindParam(':phone', $phone_num);
            $sql->bindParam(':img', $src);
            $sql->bindParam(':cat', $cat_no);
            // execution
            $sql->execute();
            $sql2 = $conn->prepare("INSERT INTO `store_category`(`s_id`, `c_id`) VALUES (LAST_INSERT_ID(), :cid);");
            $sql2->bindParam(':cid', $cat_no);
            $sql2->execute();

            echo "New record created successfully";
        } catch (PDOException $ex) {
            echo "Connection failed: " . $ex->getMessage();
        }
        $conn = null;
    }

    // edit store in database, no return value
    public function editStore($id, $name, $address, $phone_num, $src, $cat_no)
    {
        try {
            $db = new Database;
            $conn = $db->conn;
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";
            $sql = $conn->prepare("UPDATE `store` s SET `s_name`=:name,`address`=:address,
            `phone_num`= :phone,`img_src`=:img,`cat_no`=:cat WHERE s.s_id=:id");
            // parameters

            $sql->bindParam(':id', $id);
            $sql->bindParam(':name', $name);
            $sql->bindParam(':address', $address);
            $sql->bindParam(':phone', $phone_num);
            $sql->bindParam(':img', $src);
            $sql->bindParam(':cat', $cat_no);
            // execution

            $sql->execute();
            echo "Record Edited successfully";
        } catch (PDOException $ex) {
            echo "Connection failed: " . $ex->getMessage();
        }
        $conn = null;
    }

    // edit only the rate attrbute in store table in database, no return value
    public function editRate($id, $rate)
    {
        try {
            $db = new Database;
            $conn = $db->conn;
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";
            $sql = $conn->prepare("UPDATE `store` s SET `rate`=:rate WHERE s.s_id=:id");
            // parameters
            $sql->bindParam(':id', $id);
            $sql->bindParam(':rate', $rate);

            // execution
            $sql->execute();
            echo "Record Edited successfully";
        } catch (PDOException $ex) {
            echo "Connection failed: " . $ex->getMessage();
        }
        $conn = null;
    }

    // deletes a specifec store based on id in database
    public function deleteStore($id)
    {
        try {
            $db = new Database;
            $conn = $db->conn;
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";
            $sql = $conn->prepare("DELETE FROM `store` WHERE s_id=:id;");
            $sql->bindParam(':id', $id, PDO::PARAM_INT);
            // use exec() because no results are returned
            $sql->execute();
            echo "Record Deleted successfully";
        } catch (PDOException $ex) {
            echo "Connection failed: " . $ex->getMessage();
        }
        $conn = null;
    }

    /*
        if parameter is set it select based on store name in data base 
        else it return all records in store table
    */
    public function search($name = "")
    {
        try {
            $db = new Database;
            $conn = $db->conn;
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";
            if ($name == "") {
                $sql = $conn->prepare("SELECT * FROM `store`;");
            } else {
                $sql = $conn->prepare("SELECT * FROM `store` s WHERE s.s_name like :name;");
                $name = '%' . $name . '%';
                $sql->bindParam(':name', $name, PDO::PARAM_STR);
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

    // search for a specifec store based on id in database
    public function searchById($id)
    {
        try {
            $db = new Database;
            $conn = $db->conn;
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";

            $sql = $conn->prepare("SELECT * FROM `store` s WHERE s_id = :id;");
            $sql->bindParam(':id', $id);


            $sql->execute();
            // set the resulting array to associative
            $result = $sql->setFetchMode(PDO::FETCH_ASSOC);
            $result = $sql->fetch();
            return $result;
        } catch (PDOException $ex) {
            echo "Connection failed: " . $ex->getMessage();
        }
        $conn = null;
    }
    // selsct all from store based on limit and offset 
    //limit:how many records, offset: start from record number ?
    public function limitedSearch(int $limit, int $offset)
    {
        try {
            $db = new Database;
            $conn = $db->conn;
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";
            $limit = (int) $limit;
            $offset = (int) $offset;
            $sql = $conn->prepare("SELECT * FROM `store` LIMIT :limit OFFSET :offset ;");
            $sql->bindParam(':limit',  $limit, PDO::PARAM_INT); // for int value
            $sql->bindParam(':offset', $offset, PDO::PARAM_INT);

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
    // overload for limitedSearch() but it select by category id
    public function searchByCat($id, int $limit, int $offset)
    {
        try {
            $db = new Database;
            $conn = $db->conn;
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";

            $sql = $conn->prepare("SELECT * FROM `store` s WHERE cat_no=:catId LIMIT :limit OFFSET :offset;");
            $sql->bindParam(':catId', $id);
            $sql->bindParam(':limit', $limit, PDO::PARAM_INT);
            $sql->bindParam(':offset', $offset, PDO::PARAM_INT);

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
    // return the number of records in store table
    public function storesCount()
    {
        try {
            $db = new Database;
            $conn = $db->conn;
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";
            $sql = $conn->prepare("SELECT COUNT(s_id) as count FROM `store`;");
            $sql->execute();
            // set the resulting array to associative
            $result = $sql->setFetchMode(PDO::FETCH_ASSOC);
            $result = $sql->fetch();
            return $result;
        } catch (PDOException $ex) {
            echo "Connection failed: " . $ex->getMessage();
        }
        $conn = null;
    }

    // return the number of records in store table based on category
    public function storesCountPerCat($catId)
    {
        try {
            $db = new Database;
            $conn = $db->conn;
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";
            $sql = $conn->prepare("SELECT COUNT(s_id) as count FROM `store` WHERE cat_no=:catId;");
            $sql->bindParam(':catId', $catId);
            $sql->execute();
            // set the resulting array to associative
            $result = $sql->setFetchMode(PDO::FETCH_ASSOC);
            $result = $sql->fetch();
            return $result;
        } catch (PDOException $ex) {
            echo "Connection failed: " . $ex->getMessage();
        }
        $conn = null;
    }
}


?>