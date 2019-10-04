<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'is_admin', 'api_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token' , 'api_token',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->token = str_random(30);
            $user->api_token = str_random(60);
        });

    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function confirmEmail()
    {
        $this->verified = true;
        $this->token = null;

        $this->save();
    }

    // Relationships
    public function application()
    {
        return $this->hasOne('\App\Application');
    }

    public function photos()
    {
        return $this->hasMany('\App\Photo');
    }

    public function prints()
    {
        return $this->hasMany('\App\Photo')->where('category_id',2)->orderBy('section_id','asc');
    }
}
