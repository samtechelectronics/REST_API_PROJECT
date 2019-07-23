<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class appscheduler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bot:runschedule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description runninng';

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
        // 
	echo "hello";
    }

}
