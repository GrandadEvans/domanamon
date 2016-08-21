<?php

declare(strict_types=1);

namespace  Tests;

use Illuminate\Foundation\Testing\{TestCase, DatabaseMigrations, DatabaseTransactions};
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Tests\Traits\CommonTrait;

abstract class BaseTest extends TestCase
{
    use CommonTrait;
//    use DatabaseTransactions;
    use DatabaseMigrations;


    /**
     * Register an account
     *
     * @param array $details    An array of details to merge with the defaults
     *
     * @return RegistrationTest    Return $this so that it can be used by the rest of the registration call
     */
    public function register(array $details = [])
    {

        $registrationDetails = array_merge([
            'name'                  => 'John Evans',
            'email'                 => $this->defaultEmailAddress,
            'password'              => 'password',
            'password_confirmation' => 'password'
        ], $details);

        $this
            ->visit('/register')
            ->submitForm('Register', $registrationDetails);

        return $this;
    }

    /**
     * Login into an account
     *
     * @param array $details    An array of details to merge with the defaults
     *
     * @return LoginTest    Return $this so that it can be used by the rest of the login call
     */
    public function login(array $details = [])
    {
        $loginDetails = array_merge([
            'email'                 => $this->defaultEmailAddress,
            'password'              => 'password',
        ], $details);

        $this
            ->visit('/login')
            ->submitForm('login-button', $loginDetails);

        return $this;
    }


    /**
     * Logout of the application
     *
     * @return $this
     */
    public function logout()
    {
        \Auth::logout();
        return $this;
    }


    public static function setUpBeforeClass()
    {
    }


}
