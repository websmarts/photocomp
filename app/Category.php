<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'display_order'];

    public $timestamps = false;

    public function sections()
    {
        return $this->hasMany('App\Section');
    }
}
