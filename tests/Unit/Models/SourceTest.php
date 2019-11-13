<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Check;
use App\Models\Source;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SourceTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_has_many_checks(): void
    {
        $source = factory(Source::class)->create([]);
        factory(Check::class)->create([
            'source_id' => $source->id,
        ], 3);

        $this->assertTrue($source->checks()->exists());
    }

    /** @test */
    public function it_gets_the_next_level(): void
    {
        $source = factory(Source::class)->create([]);
        factory(Check::class)->create([
            'source_id' => $source->id,
            'watchers_level' => 10,
        ]);

        $this->assertEquals(
            11,
            $source->getNextLevel('watchers_level')
        );
    }

    /** @test */
    public function it_gets_the_latest_check(): void
    {
        $source = factory(Source::class)->create([]);
        factory(Check::class)->create([
            'source_id' => $source->id,
        ]);

        // yes it’s ugly, but if I don't pause, the orderBy created_at date
        // will be the same for the 3 records, therefore it will screw the
        // query
        sleep(1);
        factory(Check::class)->create([
            'source_id' => $source->id,
        ]);
        sleep(1);
        $check3 = factory(Check::class)->create([
            'source_id' => $source->id,
        ]);

        $this->assertEquals(
            $check3->id,
            $source->getLatestCheck()->id
        );
    }

    /** @test */
    public function it_gets_the_highest_level_reached(): void
    {
        $source = factory(Source::class)->create([]);
        factory(Check::class)->create([
            'source_id' => $source->id,
            'watchers_level' => 10,
        ]);
        factory(Check::class)->create([
            'source_id' => $source->id,
            'watchers_level' => 234,
        ]);
        factory(Check::class)->create([
            'source_id' => $source->id,
            'watchers_level' => 5,
        ]);

        $this->assertEquals(
            234,
            $source->getHighestLevelEverReached('watchers_level')
        );
    }
}
