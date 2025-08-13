<?php

namespace models;

use vendor\frame\Model;

class OrderItem extends Model
{
    public function tableName()
    {
        return 'order_item';
    }
}