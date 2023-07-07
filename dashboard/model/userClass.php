
<?php
require "database.php";
class user
{
    private $u_id;
    private $u_name;
    private $email;
    private $pass;

    public function __construct($id, $name, $email, $password)
    {
        $this->u_id = $id;
        $this->u_name = $name;
        $this->email = $email;
        $this->pass = $password;
    }

    public function getUId()
    {
        return $this->u_id;
    }

    public function setUId($u_id)
    {
        $this->u_id = $u_id;
    }

    public function getUName()
    {
        return $this->u_name;
    }

    public function setUName($u_name)
    {
        $this->u_name = $u_name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPass()
    {
        return $this->pass;
    }

    public function setPass($pass)
    {
        // hash the bassword before store it in database
        $this->pass = password_hash($pass, PASSWORD_DEFAULT);
    }

    /* function to vallidate if the user exist in database
        its take one argemnt 'email' and return the password
    */
    public function valliedUser($email)
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
            return $result;
        } catch (PDOException $ex) {
            echo "Connection failed: " . $ex->getMessage();
        }
        $conn = null;
    }

    // function to create session
    public function createSession($email, $password)
    {
        session_start();
        $_SESSION['email'] = $email;
        $_SESSION['pass'] = $password;
    }

    public function editUser($id, $name, $email, $password, $info)
    {
        try {
            $db = new Database;
            $conn = $db->conn;
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";
            $sql = $conn->prepare("UPDATE `users` s SET `name`=:name,`email`=:email,`pass`=:pass,`info`=:info WHERE s.id=:id;");

            $sql->bindParam(':id', $id);
            $sql->bindParam(':name', $name);
            $sql->bindParam(':email', $email);
            $sql->bindParam(':pass', $password);
            $sql->bindParam(':info', $info);
            // no results return
            $sql->execute();
            echo "Record Edited successfully";
        } catch (PDOException $ex) {
            echo "Connection failed: " . $ex->getMessage();
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
            echo "Connection failed: " . $ex->getMessage();
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
            echo "Connection failed: " . $ex->getMessage();
        }
        $conn = null;
    }
}





?>