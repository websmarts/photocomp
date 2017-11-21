<?php

namespace App\Http\Controllers;

use App\Category;
use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class EntriesController extends Controller
{
    private $entries = []; // an array of entries we return with ahr requests

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = Category::with('sections')->get();
        //dd($categories[0]->toArray());

        return view('entries.index', compact('categories'));
    }

    public function uploader(Request $request)
    {

        $this->validate($request, [

            'image' => 'required|image|mimes:jpg,jpeg|max:2048',
            'category_id' => 'required|integer|min:1',
            'section_id' => 'required|integer|min:1',
            'title' => 'required|min:3',

        ]);

        $user = $request->user();
        $sectionId = (int) $request->input('section_id');
        $categoryId = (int) $request->input('category_id');

        $sectionEntries = $user->photos()->where('section_id', $sectionId)->get();
        $count = $sectionEntries->count();
        if ($count > $this->setting('max_entries_per_section')) {
            return [
                'message' => 'Maximum entries per section',
                'errors' => ['max_entries_per_section' => 'Maximum number of entries for section reached'],
            ];
        }

        // Save the file to storage/app/photos
        $photo = $request->file('image');

        $image = Image::make($photo);
        $width = $image->width();
        $height = $image->height();

        if ($height > 1080) {
            return ['message' => 'image dimensions exceed maximum allowed', 'errors' => ['height' => 'Maximum dimension exceeded']];
        }
        if ($width > 1920) {
            return ['message' => 'image dimensions exceed maximum allowed', 'errors' => ['width' => 'Maximum dimension exceeded']];
        }

        $filename = time() . '.' . $photo->getClientOriginalExtension();
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
            'width' => $width,
            'height' => $height,
            'section_entry_number' => $count++,
        ];

        $user->photos()->create($data);
        //return $data;
        // Return
        return ['entries' => $this->getUserEntries()];

    }

    public function process(Request $request)
    {
        $action = $request->input('action');
        $photoId = (int) $request->input('data', 0);

        switch ($action) {
            case 'delete':
                $this->deletePhoto($photoId);
                break;

            case 'promote':
                $this->promotePhoto($photoId);
                break;
        }
        return [
            'entries' => $this->getUserEntries(),
            'status' => 'success',
        ];

    }

    private function deletePhoto($id)
    {
        if (!is_int($id)) {
            return;
        }
        $photo = Photo::findOrFail($id);

        $sectionEntries = $this->sectionEntries($photo->user_id, $photo->section_id);

        $sectionEntryNumber = 0;
        $sectionEntries->filter(function ($model) use (&$photo) {
            return $model->id != $photo->id;
        })->map(function ($model) use (&$sectionEntryNumber) {
            $model->section_entry_number = ++$sectionEntryNumber;
            $model->save();
        });
        $photo->delete();
    }

    private function promotePhoto($id)
    {
        if (!is_int($id)) {
            return;
        }
        $photo = Photo::findOrFail($id);

        $sectionEntries = $this->sectionEntries($photo->user_id, $photo->section_id);

        $swapEntry = $sectionEntries->filter(function ($entry) use (&$photo) {
            return $entry->section_entry_number < $photo->section_entry_number;
        })
            ->sortBy('section_item_number')
            ->pop();

        if ($swapEntry) {
            $tmp = $swapEntry->section_entry_number;
            \Log::info('swap section_entry_number: ' . $tmp);
            \Log::info('photo section_entry_number: ' . $photo->section_entry_number);
            // do the swap
            $swapEntry->section_entry_number = $photo->section_entry_number;
            $photo->section_entry_number = $tmp;

            $swapEntry->save();
            $photo->save();
        }

    }

    private function sectionEntries($userId, $sectionId)
    {
        return Photo::where(['user_id' => $userId, 'section_id' => $sectionId])
            ->orderBy('section_entry_number')
            ->get();
    }

    private function getUserEntries()
    {

        $categories = Category::with('sections')->orderBy('display_order', 'asc')->get();
        $photos = Auth::user()->photos;

        $categories->each(function ($category, $ckey) use ($photos) {
            $sections = $category->sections->sortBy('display_order');
            $sections->each(function ($section, $skey) use ($photos, $category) {

                $res = $photos->filter(function ($photo, $pkey) use ($category, $section) {
                    return ($photo->section_id == $section->id) && ($photo->category_id == $category->id);
                })->sortBy('section_entry_number');
                if (count($res)) {
                    foreach ($res->toArray() as $entry) {
                        $this->entries[$category->name][$section->name][] = $entry;
                    }
                } else {
                    $this->entries[$category->name][$section->name] = [];
                }

            });;
        });

        return $this->entries;

    }
}
