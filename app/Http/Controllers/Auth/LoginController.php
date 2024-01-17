<?php

namespace App\Http\Controllers\Auth;

//use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{


            // Redirect to Facebook for authorization
            public function redirectToFacebook()
            {
                return Socialite::driver('facebook')->redirect();
            }

            // Handle the Facebook callback
            public function handleFacebookCallback()
            {
                $user = Socialite::driver('facebook')->user();
                dd($user->toArray);

                // Implement your logic here to handle the authenticated user

                return redirect('/'); // Replace '/home' with the desired redirect URL
            }

}
