<?php

namespace App\Jobs;

use App\Photo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class SetupForPhotoExport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 3;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 900;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        Photo::where('exported', 'yes')->update(['exported' => 'no']);

        // Make directory if it doesnt exit
        Storage::disk('s3')->makeDirectory(env('AWS_EXPORT_FOLDER'));

        // Delete all the files in the directory
        $files = Storage::disk('s3')->files(env('AWS_EXPORT_FOLDER'));
        Storage::disk('s3')->delete($files);

    }

}
