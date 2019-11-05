<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Models\Check;
use App\Models\Source;
use App\Jobs\WarnUsersAboutChanges;
use Illuminate\Support\Facades\Queue;
use App\Exceptions\NoHistoryException;
use App\Services\AnalyzeSourceService;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AnalyzeSourceServiceTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_analyzes_a_source(): void
    {
        Queue::fake();

        $source = factory(Source::class)->create([]);
        factory(Check::class)->create([
            'source_id' => $source->id,
            'watchers_level' => 20,
            'stars_level' => 38,
            'forks_level' => 27,
        ]);
        factory(Check::class)->create([
            'source_id' => $source->id,
            'watchers_level' => 21,
            'stars_level' => 38,
            'forks_level' => 27,
        ]);

        $request = [
            'source_id' => $source->id,
        ];

        (new AnalyzeSourceService)->execute($request);
        Queue::assertPushed(WarnUsersAboutChanges::class);
    }

    /** @test */
    public function it_analyzes_a_source_and_doesnt_warn_users_as_no_changes_occured(): void
    {
        Queue::fake();

        $source = factory(Source::class)->create([]);
        factory(Check::class, 2)->create([
            'source_id' => $source->id,
        ]);

        $request = [
            'source_id' => $source->id,
        ];

        (new AnalyzeSourceService)->execute($request);

        Queue::assertNothingPushed();
    }

    /** @test */
    public function it_cant_analyze_a_source_without_historic_data(): void
    {
        $source = factory(Source::class)->create([]);

        $request = [
            'source_id' => $source->id,
        ];

        $this->expectException(NoHistoryException::class);
        $source = (new AnalyzeSourceService)->execute($request);

        // test also fails with only one point of historic data
        factory(Check::class)->create([
            'source_id' => $source->id,
        ]);

        $request = [
            'source_id' => $source->id,
        ];

        $this->expectException(NoHistoryException::class);
        $source = (new AnalyzeSourceService)->execute($request);
    }
}
