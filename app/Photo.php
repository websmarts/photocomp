<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'section_id',
        'title',
        'filepath',
        'filesize',
        'width',
        'height',
        'section_entry_number',
    ];
}
