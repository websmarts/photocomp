<?php

namespace App\Http\Controllers;

use App\Category;
use App\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminCategoryController extends Controller
{

    public function index()
    {
        // dd($application);
        $categories = Category::with('sections')->get();

        $categories->each(function ($category) {
            $sections = $category->sections->pluck('name');
            $s = '';
            //dd($sections);

            foreach ($sections as $section) {
                $s .= $section . "\n";
            }

            $category->sections = $s;
        });
        //dd($categories);

        return view('admin.edit_category_form', compact('categories'));
    }

    public function update(Request $request)
    {

        $categories = collect($request->input('category'));
        $catSections = $request->input('sections');

        //dd($categories);

        // Delete current categories and sections
        DB::table('categories')->truncate();
        DB::table('sections')->truncate();
        // Category::whereNotNull('id')->delete();
        // Section::whereNotNull('id')->delete();

        // Add new Categories and Sections
        $categoryDisplayOrder = 0;
        foreach ($categories as $cid => $category) {
            // Create the category
            $category = Category::create(['name' => $category, 'display_order' => $categoryDisplayOrder++]);

            // Create the Section entries
            $sectionDisplayOrder = 0;
            $sections = explode("\r\n", $catSections[$cid]);
            //dd($sections);
            foreach ($sections as $sid => $section) {

                Section::create(['name' => $section, 'category_id' => $category->id, 'display_order' => $sectionDisplayOrder++]);

            }
        }

        flash('Success - Categories updated');
        return redirect()->route('admin.category.form');

    }
}
