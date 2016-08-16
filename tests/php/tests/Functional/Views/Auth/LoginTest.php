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
            ->visit('/login')
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
}
