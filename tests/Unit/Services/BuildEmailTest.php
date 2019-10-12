<?php

namespace Tests\Unit\Jobs;

use App\User;
use Tests\TestCase;
use App\Models\Check;
use App\Models\Source;
use App\Jobs\SendEmail;
use App\Jobs\BuildEmail;
use Illuminate\Support\Facades\Bus;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BuildEmailTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_prepares_the_email_for_a_watcher_change() : void
    {
        Bus::fake();

        $source = factory(Source::class)->create([]);
        $michael = factory(User::class)->create([]);
        $source->users()->attach(
            $michael->id
        );
        factory(Check::class)->create([
            'source_id' => $source->id,
            'watchers' => '240',
            'watchers_level' => 20,
        ]);
        $change = 'watchers';

        $job = new BuildEmail($source, $change, $michael);
        $job->handle();

        Bus::assertDispatched(SendEmail::class, function ($job) use ($michael, $source) {
            return $job->user->id === $michael->id
                && $job->source->id === $source->id
                && $job->sentence == 'has reached 200 watchers (current number: 240).';
        });
    }

    /** @test */
    public function it_prepares_the_email_for_a_star_change() : void
    {
        Bus::fake();

        $source = factory(Source::class)->create([]);
        $michael = factory(User::class)->create([]);
        $source->users()->attach(
            $michael->id
        );
        factory(Check::class)->create([
            'source_id' => $source->id,
            'stars' => '240',
            'stars_level' => 20,
        ]);
        $change = 'stars';

        $job = new BuildEmail($source, $change, $michael);
        $job->handle();

        Bus::assertDispatched(SendEmail::class, function ($job) use ($michael, $source) {
            return $job->user->id === $michael->id
                && $job->source->id === $source->id
                && $job->sentence == 'has reached 200 stars (current number: 240).';
        });
    }

    /** @test */
    public function it_prepares_the_email_for_a_fork_change(): void
    {
        Bus::fake();

        $source = factory(Source::class)->create([]);
        $michael = factory(User::class)->create([]);
        $source->users()->attach(
            $michael->id
        );
        factory(Check::class)->create([
            'source_id' => $source->id,
            'forks' => '240',
            'forks_level' => 20,
        ]);
        $change = 'forks';

        $job = new BuildEmail($source, $change, $michael);
        $job->handle();

        Bus::assertDispatched(SendEmail::class, function ($job) use ($michael, $source) {
            return $job->user->id === $michael->id
                && $job->source->id === $source->id
                && $job->sentence == 'has reached 200 forks (current number: 240).';
        });
    }

    /** @test */
    public function it_prepares_the_email_for_a_commit_change(): void
    {
        Bus::fake();

        $source = factory(Source::class)->create([]);
        $michael = factory(User::class)->create([]);
        $source->users()->attach(
            $michael->id
        );
        factory(Check::class)->create([
            'source_id' => $source->id,
            'commits' => '240',
            'commits_level' => 20,
        ]);
        $change = 'commits';

        $job = new BuildEmail($source, $change, $michael);
        $job->handle();

        Bus::assertDispatched(SendEmail::class, function ($job) use ($michael, $source) {
            return $job->user->id === $michael->id
                && $job->source->id === $source->id
                && $job->sentence == 'has reached 200 commits (current number: 240).';
        });
    }
}
