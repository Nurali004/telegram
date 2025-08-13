<?php
namespace vendor\frame;
use PDO;

class Connection{
    public $pdo;
  private $conn;
  
  private $host = 'MySQL-5.7';
  private $user = 'root';
  private $pass = '';
  private $name = 'bot_shop';

  public function __construct()
  {
    $this->conn = new PDO("mysql:host={$this->host};
    dbname={$this->name}", $this->user,$this->pass,
    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
  }
  
  public function getConnection()
  {
    return $this->conn;
  } 

}
