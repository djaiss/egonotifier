<?php

namespace Tests\Unit\Jobs;

use App\User;
use Tests\TestCase;
use App\Models\Source;
use App\Jobs\WarnUsers;
use App\Jobs\BuildEmail;
use Illuminate\Support\Facades\Bus;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WarnUsersTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_doesnt_warn_users_if_no_users_follow_a_source() : void
    {
        Bus::fake();

        $source = factory(Source::class)->create([]);
        $change = 'forks';

        $job = new WarnUsers($source, $change);
        $job->handle();

        Bus::assertNotDispatched(BuildEmail::class);
    }

    /** @test */
    public function it_warns_users_that_a_source_changed(): void
    {
        Bus::fake();

        $source = factory(Source::class)->create([]);
        $change = 'forks';
        $michael = factory(User::class)->create([]);
        $dwight = factory(User::class)->create([]);

        $source->users()->attach(
            $michael->id
        );
        $source->users()->attach(
            $dwight->id
        );

        $job = new WarnUsers($source, $change);
        $job->handle();

        Bus::assertDispatched(BuildEmail::class, 2);
    }
}
