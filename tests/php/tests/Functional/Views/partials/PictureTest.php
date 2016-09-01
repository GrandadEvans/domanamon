<?php

declare(strict_types = 1);

namespace php\tests\Functional\Views\partials;

use Tests\BaseTest;

class PictureTest extends BaseTest
{

    /**
     * @test
     */
    public function make_sure_the_blade_picture_tag_works()
    {
        $viewContents = file_get_contents(resource_path() . '/views/layouts/app.blade.php');
        $this->assertRegexp('/@include\(\'partials.picture\', \[\\s*\'filename\' => \'Domanamon-logo-png8-200x200\.png\',/', $viewContents);
        $this
            ->visit('/')
            ->seeElement('picture')
            ->seeElement('source', ['srcset' => '/images/Domanamon-logo-png8-200x200.webp'])
            ->seeElement('source', ['srcset' => '/images/Domanamon-logo-png8-200x200.png'])
            ->seeElement('img', ['src' => '/images/Domanamon-logo-png8-200x200.png']);
    }
}
