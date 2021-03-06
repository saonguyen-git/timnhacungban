<?php

namespace App\Console\Commands;

use App\Http\Controllers\GetDataChototController;
use Illuminate\Console\Command;

class RunAutoGetPost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run-auto';

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
    public function handle(GetDataChototController $controller)
    {
        $controller->GetData(1, 12000);
        $controller->GetData(1, 13000);
        $controller->GetData(1, 3017);
//        $controller->GetDataMuaBan(1,1);
//        $controller->GetDataMuaBan(1,2);
    }
}
