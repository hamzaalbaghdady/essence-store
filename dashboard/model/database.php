<?php

class Database
{

    private $serverName = "localhost";
    private $userName = "root";
    private $password = "";
    private $DBName = "essenc_store";

    public $conn = null;


    public function __construct()
    {
        $this->conn = new PDO("mysql:host=$this->serverName;dbname=$this->DBName", $this->userName, $this->password);
    }
}
