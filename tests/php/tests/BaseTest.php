<?php

declare(strict_types=1);

namespace  Tests;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use \Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase;
use Tests\Traits\CommonTrait;

abstract class BaseTest extends TestCase
{
    use CommonTrait;
    use DatabaseTransactions;
    use DatabaseMigrations;
}
