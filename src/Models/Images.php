<?php

namespace Yab\Quarx\Models;

use Illuminate\Database\Eloquent\Model;

class Images extends Model
{

    public $table = "images";

    public $primaryKey = "id";

    public $fillable = [
        "location",
        "name",
        "original_name",
        "alt_tag",
        "title_tag",
        "is_published",
    ];

    public static $rules = [
        'location' => 'mimes:jpeg,bmp,png,gif'
    ];

}