<?php

namespace App\Jobs;

use App\Models\Source;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class WarnUsers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The source instance.
     *
     * @var array
     */
    public $source;

    /**
     * The nature of change.
     *
     * @var array
     */
    public $change;

    /**
     * Create a new job instance.
     *
     * @param Source $source
     * @param string $change
     */
    public function __construct(Source $source, string $change)
    {
        $this->source = $source;
        $this->change = $change;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // find all the users that are subscribed to this source
        $users = $this->source->users;

        foreach ($users as $user) {
            BuildEmail::dispatch($this->source, $this->change, $user);
        }
    }
}
