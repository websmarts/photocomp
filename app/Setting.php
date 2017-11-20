<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'title',
        'first_section_cost',
        'additional_section_cost',
        'max_entries_per_section',
        'terms_and_conditions_url',
    ];
}
