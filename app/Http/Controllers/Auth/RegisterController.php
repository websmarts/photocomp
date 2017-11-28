<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserHasRegistered;
use App\Http\Controllers\Controller;
use App\Mailers\AppMailer;
use App\Mail\ConfirmEmail;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
     */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {

        return view('auth.register');
    }

    public function register(Request $request, AppMailer $mailer)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        event(new UserHasRegistered($user));

        //$this->guard()->login($user);
        //$mailer->sendEmailConfirmationTo($user);

        // the following failed on line 491 in mailable.php with
        // the error that [] oprator does not work with strings
        // Soooo using a basic sychronous mailer for now
        //Mail::to($user->email)->queue(new ConfirmEmail($user));

        flash('Please confirm your email address');

        return redirect('registered');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        return Validator::make($data, [
            // 'salutation' => 'required|string|max:255',
            // 'firstname' => 'required|string|max:255',
            // 'lastname' => 'required|string|max:255',
            //'honours' => 'required|string|max:255',
            // 'address1' => 'required|string|max:255',
            //'address2' => 'required|string|nullable|max:255',
            // 'city' => 'required|string|max:255',
            // 'postcode' => 'required|string|max:255',
            // 'state' => 'required|string|max:255',
            // 'phone' => 'required|string|max:255',
            // 'vaps_affiliated' => 'required|string|max:255',
            // 'vaps_member' => 'required|string|max:255',
            //'club_nomination' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        // Application::create([
        //     'salutation' => $data['salutation'],
        //     'firstname' => $data['firstname'],
        //     'lastname' => $data['lastname'],
        //     'honours' => $data['honours'],
        //     'address1' => $data['address1'],
        //     'address2' => $data['address2'],
        //     'city' => $data['city'],
        //     'postcode' => $data['postcode'],
        //     'state' => $data['state'],
        //     'phone' => $data['phone'],
        //     'vaps_affiliated' => $data['vaps_affiliated'],
        //     'aps_member' => $data['aps_member'],
        //     'club_nomination' => $data['club_nomination'],
        //     'user_id' => $user->id,
        // ]);

        return $user;
    }

    public function confirmEmail($token)
    {

        $user = User::whereToken($token)->first();

        if (!$user) {
            return redirect('login');
        }

        $user->confirmEmail();

        flash('Your account has been verified, you may now login');

        return redirect('login');
    }
    /**
     * Display a page telling the newly registered user
     * that they need to verify their email address
     *
     * @method registered
     * @return [type]     [View]
     */
    public function registered()
    {
        return view('auth.registered');
    }
}
