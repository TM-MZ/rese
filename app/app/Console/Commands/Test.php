<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Mail;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Test:info';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'write info messages in log filee';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        logger()->info('This is WriteLog Command.');
    }
}
