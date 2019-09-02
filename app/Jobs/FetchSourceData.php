<?php

namespace App\Jobs;

use App\Models\Check;
use Ixudra\Curl\Facades\Curl;
use App\Models\Source;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class FetchSourceData implements ShouldQueue
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
        $response = Curl::to('https://api.github.com/repos/jasonrudolph/keyboard')
            ->withHeader('User-Agent:Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36')
            ->get();

        $json = json_decode($response);
        $count = $json->stargazers_count;

        Check::create([
            'source_id' => $this->source->id,
            'value' => $count,
        ]);
    }
}
