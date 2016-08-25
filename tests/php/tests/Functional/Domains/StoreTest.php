<?php

declare(strict_types = 1);

namespace php\tests\Functional\Domains;

use Tests\BaseTest;

class StoreTest extends BaseTest
{
    /**
     * @test
     */
    public function make_sure_the_form_submits_ok_and_we_see_the_correct_domain_details()
    {
        $user = $this->makeMeAUser();

        $this
            ->actingAs($user)
            ->visit($this->domainPage.'/create')
            ->type('http://domanamon.com', 'domain')
            ->press('add-domain-button')
            ->followRedirects()
            ->seePageIs($this->domainPage)
            ->seeInElement('td', 'http://domanamon.com')
            ->seeElement('a', [
                'title' => 'Visit http://domanamon.com',
                'href'  => 'http://domanamon.com'
            ])
            ->seeElement('a', [
                'title' => 'Remove http://domanamon.com',
                'href'  => route('domains.destroy', ['domains' => 1])
            ]);
    }

    /*
     * Now that we have made sure that the form submits ok we want
     * to make sure that any restrictions on the form such as
     * validation rules are honoured and carried out.
     */

    /**
     * Test to make sure that the url is valid
     *
     * If the URL entered is not valid because it is missing the protocol from the from
     * ie a user entered domanamon.com instead of https://domanamon.com
     * then there will be javascript that prepends the protocol just before form submission
     * The URL should also be an active URL as returned by the PHP function checkdnsrr
     *
     * @test
     */
    public function make_sure_we_have_an_active_url()
    {
        $user = $this->makeMeAUser();

        $this
            ->actingAs($user)
            ->visit($this->domainPage.'/create')
            ->type('domanamon.com', 'domain')
            ->press('add-domain-button')
            ->seePageIs($this->domainPage.'/create')
            ->see('The Domain Address currently must be a valid URL');
    }


    /**
     * @test
     */
   public function make_sure_the_url_is_required()
    {
        $user = $this->makeMeAUser();

        $this
            ->actingAs($user)
            ->visit($this->domainPage.'/create')
            ->press('add-domain-button')
            ->seePageIs($this->domainPage.'/create')
            ->see('The Domain Address is required');
    }
}
