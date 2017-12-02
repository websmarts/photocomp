<?php
namespace App\Utility;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Utils
{

    public static function trashOrphanPhotos()
    {
        $records = DB::table('photos')->select('filepath as filename')->get();

        $keep = $records->pluck('filename');

        $fileDir = 'photos/';
        $files = Storage::files($fileDir);

        $thumbDir = 'public/photos/';
        $thumbs = Storage::files($thumbDir);

        $deleteFiles = [];

        foreach ($thumbs as $t) {
            $base = str_replace($thumbDir, '', $t);
            if (!$keep->contains($base)) {
                $deleteFiles[] = $thumbDir . $base;
            }
        }

        foreach ($files as $t) {
            $base = str_replace($fileDir, '', $t);
            if (!$keep->contains($base)) {
                $deleteFiles[] = $fileDir . $base;
            }
        }

        Storage::delete($deleteFiles);

        return count($deleteFiles);
    }
}
