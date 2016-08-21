<?php

declare(strict_types = 1);

namespace php\tests\Functional\Domains;

use Tests\BaseTest;

class StoreTest extends BaseTest
{
    /**
     * @test
     */
    public function make_sure_the_form_submits_ok_and_we_see_the_correct_feedback_displayed()
    {
        $user = $this->makeMeAUser();

        $this
            ->actingAs($user)
            ->visit($this->domainPage.'/create')
            ->type('http://domanamon.com', 'domain')
            ->press('add-domain-button')
            ->seePageIs($this->domainPage)
            ->see('You have successfully added your latest domain')
            ->seeInElement('td', 'http://domanamon.com')
            ->seeLink('Visit http://domanamon.com', 'http://domanamon.com');
        }

}
