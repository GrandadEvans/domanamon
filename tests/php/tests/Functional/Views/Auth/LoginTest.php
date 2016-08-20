<?php

declare(strict_types = 1);

namespace php\tests\Functional\Views\Auth;

use Tests\BaseTest;

class LoginTest extends BaseTest
{
    /**
     * @test
     */
    public function make_sure_we_have_a_login_form()
    {
        $this
            ->visit($this->loginPage)
            ->seeElement('input', [
                'type' => 'email',
                'required' => 'required',
            ])
            ->seeElement('input', [
                'type' => 'password',
                'required' => 'required',
                'minlength' => 8,
                'autocomplete' => 'false'
            ])
            ->seeElement('button', [
                'type' => 'submit',
                'class' => 'btn btn-primary',
            ])
            ->seeElement('input', [
                'type' => 'checkbox',
                'name' => 'remember'
            ])
            ->seeElement('form', [
                'name' => 'loginForm',
                'id' => 'loginForm'
            ])
        ->seeLink('Forgot Your Password?');
    }

    /**
     * @test
     */
    public function verify_a_valid_login()
    {
        $user =$this->makeMeAUser([
            'email' => $this->defaultEmailAddress,
            'password' => bcrypt('password')
        ]);

        $this
            ->actingAs($user)
            ->logout()
            ->dontSeeIsAuthenticated()
            ->login([
                'email' => $this->defaultEmailAddress,
                'password' => 'password'
            ])
            ->seeIsAuthenticated();
    }

    /**
     * @test
     */
    public function make_sure_we_cant_visit_the_login_page_when_logged_in()
    {
        $user = $this->makeMeAUser();

        $this
            ->actingAs($user)
            ->visit($this->loginPage)
            ->seePageIs('/');
    }

    /**
     * @test
     */
    public function make_sure_we_get_an_error_with_an_incorrectly_formatted_email_address()
    {
        $this
            ->dontSeeIsAuthenticated()
            ->login([ 'email' => 'john'])
            ->see('The email must be a valid email address.');
    }

    /**
     * @test
     */
    public function make_sure_we_cannot_login_with_an_incorrect_email()
    {
        $this->makeMeAUser([
            'email' => $this->defaultEmailAddress
        ]);

        $this
            ->login(['email' => 'john@grandadevans1.com'])
            ->see('These credentials do not match our records.');
    }

    /**
     * @test
     */
    public function make_sure_we_cannot_login_with_an_incorrect_password()
    {
        $this->makeMeAUser([
            'email' => $this->defaultEmailAddress,
            'password' => bcrypt('password')
        ]);

        $this
            ->login(['password' => 'password1'])
            ->see('These credentials do not match our records.');
    }

    /**
     * Test that the login throttle kicks in
     *
     * I am not going to test that the throttle is cancelled after 60 seconds as this will massively
     * increase the time taken to run the tests
     *
     * @test
     */
    public function make_sure_we_get_a_throttle_error_when_attempting_five_incorrect_logins()
    {
        $this->makeMeAUser([
            'email' => $this->defaultEmailAddress,
            'password' => bcrypt('password')
        ]);

        $this
            ->login(['password' => 'password1'])
            ->login(['password' => 'password2'])
            ->login(['password' => 'password3'])
            ->login(['password' => 'password4'])
            ->login(['password' => 'password5'])
            ->login(['password' => 'password6'])
            ->see('Too many login attempts. Please try again in 60 seconds.');
    }

    /**
     * Attempt at testing the remember tokens
     *
     * @test
     */
    public function make_sure_a_remember_token_is_set_when_checked_at_login()
    {
        $user = $this->makeMeAUser([
            'email' => $this->defaultEmailAddress,
            'password' => bcrypt('password')
        ]);

        // Initial login to make sure that no remember token is set when remember me is not checked
        $this->login([
            'email' => $this->defaultEmailAddress,
            'password' => 'password'
        ]);
        $this->assertNull($user->remember);

        // Now check the remember me box and make sure that we have a 60 character string
        $this
            ->logout()
            ->visit($this->loginPage)
            ->type($this->defaultEmailAddress, 'email')
            ->type('password', 'password')
            ->check('remember')
            ->press('login-button')
            ->seeIsAuthenticated();
        dd($user->remember);
    }
}
