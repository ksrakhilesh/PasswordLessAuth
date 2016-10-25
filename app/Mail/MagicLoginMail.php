<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MagicLoginMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $user;
    protected $options;
    public function __construct(User $user ,array $options)
    {
        $this->user = $user;
        $this->options = $options;
    }
    public function buildLink(){
        return url('login/magic/'.$this->user->token->token .'?'. http_build_query($this->options));
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Your Login Magic Link')
            ->view('email.auth.magic.link')
            ->withLink($this->buildLink());
    }
}
