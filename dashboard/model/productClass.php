
<?php
require_once "database.php";

class product
{

    // add store to database, no return value
    public function addProduct($name, $price, $quntity, $discount, $colors, $brand, $images_src, $description, $categories)
    {
        try {
            $db = new Database;
            $conn = $db->conn;
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";
            $sql = $conn->prepare("INSERT INTO `products`(`name`, `price`, `quantity`, `discount`, `colors`, `brand`, `description`, `images_src`)
             VALUES (:name,:price,:quan,:discount,:colors,:brand,:descr,:src);");
            // parameters
            $sql->bindParam(':name', $name);
            $sql->bindParam(':price', $price);
            $sql->bindParam(':quan', $quntity);
            $sql->bindParam(':discount', $discount);
            $sql->bindParam(':colors', $colors);
            $sql->bindParam(':brand', $brand);
            $sql->bindParam(':descr', $description);
            $sql->bindParam(':src', $images_src);
            // execution
            $sql->execute();
            $last_id = $conn->lastInsertId();
            // begin the transaction
            $conn->beginTransaction();
            foreach ($categories as $cat) {
                $conn->exec("INSERT INTO `product_category`(`product_id`, `category_id`) VALUES ($last_id, $cat);");
            }
            // commit the transaction
            $conn->commit();

            echo "New record created successfully";
        } catch (PDOException $ex) {
            echo "Connection failed: " . $ex->getMessage();
        }
        $conn = null;
    }

    function valilledImg($Files, $name)
    {
        $array = array();
        //$Files['name'] to get number of uploaded files
        foreach ($Files['name'] as $num => $file) {
            $fileName = $Files['name'][$num];
            $fileSize = $Files['size'][$num];
            $file_tmp = $Files['tmp_name'][$num];
            $fileType = $Files['type'][$num];
            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $uploadOk = 1;
            // Check file size
            if ($fileSize > 500000) {
                echo "Sorry, your file is too large. file name = $fileName";
                $uploadOk = 0;
            }

            // Allow certain file formats
            if (
                $fileExt != "jpg" && $fileExt != "png" && $fileExt != "jpeg" && $fileExt != "gif"
            ) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }

            if ($uploadOk == 1) {
                $fileNewName = $name . " (" . $num . ")" . strval(time() + rand(1, 10000)) . ".$fileExt";
                $uploadPath = "uploads/" . $fileNewName;
                $array[] = $uploadPath;
                move_uploaded_file($file_tmp, $uploadPath);
                echo "file number $num has been uploaded successfully!";
            }
        }
        return json_encode($array);
    }

    // edit store in database, no return value
    public function editProduct($id, $name, $price, $quntity, $discount, $colors, $brand, $images_src, $description, $cat_no)
    {
        try {
            $db = new Database;
            $conn = $db->conn;
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";
            $sql = $conn->prepare("UPDATE `products` p SET `name`=:name, `price`=:price, `quantity`=:quan, `discount`=:discount, `colors`=:colors, `brand`=:brand, `description`=:descr, `images_src`=:src WHERE p.id=:id;");
            // parameters

            $sql->bindParam(':id', $id, pdo::PARAM_INT);
            $sql->bindParam(':name', $name);
            $sql->bindParam(':price', $price, pdo::PARAM_INT);
            $sql->bindParam(':quan', $quntity, pdo::PARAM_INT);
            $sql->bindParam(':discount', $discount, pdo::PARAM_INT);
            $sql->bindParam(':colors', $colors);
            $sql->bindParam(':brand', $brand);
            $sql->bindParam(':descr', $description);
            $sql->bindParam(':src', $images_src);
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
            $sql = $conn->prepare("UPDATE `products` s SET `rate`=:rate WHERE s.s_id=:id");
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
    public function deleteProduct($id)
    {
        try {
            $db = new Database;
            $conn = $db->conn;
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";
            $sql = $conn->prepare("DELETE FROM `products` WHERE id=:id;");
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
                $sql = $conn->prepare("SELECT * FROM `products`;");
            } else {
                $sql = $conn->prepare("SELECT * FROM `products` p WHERE p.name like :name;");
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

            $sql = $conn->prepare("SELECT * FROM `products` p WHERE id = :id;");
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
            $sql = $conn->prepare("SELECT * FROM `products` LIMIT :limit OFFSET :offset ;");
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
    public function ProductsCount()
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
    public function ProductsCountPerCat($catId)
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