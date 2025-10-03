<?php

namespace models;

use PDO;
use vendor\frame\Model;

class VideoItemModel extends Model
{
    public function tableName(){
        return 'video_item';
    }

    public function getByVideoId($video_id){
        $sql = "SELECT * FROM `{$this->tableName()}` WHERE video_id = :video_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['video_id' => $video_id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function getBYVideo($id){
        $sql = "SELECT * FROM `{$this->tableName()}` where `video_id` = '$id'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

}