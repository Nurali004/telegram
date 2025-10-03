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

    public function getBYVideo($id){
        $sql = "SELECT * FROM `{$this->tableName()}` where `video_id` = '$id'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }



}