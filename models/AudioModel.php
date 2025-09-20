<?php

namespace models;

use PDO;
use vendor\frame\Model;

class AudioModel extends Model
{
    public function tableName()
    {
        return 'audio';
    }

   public function getByVideoId($videoId){
        $sql = "SELECT * FROM `{$this->tableName()}` WHERE videoId = :videoId";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['videoId' => $videoId]);
        return $stmt->fetch(PDO::FETCH_OBJ);
   }

}