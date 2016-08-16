<?php

declare(strict_types = 1);

namespace php\tests\Functional\Views\Auth;

use Tests\BaseTest;

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

}
