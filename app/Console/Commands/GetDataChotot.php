<?php

namespace App\Console\Commands;

use App\Http\Controllers\GetDataChototController;
use Illuminate\Console\Command;

class GetDataChotot extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get-data-chotot';

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
        $id_list = array(12000,13000,3017);
        foreach ($id_list as $id_region){
            $controller->GetData($id_region);
        }
    }
}
