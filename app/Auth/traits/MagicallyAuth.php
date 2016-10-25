<?php
namespace App\Auth\traits;
use App\UserLoginToken;
use Mail;
use App\Mail\MagicLoginMail;

trait MagicallyAuth{
    public function token(){
    return $this->hasOne(UserLoginToken::class);
    }
    public function storeToken(){
        $this->token()->delete();
        $this->token()->create([
           'token' => str_random(255)
        ]);
        return $this;
    }
    public function sendMagicLink(array  $options){
    Mail::to($this)->send(new MagicLoginMail($this , $options));

    }
}
