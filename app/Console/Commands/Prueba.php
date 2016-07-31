<?php

namespace TuFracc\Console\Commands;

use Illuminate\Console\Command;


use DB;

class Prueba extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pr:prueba';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Prueba1';

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
        
        //DB::table('pagos')->insert(['id_user' => 6 , 'status' => 0, 'amount' => 550 , 'user_name' => 'xxx xxx']);
        
        $objetos = DB::table('objetos')->where('id', 1 )->get();
        
            foreach ($objetos as $obj){
        
                $x = $obj->count;
                $y = $x+1;
                DB::update('update objetos set count = ? where id = 1', [ $y ]);
            }

             DB::table('objetos')->insert(['count' => 0]);
        
    }
}
