<?php

namespace Tests\Unit\Commands;

use Tests\TestCase;
use App\Models\Source;
use App\Jobs\FetchSourceData;
use Illuminate\Support\Facades\Queue;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FetchAllSourcesTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_triggers_a_job_to_fetch_source_data(): void
    {
        Queue::fake();

        factory(Source::class)->create([
            'valid' => true,
        ]);

        $this->artisan('fetch:sources');

        Queue::assertPushed(FetchSourceData::class);
    }

    /** @test */
    public function it_doesnt_trigger_a_job(): void
    {
        Queue::fake();

        factory(Source::class)->create([
            'valid' => false,
        ]);

        $this->artisan('fetch:sources');

        Queue::assertNotPushed(FetchSourceData::class);
    }
}
