<?php

use Illuminate\Database\Seeder;

class FollowsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('follows')->insert([
            'id' => 1,
            'following_id' => 2,
            'followed_id' => 2,
            'created_at' => '2023-04-27 15:14:34',
            'updated_at' => '2023-04-27 15:14:34',
        ]);
    }
}
