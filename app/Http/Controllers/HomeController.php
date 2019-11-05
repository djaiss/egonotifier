<?php

namespace App\Http\Controllers;

use App\Helpers\LevelHelper;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sources = auth()->user()->sources;

        $sourcesCollection = collect([]);

        foreach ($sources as $source) {
            $check = $source->getLatestCheck();
            $levelHelper = new LevelHelper();

            $sourcesCollection->push([
                'url' => 'https://github.com/'.$source->username.'/'.$source->repository,
                'watchers' => $check->watchers,
                'stars' => $check->stars,
                'forks' => $check->forks,
                'watchers_next_level' => $levelHelper->getValue($source->getNextLevel('watchers_level')),
                'stars_next_level' => $levelHelper->getValue($source->getNextLevel('stars_level')),
                'forks_next_level' => $levelHelper->getValue($source->getNextLevel('forks_level')),
            ]);
        }

        return view('home')
            ->with('sources', $sourcesCollection);
    }
}
