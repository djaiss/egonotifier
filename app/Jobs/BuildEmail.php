<?php

namespace App\Jobs;

use App\User;
use App\Models\Source;
use App\Helpers\LevelHelper;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class BuildEmail implements ShouldQueue
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
     * The user instance.
     *
     * @var array
     */
    public $user;

    /**
     * The latest Check instance.
     *
     * @var array
     */
    public $latestCheck;

    /**
     * Create a new job instance.
     *
     * @param Source $source
     * @param string $change
     * @param User $user
     */
    public function __construct(Source $source, string $change, User $user)
    {
        $this->source = $source;
        $this->change = $change;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->latestCheck = $this->source->checks()->latest()->first();

        if ($this->source->type == 'github.com') {
            $sentence = $this->checkGithub();
        }

        SendEmail::dispatch($this->user, $this->source, $sentence);
    }

    /**
     * Check which value has changed and grab the corresponding value.
     *
     * @return string
     */
    private function checkGithub() : string
    {
        $levelReached = 0;
        $currentValue = 0;
        $sentence = '';
        $levelHelper = new LevelHelper();

        if ($this->change == 'watchers') {
            $currentValue = $this->latestCheck->watchers;
            $levelReached = $levelHelper->getValue($this->latestCheck->watchers_level);
            $sentence = 'has reached '.$levelReached.' watchers (current number: '.$currentValue.').';
        }

        if ($this->change == 'stars') {
            $currentValue = $this->latestCheck->stars;
            $levelReached = $levelHelper->getValue($this->latestCheck->stars_level);
            $sentence = 'has reached '.$levelReached.' stars (current number: '.$currentValue.').';
        }

        if ($this->change == 'forks') {
            $currentValue = $this->latestCheck->forks;
            $levelReached = $levelHelper->getValue($this->latestCheck->forks_level);
            $sentence = 'has reached '.$levelReached.' forks (current number: '.$currentValue.').';
        }

        if ($this->change == 'commits') {
            $currentValue = $this->latestCheck->commits;
            $levelReached = $levelHelper->getValue($this->latestCheck->commits_level);
            $sentence = 'has reached '.$levelReached.' commits (current number: '.$currentValue.').';
        }

        return $sentence;
    }
}
