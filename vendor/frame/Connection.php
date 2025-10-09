<?php
namespace vendor\frame;
use PDO;

class Connection{
    public $pdo;
  public $conn;
  
  private $host = 'localhost';
  private $user = 'root';
  private $pass = 'root';
  private $name = 'bot_shop';

    public function __construct()
    {
        $this->conn = new PDO("mysql:host={$this->host};
    dbname={$this->name}", $this->user,$this->pass,
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4'"));
    }
  
  public function getConnection()
  {
    return $this->conn;
  } 

}
