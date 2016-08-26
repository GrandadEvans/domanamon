<?php

declare(strict_types = 1);

namespace php\tests\Functional\Domains;

use Tests\BaseTest;

/**
 * Class UpdateTest
 *
 * The only test we need to do is confirm that the form works properly.
 * The rest of the tests are not needed as the form itself is a partial
 * & as such any test within the StoreTest should cover the equivalent
 * functionality in this class.
 *
 * @package php\tests\Functional\Domains
 */
class UpdateTest extends BaseTest
{
    /**
     * @test
     */
    public function make_sure_the_form_submits_ok_and_we_see_the_correct_domain_details()
    {
        $user = $this->makeMeAUser();
        $domain = $this->makeMeADomain(['url' => 'http://google.com']);
        $user->domains()->save($domain);

        $this
            ->actingAs($user)
            ->visit($this->domainPage)
            ->seeInElement('td', 'http://google.com')
            ->dontSee('http://domanamon.com')
            ->visit(route('domains.edit', ['domains' => 1]))
            ->type('http://domanamon.com', 'domain')
            ->press('edit-domain-button')
            ->followRedirects()
            ->seePageIs($this->domainPage)
            ->dontSeeInElement('td', 'http://domanamon.com')
            ->seeInElement('td', 'http://google.com');
    }
}
