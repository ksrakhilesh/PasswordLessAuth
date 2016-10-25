<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\User;
class UserLoginToken extends Model
{
    const TOKEN_EXPIRY = 30;
    protected $table = 'users_login_tokens';
    protected $fillable = ['token'];
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getRouteKeyName()
    {
        return 'token';
    }
    public function isExpired(){
        return $this->created_at->diffInSeconds(Carbon::now()) > self::TOKEN_EXPIRY;
    }

    public function belongsToEmail($email){
        return (bool) $this->user->where('email', $email)->count() === 1;
    }

    public function scopeExpired($query){
        return $query->where('created_at' , '<' , Carbon::now()->subSeconds(self::TOKEN_EXPIRY));
    }
}


