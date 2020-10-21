<?php

namespace App\Http\Controllers;

use App\Mail\AccountInfo;
use App\Models\User;
use Auth;
use Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Str;

class SocialLoginController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */

    public function redirectToProvider($driver)
    {
        if (config()->has('services.' . $driver)) {
            return Socialite::driver($driver)
                //->scopes(['read:user', 'public_repo'])
                ->redirect();
        } else {
            abort(404);
        }
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */

    public function handleProviderCallback($driver)
    {
        try {
            if (config()->has('services.' . $driver)) {
                $user = Socialite::driver($driver)->user();
            } else {
                abort(404);
            }
        } catch (Exception $e) {
            return url('/');
        }
        $authUser = User::where('email', $user->getEmail())->first();
        $defaultPassword = Str::random(config('auth.password_length'));

        if ($authUser == null) {
            $authUser = User::create([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => Hash::make($defaultPassword),
            ]);
            Mail::to($authUser)->send(new AccountInfo($defaultPassword));
        }
        Auth::loginUsingId($authUser->id, true);
        return redirect()->route('dashboard');
    }

}
