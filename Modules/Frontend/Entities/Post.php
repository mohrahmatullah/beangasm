<?php

namespace Modules\Frontend\Entities;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['id', 'post_author_id', 'post_content', 'post_title', 'post_slug', 'parent_id', 'post_status', 'post_type', 'created_at', 'updated_at'];
}
