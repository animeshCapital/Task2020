<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Notifications\InvoicePaid;
class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendMails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Custom Command';

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
        $email = $this->ask('Enter your Email-ID');
        $user = User::where('email', $email)->first();
        if($user)
        {
            $user->notify(new InvoicePaid);
            $this->info('Email has been send');
        }
        else
        {
            $this->error('Please enter valid Email-id');
        }
    }
}
