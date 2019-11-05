<?php

namespace Tests\Unit\Jobs;

use App\User;
use Tests\TestCase;
use App\Models\Check;
use App\Models\Source;
use App\Jobs\SendEmail;
use App\Mail\SourceChanged;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SendEmailTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_queues_an_email(): void
    {
        Mail::fake();

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
        $sentence = 'has reached 200 commits (current number: 240).';

        SendEmail::dispatch($michael, $source, $sentence);

        Mail::assertQueued(SourceChanged::class, function ($mail) use ($source) {
            return $mail->source->id === $source->id;
        });
    }
}
