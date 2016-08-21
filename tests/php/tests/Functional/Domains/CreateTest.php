<?php

declare(strict_types = 1);

namespace php\tests\Functional\Domains;

use Tests\BaseTest;

class CreateTest extends BaseTest
{
    private $user;


    public function setUp()
    {
        parent::setUp();

        $this->user = $this->makeMeAUser();
    }


    /**
     * @test
     */
    public function check_the_create_page_is_accessible()
    {
        $this
            ->actingAs($this->user)
            ->visit($this->domainPage.'/create')
            ->assertResponseOk();
    }

    /**
     * @test
     */
    public function the_page_title_should_be_self_explanatory()
    {
        $this
            ->actingAs($this->user)
            ->visit($this->domainPage.'/create')
            ->seeInElement('h2', 'Add a new domain');
    }

    /**
     * @test
     */
    public function make_sure_only_authenticated_users_can_access_the_page()
    {
        $this
            ->visit($this->domainPage.'/create')
            ->seePageIs($this->loginPage);
    }

    /**
     * @test
     */
    public function we_should_see_a_link_back_to_the_main_domains_page()
    {
        $this
            ->actingAs($this->user)
            ->visit($this->domainPage.'/create')
            ->seeLink('Go back to your domains control panel', $this->domainPage);
    }

    /**
     * @test
     */
    public function we_should_have_a_valid_form()
    {
        $this
            ->actingAs($this->user)
            ->visit($this->domainPage.'/create')
            ->seeElement('input', [
                'name' => 'domain',
                'required' => 'required',
                'maxlength' => '255',
                'type' => 'url'
            ])
            ->seeElement('button', [
                'name' => 'add-domain-button'
            ]);
    }
}
