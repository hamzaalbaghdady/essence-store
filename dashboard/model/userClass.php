
<?php
require "database.php";
class user
{
    // private $u_id;
    // private $u_name;
    // private $email;
    // private $pass;

    // public function __construct($id, $name, $email, $password)
    // {
    //     $this->u_id = $id;
    //     $this->u_name = $name;
    //     $this->email = $email;
    //     $this->pass = $password;
    // }

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
            $sql = $conn->prepare("SELECT u.pass FROM `xuser` u WHERE u.email=:email;");
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
}





?>