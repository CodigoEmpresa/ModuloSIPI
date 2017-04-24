<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DemoComando extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:comando';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Demo';

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
    }
}
