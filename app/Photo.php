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
        'export_filename',
    ];

    // protected $dispatchesEvents = [
    //     'saving' => UserSaving::class,
    // ];

    public static function boot()
    {
        parent::boot();

        // Update the export_filename every time model is saved
        static::saving(function ($photo) {
            $photo->export_filename = $photo->section_id
            . '_' . ($photo->section_entry_number + 1)
            . '_' . ($photo->user_id + 1000)
            . '_' . clean_string($photo->title)
            . '_' . clean_string($photo->user->application->shortname) . '.jpg';
        });

    }

    public function user()
    {
        return $this->belongsTo('\App\User');
    }

    public function section()
    {
        return $this->belongsTo('App\Section');
    }
}
