<?php

declare(strict_types = 1);

namespace Tests\Unit;

use Carbon\Carbon;
use Tests\BaseTest;

/**
 * Class DomainTest
 *
 * First I want to unit test with TDD the model basics
 * Then once that is done I want to do the controller
 * Then function test the views and the entire process
 *
 * @package Tests\Unit
 */
class DomainTest extends BaseTest
{
    /**
     * @todo Not really a unit test so I may move this later
     *
     * @test
     */
    public function make_sure_we_can_retrieve_the_correct_results()
    {
        $user = $this->makeMeAUser([
            'email' => $this->defaultEmailAddress
        ]);

        static::assertSame($this->defaultEmailAddress, $user->email);
        static::assertInstanceOf(Carbon::class, $user->created_at);
        static::assertInstanceOf(Carbon::class, $user->updated_at);
    }

}
