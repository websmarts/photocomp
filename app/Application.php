<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'registration_status',
        'salutation',
        'firstname',
        'lastname',
        'honours',
        'address1',
        'address2',
        'city',
        'state',
        'postcode',
        'phone',
        'vaps_affiliated',
        'aps_member',
        'club_nomination',
        'return_postage',
        'total_amount_charged',
        'return_post_option',
        'payment_received_amount',
        'payment_datetime',
        'payment_method',
    ];
}
