<?php

declare(strict_types = 1);

namespace php\tests\Functional\Domains;

use Tests\BaseTest;

class IndexTest extends BaseTest
{
    protected $user;

    /**
     * Set up a user for each test
     */
    public function setUp()
    {
        parent::setUp();
        $this->user = $this->makeMeAUser();
    }

    /**
     * @test
     */
    public function make_sure_the_domain_page_is_accessible()
    {
        $this
            ->actingAs($this->user)
            ->visit($this->domainPage)
            ->assertResponseOk();
    }


    /**
     * @test
     */
    public function confirm_the_page_heading()
    {
        $this
            ->actingAs($this->user)
            ->visit('/domains')
            ->seeInElement('h2', 'Your Domains');
    }


    /**
     * @test
     */
    public function only_authenticated_users_should_be_able_to_visit_the_domains_page()
    {
        $this
            ->visit($this->domainPage)
            ->seePageIs($this->loginPage);
    }


    /**
     * @test
     */
    public function we_should_see_a_link_to_delete_the_domain()
    {
        $domain = $this->makeMeADomain(['url' => 'http://domanamon.com']);
        $this->user->domains()->save($domain);

        $this
            ->actingAs($this->user)
            ->visit($this->domainPage)
            ->seeElement('a', [
                'href' => route('domains.destroy', [
                    'domains' => $domain->id
                ]),
                'class' => 'js-confirm-delete',
                'data-name' => $domain->url,
                'data-method' => 'DELETE',
                'data-model' => 'domain'
            ]);
    }

    /**
     * @test
     */
    public function if_there_are_no_domains_the_user_should_be_told_so()
    {
        $user = $this->user;

        $this
            ->actingAs($user)
            ->visit($this->domainPage)
            ->seeInElement('strong', 'You do not have any domains listed')
            ->seeLink('Add your first domain now.', route('domains.create'));
    }
}
