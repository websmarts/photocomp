<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminCredentialsController extends Controller
{
    public function index()
    {
        return view('admin.edit_credentials_form');
    }

    public function update(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = Auth::user();

        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();

        flash('Administrator Credentials have been updated');

        return redirect()->route('admin.dashboard');

    }

    protected function validator(array $data)
    {

        return Validator::make($data, [
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }
}
