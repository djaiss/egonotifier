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
        $levelHelper = new LevelHelper();
        $this->assertEquals(
            13,
            $levelHelper->checkLevel(44)
        );

        $this->assertEquals(
            36,
            $levelHelper->checkLevel(5123)
        );

        $this->assertEquals(
            95,
            $levelHelper->checkLevel(5000000)
        );

        $this->assertEquals(
            0,
            $levelHelper->checkLevel(0)
        );
    }

    /** @test */
    public function it_returns_the_current_value() : void
    {
        $levelHelper = new LevelHelper();
        $this->assertEquals(
            10000,
            $levelHelper->getValue(41)
        );

        $this->assertEquals(
            0,
            $levelHelper->getValue(0)
        );
    }
}
