<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\Onboarding\SendWelcomeNewPreHireUserEmail;
use App\Mail\SendWelcomeNewUserEmail;
use App\Models\Provider\ProviderUser;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));


        Auth::login($user);
//  $characters = 'ab@CdefGhijklMno#p!qrsTuvwXyz0123456789';
//           $random_string_length = rand(5, 9);
//           $tmp_password = '';
//           $max = strlen($characters) - 1;
//           for ($i = 0; $i < $random_string_length; $i++) {
//               $tmp_password .= $characters[mt_rand(0, $max)];
//           }
//
//           $user->password = \Hash::make($tmp_password);
//           $user->save();
//
//           $userObj = ProviderUser::withTrashed()->find($request->user_id);
//
//           $data = [
//               'tmp_password' => $tmp_password,
//               'user' => $userObj
//           ];
//
//           Mail::to($data['user'])->provider($userObj->provider)->send(new SendWelcomeNewPreHireUserEmail($data));
        return redirect(route('dashboard', absolute: false));
    }
}
