<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class ExportPhoto implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $photo;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($photo)
    {
        
        $this->photo = $photo;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $fileContents = Storage::get('photos/' . $this->photo->filepath);

        

        Storage::disk('s3')->put(env('AWS_EXPORT_FOLDER') . '/' . $this->photo->export_filename, $fileContents);

        $this->photo->exported = 'yes';

        $this->photo->save();

        Storage::append('logs/export.log', $this->photo->updated_at . ' - ' . $this->photo->export_filename);

    }
}
