<?php
namespace App\Auth;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;

class MAgicAuthentication
{

    protected $request ;
    protected $identifier = 'email';
    public function __construct(Request $request)
    {
    $this->request = $request;
    }

    public function requestLink()
    {
    $user = $this->getUserByIdentifier($this->request->get($this->identifier));
        $user->storeToken()->sendMagicLink(
            [
                'remember' => $this->request->has('remember'),
                'email' => $user->email
            ]
        );
    }

    public function getUserByIdentifier($identifier){
        $user = User::all()->where($this->identifier, $identifier)->first();
        return $user;
    }

}