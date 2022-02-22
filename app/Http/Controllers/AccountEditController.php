<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AccountEditController extends Controller
{
    //

    public function index() 
    {
        // list all user accounts
        $accounts = User::where('is_admin','no')->with('application')
            ->orderby('users.email','asc')
            ->get();

        foreach($accounts as &$a ){
            $a['confirm_terms'] = $a->application->completed;
        }


        return view('admin.accounts_list',['accounts' => $accounts]);

    }

    public function edit(Request $request, $id)
    {
        // edit account #ID
        $account = User::where('is_admin','no')->with('application')->findOrFail($id);
        return view('admin.edit_account_form',['account'=>$account]);
    }

    public function update(Request $request,$id)
    {
        // Save or delete account#ID
        
        $user = User::findOrFail($id);

        // if $request->delete_account == 'DELETE' ->delete the account
        if(strtoupper($request->delete_account) === 'DELETE'){
            
            if($user){
                if($user->application->completed !== 'checked'){
                    $user->application()->delete();
                }
                

                $user->delete();
                flash('Success - Account deleted ');
                return redirect()->route('admin.dashboard');
            }
        }
        

        // if $request->new_password !empty -> change the users password
        if(!empty($request->new_password)){
            
            $user->password = $request->new_password;
            $user->save();
            flash('Success - Account password changed ');
            return redirect()->route('admin.dashboard');
        }

        flash('Warning - No action taken ');
        return redirect()->route('admin.dashboard');
    }
}
