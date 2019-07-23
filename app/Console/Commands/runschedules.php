<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\scheduler;
use App\schedule;

class runschedules extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:runschedules';

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
    {
         $devicestate = new scheduler;
          $devicestate->deactivatedevices();
        $schedules = schedule::where('status' , 'pending')->get();
        if(isset($schedules)){
            $scheduler = new scheduler;
          $scheduler->activateschedules($schedules);
        }
           
            echo 'done';
        

    } 
}
