<?php

namespace App\Jobs;

use App\Models\Source;
use Illuminate\Bus\Queueable;
use App\Exceptions\NoHistoryException;
use App\Services\AnalyzeSourceService;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CheckIfSourceChanged implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The source instance.
     *
     * @var array
     */
    public $source;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Source $source)
    {
        $this->source = $source;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            (new AnalyzeSourceService)->execute([
                'source_id' => $this->source->id,
            ]);
        } catch (NoHistoryException $e) {
            return;
        }
    }
}
