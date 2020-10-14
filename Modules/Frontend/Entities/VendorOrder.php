<?php

namespace Modules\Frontend\Entities;

use Illuminate\Database\Eloquent\Model;

class VendorOrder extends Model
{
    protected $fillable = ['id', 'order_id', 'vendor_id', 'order_total','net_amount','order_status', 'created_at', 'updated_at'];
}
