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
        DB::table('users')->insert([
        [
            'name' => 'Tomi Ristic',
            'email' => 'tomi_emmen@hotmail.com',
            'password' => Hash::make('t01o05m93i')
        ],
        [
            'name' => 'Dhevak',
            'email' => 'info@dhevak.nl',
            'password' => Hash::make('Dhevakit')
        ]]);

    }
}
