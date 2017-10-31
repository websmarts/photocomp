<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_may_register_but_must_confirm_their_email_address()
    {

        $email = 'user1@here.com';
        $this->get('register')
            ->type($email, 'email')
            ->type('password', 'password')
            ->type('password', 'password-confirm')
            ->press('Register');

        $this->see('Please confirm your email address')
            ->seeInDatabase('users', ['email' => $email, 'verified' => 0]);

    }
}
