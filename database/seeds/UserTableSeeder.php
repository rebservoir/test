<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // php artisan db:seed
        DB::table('users')->insert([
        	'name' => 'Ricardo Escandon',
        	'email' => 'reb_189@hotmail.com',
        	'password' => bcrypt('123'),

        	]);
    }
}
