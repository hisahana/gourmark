<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    protected $fillable = [
        "category_id", "name", "memo", "image_path", "lat", "lng", "user_id"
    ];
}
