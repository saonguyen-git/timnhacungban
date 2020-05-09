<?php

namespace App\Console\Commands;

use App\Http\Controllers\GetDataChototController;
use Illuminate\Console\Command;

class GetDataMuaBan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run-muaban';

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
        $controller->GetDataMuaBan(2,1);
    }
}
