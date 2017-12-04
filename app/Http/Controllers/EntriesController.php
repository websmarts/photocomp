<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Controllers\Controller;
use App\Utility\PhotosHandler;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EntriesController extends Controller
{
    private $entries = []; // an array of entries we return with ahr requests

    private $categoryName; // tmp holder of category name for process loops

    private $sectionName; // tmp holder of section name for process loops

    private $photosHandler;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->photosHandler = new PhotosHandler($this->setting());
    }

    public function index()
    {

        $categories = Category::with('sections')->get();

        // Show view that does not allow any changes if entrant has paid
        if (Auth::user()->application->paid) {
            return view('entries.show', compact('categories'));
        }

        $returnOptions = explode("\n", $this->setting('return_instructions'));

        $application = Auth::user()->application;

        return view('entries.index', compact('categories', 'returnOptions', 'application'));
    }

    /**
     * Handles the entry form checkout submission
     * @method submit
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function submit(Request $request)
    {

        $data = [
            'number_of_entries' => (int) $request->input('number_of_entries'),
            'number_of_sections' => (int) $request->input('number_of_sections'),
            'entries_cost' => (float) $request->input('entries_cost'),
            'return_postage' => (string) $request->input('return_postage'),
            'return_post_option' => (string) $request->input('return_post_option'),
            'submitted' => Carbon::now(),
        ];

        $request->user()->application->update($data);

        return $this->Jsend('success', null, null, false);
    }

    public function uploader(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpg,jpeg|max:2048',
            'category_id' => 'required|integer|min:1',
            'section_id' => 'required|integer|min:1',
            'title' => 'required|min:3',

        ]);
        if ($validator->fails()) {
            // handle it
            $messages = $validator->messages();
            return $this->Jsend('fail', null, implode('<br />', $messages->all()), false);
        };

        $result = $this->photosHandler->upload($request, $this->setting('max_entries_per_section'));

        if (is_array($result)) {
            return $result;
        }

        return $this->success();

    }

    public function success()
    {
        // return [
        //     'entries' => $this->getUserEntries(),
        //     'status' => 'success',
        // ];
        return $this->Jsend('success', $this->getUserEntries(), null, false);
    }

    public function process(Request $request)
    {
        $action = $request->input('action');
        $photoId = (int) $request->input('data', 0);

        switch ($action) {
            case 'delete':
                $this->photosHandler->delete($photoId);
                break;

            case 'promote':
                $this->photosHandler->promote($photoId);
                break;
        }
        return $this->success();

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

                $this->categoryName = $category->name;
                $this->sectionName = $section->name;

                $this->entries[$this->categoryName][$this->sectionName] = []; // init to empty array

                $res->each(function ($entry) {
                    $this->entries[$this->categoryName][$this->sectionName][] = $entry;
                });

            });
        });

        return $this->entries;

    }
}
