<?php

namespace TuFracc\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Http\Request;
use TuFracc\Http\Requests;
use DB;
use TuFracc\Pagos;
use TuFracc\Mail;
use TuFracc\Cuotas;
use TuFracc\Http\Controllers\Controller;

class Limite extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lmt:limite';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Limite';

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
        /*
        $pagos = DB::table('pagos')->all();
        $users = DB::table('users')->where('role', 0 )->where('deleted_at', null)->get();
        $status = 7;

            foreach ($users as $user){
                foreach ($pagos as $pago){
                     if(($pago->id_user) == ($user->id)){
                        if($pago->status == 0){
                            $status = 0; 
                        }
                     }   
                }

                DB::table('users')->update(['status' => 1])->where('id', $user->id );

            }
        */
        

        $users = DB::table('users')->where('role', 0 )->get();
        $pagos = DB::table('pagos')->get();
        
        foreach($users as $user){

            $flag = true; //saldado
           
            foreach($pagos as $pago){
                if($pago->id_user == $user->id){
                    if($pago->status == 0){
                        $flag = false; //adeudo                            
                    }
                } 
            }

                if($flag){
                    DB::update('update users set status = ? where id = ?', [ 0, $user->id ]);
                }else{
                    DB::update('update users set status = ? where id = ?', [ 1, $user->id ]);
                }
               
        }


    }
}

