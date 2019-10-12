<?php

namespace App\Jobs;

use App\User;
use App\Models\Source;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The source instance.
     *
     * @var array
     */
    public $source;

    /**
     * The sentence.
     *
     * @var array
     */
    public $sentence;

    /**
     * The user instance.
     *
     * @var array
     */
    public $user;

    /**
     * Create a new job instance.
     *
     * @param User $user
     * @param Source $source
     * @param string $sentence
     */
    public function __construct(User $user, Source $source, string $sentence)
    {
        $this->source = $source;
        $this->sentence = $sentence;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
    }
}
