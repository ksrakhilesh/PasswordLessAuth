<?php

namespace App\Http\Controllers\Auth;

use App\UserLoginToken;
use Illuminate\Http\Request;
use App\Auth\MAgicAuthentication;
use App\Http\Requests;
use Auth;
use App\Http\Controllers\Controller;

class MagicLoginController extends Controller
{
    protected $redirectOnRequest = '\login\magic';

    public function login()
    {

        return view('auth.magic.login');
    }

    public function postlogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|max:255|exists:users,email'
        ]);

    }

    public function sendToken(Request $request, MAgicAuthentication $auth)
    {

        $this->postlogin($request);
        $auth->requestLink();
        return redirect()->to($this->redirectOnRequest)->withSuccess('we\'ve Sent the magic link !');
    }

    public function validateToken(Request $request, UserLoginToken $token)
    {
        $token->delete();

        if ($token->isExpired()) {
            return redirect('login/magic')->withError('That Magic Link Has Expired.');
        }
        if (!$token->belongsToEmail($request->email)){
            return redirect('login/magic')->withError('InvalidMagicLink.');
        }
        Auth::login($token->user, $request->remember);
        return redirect()->intended();
    }
}
