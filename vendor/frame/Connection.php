<?php
namespace vendor\frame;
use PDO;

class Connection{
    public $pdo;
  private $conn;
  
  private $host = 'localhost';
  private $user = 'mvc';
  private $pass = 12345678;
  private $name = 'news';

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
