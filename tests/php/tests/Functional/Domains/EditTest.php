<?php

declare(strict_types = 1);

namespace php\tests\Functional\Domains;

use Tests\BaseTest;

class EditTest extends BaseTest
{
    private $user;

    private $domain;

    private $editPage;


    public function setUp()
    {
        parent::setUp();

        $this->user = $this->makeMeAUser();
        $this->domain = $this->makeMeADomain();
        $this->user->domains()->save($this->domain);

        $this->editPage = route('domains.edit', ['domains' => 1]);
    }


    /**
     * @test
     */
    public function check_the_create_page_is_accessible()
    {
        $this
            ->actingAs($this->user)
            ->visit($this->editPage)
            ->assertResponseOk();
    }

    /**
     * @test
     */
    public function the_page_title_should_be_self_explanatory()
    {
        $this
            ->actingAs($this->user)
            ->visit($this->editPage)
            ->seeInElement('h2', 'Edit ' . $this->domain->url);
    }

    /**
     * @test
     */
    public function make_sure_only_authenticated_users_can_access_the_page()
    {
        $this
            ->visit($this->editPage)
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
            ->visit($this->editPage)
            ->seeElement('input', [
                'name' => 'domain',
                'required' => 'required',
                'maxlength' => '255',
                'type' => 'url',
                'value' => $this->domain->url
            ])
            ->seeElement('button', [
                'name' => 'edit-domain-button'
            ]);
    }
}
