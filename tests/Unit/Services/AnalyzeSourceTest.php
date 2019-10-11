<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Models\Source;
use App\Services\AddSource;
use App\Services\FetchSource;
use App\Exceptions\InvalidSourceException;
use Illuminate\Support\Facades\Queue;
use App\Exceptions\NoHistoryException;
use App\Jobs\WarnUsers;
use App\Models\Check;
use App\Services\AnalyzeSource;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AnalyzeSourceTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_analyzes_a_source() : void
    {
        Queue::fake();

        $source = factory(Source::class)->create([]);
        factory(Check::class)->create([
            'source_id' => $source->id,
            'watchers_level' => 20,
            'stars_level' => 38,
            'forks_level' => 27,
            'commits_level' => 29,
        ]);
        factory(Check::class)->create([
            'source_id' => $source->id,
            'watchers_level' => 21,
            'stars_level' => 38,
            'forks_level' => 27,
            'commits_level' => 29,
        ]);

        $request = [
            'source_id' => $source->id,
        ];

        (new AnalyzeSource)->execute($request);
        Queue::assertPushed(WarnUsers::class);
    }

    /** @test */
    public function it_analyzes_a_source_and_doesnt_warn_users_as_no_changes_occured() : void
    {
        Queue::fake();

        $source = factory(Source::class)->create([]);
        factory(Check::class, 2)->create([
            'source_id' => $source->id,
        ]);

        $request = [
            'source_id' => $source->id,
        ];

        (new AnalyzeSource)->execute($request);

        Queue::assertNothingPushed();
    }

    /** @test */
    public function it_cant_analyze_a_source_without_historic_data() : void
    {
        $source = factory(Source::class)->create([]);

        $request = [
            'source_id' => $source->id,
        ];

        $this->expectException(NoHistoryException::class);
        $source = (new AnalyzeSource)->execute($request);

        // test also fails with only one point of historic data
        factory(Check::class)->create([
            'source_id' => $source->id,
        ]);

        $request = [
            'source_id' => $source->id,
        ];

        $this->expectException(NoHistoryException::class);
        $source = (new AnalyzeSource)->execute($request);
    }
}
