<?php

namespace TuFracc\Console;

use DB;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use TuFracc\Http\Controllers\Controller;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \TuFracc\Console\Commands\Inspire::class,
        // \TuFracc\Console\Commands\Test::class,
        //\TuFracc\Console\Commands\limite::class,
        //\TuFracc\Console\Commands\prueba::class,
        //\TuFracc\Console\Commands\LogDemo::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        /*$schedule->command('inspire')
                 ->hourly(); */
        
        //$schedule->command('tst:prueba')->everyMinute(); 
        //$schedule->command('lmt:limite')->everyMinute(); 

        //$schedule->command('log:demo')->everyMinute(); 
/*
        $schedule->call(function () {
            \Log::info('I was here @ ' . \Carbon\Carbon::now());
        })->everyMinute(); 
*/
        //$schedule->call('TuFracc\Http\Controllers\PagosController@test')->everyMinute();  
        //$schedule->call('TuFracc\Http\Controllers\FrontController@test')->everyMinute();
        //$schedule->call('TuFracc\Http\Controllers\PagosController@corte')->everyMinute();  
        //$schedule->call('TuFracc\Http\Controllers\PagosController@limite')->everyMinute();  

        

    }
}
