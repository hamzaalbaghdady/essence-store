
<?php
require_once "database.php";
class user
{
    private $u_id;
    private $u_name;
    private $email;
    private $pass;



    /* function to vallidate if the user exist in database
        its take tow argemnts 'email' and 'pass' then return the status
    */
    public function valliedUser($email, $pass)
    {
        try {
            $db = new Database;
            $conn = $db->conn;
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = $conn->prepare("SELECT u.pass FROM `users` u WHERE u.email=:email;");
            $sql->bindParam(':email', $email);
            $sql->execute();
            // set the resulting array to associative
            $result = $sql->setFetchMode(PDO::FETCH_ASSOC);
            $result = $sql->fetch();
            // return $result;
        } catch (PDOException $ex) {
            echo "Error:  " . $ex->getMessage();
        }
        $conn = null;
        if (password_verify($pass, $result['pass']))
            return true;
        else return false;
    }
    public function userExists($email)
    {
        try {
            $db = new Database;
            $conn = $db->conn;
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = $conn->prepare("SELECT u.email FROM `users` u WHERE u.email=:email;");
            $sql->bindParam(':email', $email);
            $sql->execute();
            // set the resulting array to associative
            $result = $sql->setFetchMode(PDO::FETCH_ASSOC);
            $result = $sql->fetch();
        } catch (PDOException $ex) {
            echo "Error:  " . $ex->getMessage();
        }
        $conn = null;

        if ($result == false)
            return false;
        else return true;
    }
    public function createUser($fname, $lname, $pass, $email, $status, $info)
    {
        try {
            $db = new Database;
            $conn = $db->conn;
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = $conn->prepare("INSERT INTO `users`(`f_name`, `l_name`, `email`, `pass`, `info`, `status`)
             VALUES (:fname, :lname, :email, :pass, :info, :status);");
            if ($pass != "")
                $pass = password_hash($pass, PASSWORD_DEFAULT);
            else $pass = "Unset";
            $sql->bindParam(':fname', $fname);
            $sql->bindParam(':lname', $lname);
            $sql->bindParam(':email', $email);
            $sql->bindParam(':pass', $pass);
            $sql->bindParam(':info', $info);
            $sql->bindParam(':status', $status);
            $sql->execute();
        } catch (PDOException $ex) {
            echo "Error:  " . $ex->getMessage();
        }
        $conn = null;
    }
    public function getUser($email)
    {
        try {
            $db = new Database;
            $conn = $db->conn;
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = $conn->prepare("SELECT * FROM `users` u WHERE u.email=:email;");
            $sql->bindParam(':email', $email);

            $sql->execute();
            // set the resulting array to associative
            $result = $sql->setFetchMode(PDO::FETCH_ASSOC);
            $result = $sql->fetch();
            return $result;
        } catch (PDOException $ex) {
            echo "Error:  " . $ex->getMessage();
        }
        $conn = null;
    }
    public function getUserById($id)
    {
        try {
            $db = new Database;
            $conn = $db->conn;
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = $conn->prepare("SELECT * FROM `users` u WHERE u.id=:id;");
            $sql->bindParam(':id', $id);

            $sql->execute();
            // set the resulting array to associative
            $result = $sql->setFetchMode(PDO::FETCH_ASSOC);
            $result = $sql->fetch();
            return $result;
        } catch (PDOException $ex) {
            echo "Error:  " . $ex->getMessage();
        }
        $conn = null;
    }
    public function getALL()
    {
        try {
            $db = new Database;
            $conn = $db->conn;
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = $conn->prepare("SELECT * FROM `users`;");
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
    public function updateStatus($id, $status)
    {
        try {
            $db = new Database;
            $conn = $db->conn;
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = $conn->prepare("UPDATE `users` SET `status`=:status WHERE id=:id;");
            $sql->bindParam(':id', $id);
            $sql->bindParam(':status', $status);
            $sql->execute();
            // set the resulting array to associative
            $result = $sql->setFetchMode(PDO::FETCH_ASSOC);
            $result = $sql->fetch();
            return $result;
        } catch (PDOException $ex) {
            echo "Error:  " . $ex->getMessage();
        }
        $conn = null;
    }



    public function editUser($id, $fname, $lname, $email, $info)
    {
        try {
            $db = new Database;
            $conn = $db->conn;
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";
            $sql = $conn->prepare("UPDATE `users` s SET `f_name`=:fname, `l_name`=:lname, `email`=:email,`info`=:info WHERE s.id=:id;");

            $sql->bindParam(':id', $id);
            $sql->bindParam(':fname', $fname);
            $sql->bindParam(':lname', $lname);
            $sql->bindParam(':email', $email);
            $sql->bindParam(':info', $info);
            // no results return
            $sql->execute();
        } catch (PDOException $ex) {
            echo "Error:  " . $ex->getMessage();
        }
        $conn = null;
    }
    public function blockUser($id)
    {
        try {
            $db = new Database;
            $conn = $db->conn;
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";
            $sql = $conn->prepare("UPDATE `users` s SET `status`=:'Blocked' WHERE s.id=:id;");

            $sql->bindParam(':id', $id);

            // no results return
            $sql->execute();
            echo "Record Edited successfully";
        } catch (PDOException $ex) {
            echo "Error:  " . $ex->getMessage();
        }
        $conn = null;
    }

    public function deleteUser($id)
    {
        try {
            $db = new Database;
            $conn = $db->conn;
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";
            $sql = $conn->prepare("DELETE FROM `users`  WHERE id=:id;");
            $sql->bindParam(':id', $id);
            // no results return
            $sql->execute();
            echo "Record Deleted successfully";
        } catch (PDOException $ex) {
            echo "Error:  " . $ex->getMessage();
        }
        $conn = null;
    }

    function createMessage($email, $message)
    {
        try {
            $db = new Database;
            $conn = $db->conn;
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = $conn->prepare("INSERT INTO `messages`(`email`, `message`) VALUES (:email, :message);");
            $sql->bindParam(':email', $email);
            $sql->bindParam(':message', $message);

            $sql->execute();
            $status = 'true';
        } catch (PDOException $ex) {
            // echo "Error:  " . $ex->getMessage();
            $status = 'false';
        }
        $conn = null;
        return $status;
    }
    function getMessages($limit)
    {
        try {
            $db = new Database;
            $conn = $db->conn;
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = $conn->prepare("SELECT * FROM `messages` ORDER BY id DESC LIMIT :lim;");
            $sql->bindParam(':lim', $limit, PDO::PARAM_INT);

            $sql->execute();
            $result = $sql->setFetchMode(PDO::FETCH_ASSOC);
            $result = $sql->fetchAll();
            return $result;
        } catch (PDOException $ex) {
            echo "Error:  " . $ex->getMessage();
        }
        $conn = null;
    }
    function getTimeDifference($datetime)
    {
        // Convert the given datetime string to a DateTime object
        $givenDateTime = new DateTime($datetime);

        // Get the current datetime as a DateTime object
        $currentDateTime = new DateTime();

        // Calculate the time difference
        $interval = $currentDateTime->diff($givenDateTime);

        // Return the time difference as a string

        if ($interval->y > 0) {
            return $interval->format('%y years');
        } elseif ($interval->m > 0) {
            return $interval->format('%m months');
        } elseif ($interval->d > 0) {
            return $interval->format('%d days');
        } elseif ($interval->h > 0) {
            return $interval->format('%h hours');
        } elseif ($interval->i > 0) {
            return $interval->format('%i minutes');
        } else {
            return $interval->format('%s seconds');
        }
    }
}





?>