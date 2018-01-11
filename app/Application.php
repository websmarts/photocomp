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
        'confirm_terms',

        // Entry form
        'number_of_entries',
        'number_of_sections',
        'entries_cost',
        'return_postage',
        'return_post_option',
        'submitted',
        'payment_method',

        'mc_gross',
        'mc_gross_1',
        'mc_gross_2',
        'mc_fee',
        'txn_id',
        'payment_date',
    ];

    protected $casts = [
        'entries_cost' => 'float',
        'number_of_entries' => 'integer',
        'mc_gross' => 'float',
        'mc_gross_1' => 'float',
        'mc_gross_2' => 'float',
        'mc_fee' => 'float',
    ];

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullnameAttribute()
    {
        return "{$this->salutation} {$this->firstname} {$this->lastname}";
    }
    public function getShortnameAttribute()
    {
        return "{$this->firstname} {$this->lastname}";
    }

    public function getCompletedAttribute()
    {
        return $this->confirm_terms == 'checked';
    }

    public function getPaidAttribute()
    {
        return $this->txn_id !== null;
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function photos()
    {
        return $this->hasMany('App\Photo', 'user_id', 'user_id');
    }

}
