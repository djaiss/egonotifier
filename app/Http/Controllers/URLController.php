<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AddSourceService;
use Illuminate\Support\Facades\Auth;
use App\Services\LinkSourceToUserService;
use App\Exceptions\InvalidSourceException;
use App\Services\FetchSourceInformationService;

class URLController extends Controller
{
    public function store(Request $request)
    {
        $source = (new AddSourceService)->execute([
            'username' => $request->get('username'),
            'repository' => $request->get('repository'),
        ]);

        try {
            (new FetchSourceInformationService)->execute([
                'source_id' => $source->id,
            ]);
        } catch (InvalidSourceException $e) {
            $source->delete();
            return redirect('add')
                ->with('error', 'The repository you are trying to monitor seems invalid.');
        }

        (new LinkSourceToUserService)->execute([
            'source_id' => $source->id,
            'user_id' => auth()->user()->id,
        ]);

        return redirect('/home');
    }

    public function create()
    {
        return view('add');
    }
}
