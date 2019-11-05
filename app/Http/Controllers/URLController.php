<?php

namespace App\Http\Controllers;

use App\Exceptions\InvalidSourceException;
use Illuminate\Http\Request;
use App\Services\AddSourceService;
use Illuminate\Support\Facades\Auth;
use App\Services\LinkSourceToUserService;
use App\Services\FetchSourceInformationService;
use Illuminate\Support\Facades\Validator;

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
            return redirect('home')
                ->with('error', 'Profile updated!');
        }

        (new LinkSourceToUserService)->execute([
            'source_id' => $source->id,
            'user_id' => auth()->user()->id,
        ]);

        return redirect('/home');
    }
}
