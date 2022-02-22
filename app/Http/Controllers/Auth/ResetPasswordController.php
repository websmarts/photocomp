<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    // Following function overrides the one in ResetPasswords Trait to
    // stop the passowrd being hashed TWICE - ie once by the trait and once by
    // the User model mutator


    

     /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
     * @param  string  $password
     * @return void
     */
    protected function resetPassword($user, $password)
    {
        // App\User model implements hash in password setter
        //$user->password = Hash::make($password);

        $user->password = $password;

        $user->setRememberToken(Str::random(60));

        $user->save();

        // Auth::logout();
        // flash('Your password has been updated. Login now using your updated password');
        
        // event(new PasswordReset($user));

        // Change redirect if Admin user
        if($user->is_admin === 'yes'){
           $this->redirectTo ='/admin/dashboard';
        }

        $this->guard()->login($user);
        
    }

    
}
