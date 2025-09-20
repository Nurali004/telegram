<?php
namespace vendor\frame;
use PDO;

class Connection{
    public $pdo;
  public $conn;
  
  private $host = 'localhost';
  private $user = 'root';
<<<<<<< HEAD
  private $pass = 'root';
  private $name = 'bot_shop';
=======
  private $pass = '';
  private $name = 'shop_bot';
>>>>>>> 508f52b7fa4209aaa11d353103462605d45e520f

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
