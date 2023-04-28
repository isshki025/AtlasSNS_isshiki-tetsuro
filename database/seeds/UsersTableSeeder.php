<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'username' => 'Altas太郎',
            'mail' => 'taro@example.com',
            'password' => Hash::make('password1')
        ]);
    }
}
