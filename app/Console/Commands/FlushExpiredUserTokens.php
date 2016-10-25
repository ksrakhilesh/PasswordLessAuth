<?php

namespace App\Console\Commands;
use App\UserLoginToken;
use Illuminate\Console\Command;

class FlushExpiredUserTokens extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auth:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Flush Expired User Tokens';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        UserLoginToken::expired()->delete();
    }
}
