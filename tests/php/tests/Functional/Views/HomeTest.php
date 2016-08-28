<?php

declare(strict_types = 1);

namespace Tests\Functional;

use Tests\BaseTest;

class HomeTest extends BaseTest
{
    public function test_the_text_on_the_home_page_is_partially_correct()
    {
        $this
            ->visit('/')
            ->seeText('DOMANAMON.COM')
            ->seeText('DOMain Management And Monitoring');
    }


    /**
     * @test
     */
    public function make_sure_We_have_a_domain_link_in_the_page_header()
    {
        $this
            ->visit('/')
            ->seeLink('Domains', route('domains.index'));
    }
}
