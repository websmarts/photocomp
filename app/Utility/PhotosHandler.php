<?php
namespace App\Utility;

use App\Http\Responses\Jsend;
use App\Photo;
use App\User;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PhotosHandler
{
    private $maxEntriesPerSection;
    private $user;
    private $height;
    private $width;

    public function __construct($settings, $user)
    {
        $this->maxEntriesPerSection = $settings->max_entries_per_section;
        $this->user = $user;

    }

    private function entryCount($userId, $sectionId)
    {
        $sectionEntries = $this->sectionEntries($userId, $sectionId);

        return $sectionEntries->count();

    }

    public function upload($request, $max_entries_per_section)
    {
        $sectionId = (int) $request->input('section_id');
        $categoryId = (int) $request->input('category_id');

        $count = $this->entryCount($this->user->id, $sectionId);

        if ($count >= $this->maxEntriesPerSection) {
            $jsend = new Jsend('fail', null, 'Maximum number of entries for section reached');
            return $jsend->response();
        }

        // Save the file to storage/app/photos

        $photo = $request->file('image');

        $image = Image::make($photo);

        $response = $this->checkImageDimensions($image);
        if($response !== null){
            return $response;
        }

        $filename = time() . '.' . strtolower($photo->getClientOriginalExtension());
        $photo->storeAs('photos', $filename);

        // resize the image to a width of 300 and constrain aspect ratio (auto height)

        $image->resize(100, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $image->save(storage_path('app/public/photos/' . $filename));

        // Insert photo table into db
        //
        $data = [
            'category_id' => $categoryId,
            'section_id' => $sectionId,
            'title' => $request->input('title'),
            'filepath' => $filename,
            'filesize' => $photo->getClientSize(),
            'width' => $this->width,
            'height' => $this->height,
            'section_entry_number' => $count++,
        ];

        $this->user->photos()->create($data);

        

    }

    private function checkImageDimensions($image)
    {

        $this->width = $image->width();
        $this->height = $image->height();

        $maxwidth = 1920; //px
        $maxheight = 1080; //px


        if ($this->height > $maxheight) {
            $jsend = new Jsend('fail', null, 'Image height ('.$this->height.'px) is greater than the allowed ' . $maxheight . ' pixels');
            return $jsend->response();
        }
        if ($this->width > $maxwidth) {
            $jsend = new Jsend('fail', null, 'Image width ('.$this->width.'px) is greater than the allowed ' . $maxwidth .' pixels');
            return $jsend->response();
        }

        
    }

    public function delete($id)
    {
        $photo = Photo::findOrFail($id);
        $sectionId = $photo->section_id;
        $userId = $photo->user_id;

        $this->deletePhotoFiles($photo);
        $photo->delete();

        $this->resequenceSectionEntries($userId, $sectionId);
    }

    private function deletePhotoFiles($photo)
    {
        // delete the thumb

        Storage::disk('public')->delete('photos/' . $photo->filepath);

        // Delete the file
        Storage::disk('local')->delete('photos/' . $photo->filepath);
    }


    private function getSwapPhoto($photo)
    {
        $sectionEntries = $this->sectionEntries($photo->user_id, $photo->section_id);

        return $sectionEntries->filter(function ($entry) use (&$photo) {
            return $entry->section_entry_number == ($photo->section_entry_number - 1);
        })
            ->sortBy('section_item_number')
            ->pop();

    }

    public function promote($id)
    {

        $photo = Photo::findOrFail($id);
        $this->resequenceSectionEntries($photo->user_id, $photo->section_id);

        $photo = Photo::findOrFail($id);

        // force resquence to ensure consecutive section item numbers
        $swapPhoto = $this->getSwapPhoto($photo);

        if ($swapPhoto) {
            $tmp = $swapPhoto->section_entry_number;
            // do the swap
            $swapPhoto->section_entry_number = $photo->section_entry_number;
            $photo->section_entry_number = $tmp;

            $swapPhoto->save();
            $photo->save();
        }

    }

    private function resequenceSectionEntries($userId, $sectionId)
    {
        $photos = $this->sectionEntries($userId, $sectionId);
        $seq = 0;
        $photos->map(function ($photo) use (&$seq) {
            if ($photo->section_entry_number != $seq) {
                $photo->section_entry_number = $seq;
                $photo->save();
            }
            $seq++;
        });
        return $photos;
    }

    private function sectionEntries($userId, $sectionId)
    {
        return Photo::where(['user_id' => $userId, 'section_id' => $sectionId])
            ->orderBy('section_entry_number')
            ->get();
    }

}
