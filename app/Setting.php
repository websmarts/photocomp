<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'title',
        'first_section_cost',
        'additional_section_cost',
        'digital_only_entry_surcharge',
        'max_entries_per_section',
        'terms_and_conditions_url',
        'competition_status',
        'return_instructions',
        'paypal_mode',
        'flagfall_cost',
        'digital_section_cost',
        'print_section_cost'

    ];
}
