<?php

declare(strict_types = 1);

namespace php\tests\Functional\Domains;

use Tests\BaseTest;

class IndexTest extends BaseTest
{
    /**
     * @test
     */
    public function make_sure_the_domain_page_is_accessible()
    {
        $this
            ->withoutMiddleware()
            ->visit($this->domainPage)
            ->assertResponseOk();
    }


    /**
     * @test
     */
    public function confirm_the_page_heading()
    {
        $this
            ->withoutMiddleware()
            ->visit('/domains')
            ->seeInElement('h2', 'Your Domains');
    }


    /**
     * @test
     */
    public function we_should_see_an_option_to_add_a_new_domain()
    {
        $this
            ->withoutMiddleware()
            ->visit($this->domainPage)
            ->seeLink('Add a new domain');
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
}
