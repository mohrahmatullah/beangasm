<?php

namespace Modules\Frontend\Entities;

use Illuminate\Database\Eloquent\Model;

class OrdersItem extends Model
{
    protected $fillable = ['id', 'order_id', 'order_data', 'created_at', 'updated_at'];
}
