<?php

namespace TuFracc\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Http\Request;
use TuFracc\Http\Requests;
use DB;
use TuFracc\Pagos;
use TuFracc\Mail;
use TuFracc\Cuotas;
use TuFracc\Sites_users;
use TuFracc\Http\Controllers\Controller;

class Corte extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'corte:corte';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Corte';

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


        $users = DB::table('sites_users')->where('id_site', 4 )->get();
        $pagos = DB::table('pagos')->get();
        
        foreach($users as $user){
            
        }


    }
}

