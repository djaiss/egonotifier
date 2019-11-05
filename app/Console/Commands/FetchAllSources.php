<?php

namespace App\Console\Commands;

use App\Models\Source;
use App\Jobs\FetchSourceData;
use Illuminate\Console\Command;

class FetchAllSources extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:sources';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch all sources data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Source::select('id')
            ->where('valid', true)
            ->chunk(100, function ($sources) {
                $sources->each(function (Source $source) {
                    FetchSourceData::dispatch($source)->onQueue('low');
                });
            });
    }
}
