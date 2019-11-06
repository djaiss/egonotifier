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
}
