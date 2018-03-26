<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = ['name', 'category_id', 'display_order'];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
