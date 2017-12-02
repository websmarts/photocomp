<?php

namespace App\Http\Controllers;

use App\Club;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClubsController extends Controller
{
    public function index()
    {
        $clubs = Club::orderBy('name', 'asc')->get();
        $clubs = implode("\r\n", $clubs->pluck('name')->toArray());
        return view('admin.clubs_form', compact('clubs'));
    }

    public function update(Request $request)
    {
        $lines = collect(preg_split("/(\r\n|\n|\r)/", $request->clubs));

        DB::delete('delete from clubs');

        $lines->each(function ($line) {
            Club::insert(['name' => $line]);
        });

        return back();

    }

}
