<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Stripe\Exception\ApiErrorException;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function show()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        if (env('PAY_TO_MONITOR') == true) {
            \Stripe\Stripe::setApiKey(env('STRIPE_API_KEY'));

            $token = $request->get('stripeToken');
            try {
                $charge = \Stripe\Charge::create([
                    'amount' => 1000,
                    'currency' => 'usd',
                    'description' => 'Egonotifier',
                    'source' => $token,
                ]);
            } catch (ApiErrorException $e) {
                return back()
                    ->withInput();
            }
        }

        $user = User::create([
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ]);

        return redirect('/home');
    }
}
