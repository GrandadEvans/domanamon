<?php

declare(strict_types = 1);

namespace php\tests\Functional;

use Tests\BaseTest;

class DomainTest extends BaseTest
{
    /**
     * @test
     */
    public function make_sure_the_domain_page_is_accessible()
    {
        $this
            ->visit($this->domainPage)
            ->assertResponseOk()
            ;
    }

}
