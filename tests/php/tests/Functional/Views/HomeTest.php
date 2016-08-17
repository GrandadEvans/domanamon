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
}
