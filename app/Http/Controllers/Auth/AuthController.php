<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Auth;

class AuthController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    /**
     * Handle an authentication attempt.
     *
     * @return Response
     */
    public function authenticate(Request $request)
    {
        $nickname = $request->input('user');
        $password = $request->input('password');

        if (Auth::attempt(['nickname' => $nickname, 'password' => $password])) {
            // Authentication passed...
            return response()->json(['msg' => 'Login Success']);
        } else {
            return response()->json(['msg' => 'Login Failed']);
        }
    }

    /**
     * Handle a logout
     * @param Request $request
     * @return Response
     */
    public function logout(Request $request)
    {
        Auth::logout();

        return response()->json(['msg' => 'Logout Success']);
    }
}
