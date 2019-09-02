<?php

namespace Tests\Unit\Helpers;

use Tests\TestCase;
use App\Helpers\LevelHelper;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LevelHelperTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_returns_the_current_level() : void
    {
        $this->assertEquals(
            13,
            LevelHelper::checkLevel(44)
        );

        $this->assertEquals(
            36,
            LevelHelper::checkLevel(5123)
        );

        $this->assertEquals(
            95,
            LevelHelper::checkLevel(5000000)
        );

        $this->assertEquals(
            0,
            LevelHelper::checkLevel(0)
        );
    }
}
