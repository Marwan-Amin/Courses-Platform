<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Notifications\NotLogInForMonth;

class NotLoggedInNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:NotLoggedInNotification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
    {        $users = User::all();
        foreach($users as $user)
    {     
        if($user->roles == 'student'){
            $start =  date_create($user->last_login) ;
            $end = now();
            $dif = date_diff($start,$end);
            $dif->format('%a');

            if($dif->format('%a') == 30){
                $user->notify(new NotLogInForMonth);
            }
        }
    }                
    }
}
