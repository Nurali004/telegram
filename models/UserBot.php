<?php
namespace models;
use vendor\frame\Model;
use PDO;

class UserBot extends Model
{
   public function tableName(){
       return 'user';
   }

   public function getByChatId($chat_id){

           $sql = "SELECT * FROM {$this->tableName()} WHERE chat_id = :chat_id";
           $stmt = $this->db->prepare($sql);
           $stmt->execute(['chat_id' => $chat_id]);
           return $stmt->fetch(PDO::FETCH_OBJ);

   }
}