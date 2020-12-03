<?php

namespace App\Http\Controllers;

use App\User;
use App\Photo;
use App\Category;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use App\Utility\PhotosHandler;
use App\Mail\ApplicationReport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class EntriesController extends Controller
{
    private $entries = []; // an array of entries we return with ahr requests

    private $categoryName; // tmp holder of category name for process loops

    private $sectionName; // tmp holder of section name for process loops

    private $photosHandler; // handler for processing photo actions

    public $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->user = Auth::user();

    }

    public function index()
    {

        $categories = Category::with('sections')->get();

       
        // Show view that does not allow any changes if entrant has paid
        if (Auth::user()->application->submitted) {
            return view('entries.show', compact('categories'));
        }

        $returnOptions = explode("\r\n", $this->setting('return_instructions'));

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
        $this->user = Auth::guard('api')->user();

        $data = [
            'number_of_entries' => (int) $request->input('number_of_entries'),
            'number_of_sections' => (int) $request->input('number_of_sections'),
            'entries_cost' => (float) $request->input('entries_cost'),
            'return_postage' => (string) $request->input('return_postage'),
            'return_post_option' => (string) $request->input('return_post_option'),
            'return_group' => (string) $request->input('return_group',''),
            'submitted' => Carbon::now(),
        ];

        $this->user->application->update($data);

        $to = [
            'email' => $this->user->email,
        ];

        $admin = User::find(1);

        $cc = [
            'email' => $admin->email,
        ];

        // Send Email with Application confirmation
        Mail::to($to)
            ->cc($cc)
            ->queue(new ApplicationReport($this->user));

        return $this->Jsend('success', null, null, false);
    }

    public function uploader(Request $request)
    {

        $this->user = Auth::guard('api')->user();
        $this->photosHandler = new PhotosHandler($this->setting(), $this->user);

        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpg,jpeg|max:4096',
            'category_id' => 'required|integer|min:1',
            'section_id' => 'required|integer|min:1',
            'title' => 'required|min:3',

        ]);
        if ($validator->fails()) {
            // handle it
            $messages = $validator->messages();
            return $this->Jsend('fail', null, implode('<br />', $messages->all()), false);
        };

        // Check the title is not a duplicate for this user in this section
        $photo = Photo::where([
            ['user_id','=',$this->user->id],
            ['section_id','=',$request->section_id],
            ['category_id','=',$request->category_id],
            ['title','=',$request->title],

        ])->get();
        if($photo->count() > 0){
            
            return $this->Jsend('fail', null, 'Photo titles must be unique, ('.$request->title.') title has already been used ');
            
        }
        
        $result = $this->photosHandler->upload($request, $this->setting('max_entries_per_section'));

        if ($result !== null) {
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
        $this->user = Auth::guard('api')->user();
        $this->photosHandler = new PhotosHandler($this->setting(), $this->user);

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
        $photos = $this->user->photos;

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
