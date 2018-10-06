<?php
/**
 * Created by PhpStorm.
 * User: rexlManu
 * Date: 06.10.2018
 * Time: 02:32
 */

namespace App\Http\Controllers;


use App\GoogleUser;
use App\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GoogleController extends Controller
{

    public function register(Request $request)
    {
        $google_id = $request->id;
        $google_email = $request->email;
        $google_name = $request->name;
        $google_image = $request->image;
        $googleUser = GoogleUser::all()->where('google_id', $google_id)->first();
        if ($googleUser) {
            $user = $googleUser->user();
            if ($user) {
                Auth::guard()->login($user);
                return response()->json(url('') . '/home');
            }
        } else {
            $user = new User();
            $user->email = $google_email;
            $user->name = $google_name;
            $user->password = '0';
            $user->email_verified_at = Carbon::now();
            $user->save();
            $googleUser = new GoogleUser();
            $googleUser->user_id = $user->id;
            $googleUser->google_id = $google_id;
            $googleUser->image_url = $google_image;
            $googleUser->save();
            Auth::guard()->login($user);
            return response()->json(url('') . '/home');
        }

    }

    public function login(Request $request)
    {
        $google_id = $request->id;
        $googleUser = GoogleUser::all()->where('google_id', $google_id)->first();
        if ($googleUser) {
            $user = $googleUser->user();
            if ($user) {
                Auth::guard()->login($user);
                return response()->json(url('') . '/home');
            }
        }
    }

}
