<?php

declare(strict_types = 1);

namespace php\tests\Functional\Views\Auth;

use Tests\BaseTest;

/**
 * Class RegistrationTest
 *
 * @package php\tests\Functional\Views\Auth
 */
class RegistrationTest extends BaseTest
{
    /**
     * @test
     */
    public function make_sure_we_have_a_valid_registration_form()
    {
        $this
            ->visit('register')
            ->seeElement('input', [
                'id' => 'name',
                'name' => 'name',
                'type' => 'text',
                'required' => 'required',
                'minlength' => '5'
            ])
            ->seeElement('input', [
                'id' => 'email',
                'name' => 'email',
                'type' => 'email',
                'required' => 'required',
            ])
        ->seeElement('input', [
            'id' => 'password',
            'name' => 'password',
            'type' => 'password',
            'required' => 'required',
            'minlength' => '8',
        ])
        ->seeElement('input', [
            'id' => 'password-confirm',
            'name' => 'password_confirmation',
            'type' => 'password',
            'required' => 'required',
            'minlength' => '8',
        ])
        ->seeElement('button', [
            'type' => 'submit',
        ]);
    }


    /**
     * @test
     */
    public function when_the_form_is_filled_in_it_should_create_a_user()
    {

        $this
            ->register()
            ->seePageIs('/')
            ->seeIsAuthenticated();
    }


    /**
     * @test
     */
    public function make_sure_we_cannot_register_with_a_short_password()
    {
        $this
            ->register([
                'password' => 'passwor',
                'password_confirmation' => 'passwor'
            ])
            ->seePageIs('/register')
            ->see('The password must be at least 8 characters.')
            ->dontSeeIsAuthenticated();
    }


    /**
     * @test
     */
    public function make_sure_we_need_unique_email_addresses()
    {
        $this->register(); // Register for our first account
        \Auth::logout(); // Logout from the account

        $this
            ->register()
            ->see('The email has already been taken.') // Make sure we get an error
            ->dontSeeIsAuthenticated();
    }


    /**
     * @test
     */
    public function make_sure_we_have_a_valid_email_address()
    {
        $this
            ->register([
                'email' => 'john[at]grandadevans[dot]com'
            ])
            ->see('The email must be a valid email address.');
    }


    /**
     * @test
     */
    public function make_sure_password_is_confirmed()
    {
        $this
            ->register([
                'password_confirmation' => 'password_1'
            ])
            ->see('The password confirmation does not match.');
    }


    /**
     * Validate that the maximum field lengths are enforced.
     *
     * This saves errors if somebody was to manually submit a form with more characters than allowed.
     * I have not done the password fields as they are put through bcrypt
     * The email also doesn't need to be put through this as a 255 character email would be invalid
     *
     * @test
     */
    public function validate_maximum_field_length_enforcement()
    {
     $this
         ->register([
             'name' => str_pad('', 256, 'a')
         ])
         ->see('The name may not be greater than 255 characters.');
    }


    /**
     * Register an account
     *
     * @param array $details    An array of details to merge with the defaults
     *
     * @return $this    Return $this so that it can be used by the rest of the registration call
     */
    protected function register(array $details = [])
    {
        $registrationDetails = array_merge([
            'name' => 'John Evans',
            'email' => 'john@grandadevans.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        ], $details);

        $this
            ->visit('/register')
            ->submitForm('Register', $registrationDetails);
        
        return $this;
    }
}
