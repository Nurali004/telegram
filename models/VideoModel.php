<?php

namespace models;

use PDO;
use vendor\frame\Model;

class VideoModel extends Model
{
    public function tableName()
    {
        return 'video';
    }

    public function getVideo(){
        $sql = "SELECT * FROM `{$this->tableName()}`";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }



}