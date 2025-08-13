<?php

namespace models;

use vendor\frame\Model;

class Order extends Model
{
    public function tableName()
    {
        return 'orders';
    }
}