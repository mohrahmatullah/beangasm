<?php

namespace Modules\Frontend\Entities;

use Illuminate\Database\Eloquent\Model;

class PostExtra extends Model
{
    protected $fillable = ['post_extra_id', 'post_id', 'key_name', 'key_value', 'created_at', 'updated_at'];
}
