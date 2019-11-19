<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AddSourceService;
use Illuminate\Support\Facades\Auth;
use App\Services\LinkSourceToUserService;
use App\Exceptions\InvalidSourceException;
use App\Services\FetchSourceInformationService;

class AccountController extends Controller
{
    public function show(Request $request)
    {
        return view('/account');
    }

    public function destroy(Request $request)
    {
        $user = Auth::user();
        $user->delete();

        Auth::logout();

        return redirect('/login');
    }
}
