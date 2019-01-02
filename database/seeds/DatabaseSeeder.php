<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('users')->insert(
            [
                'id' => '1',
                'name' => 'root',
                'role' => '0',
                'email' => 'anatolishil@gmail.com',
                'password' => Hash::make('root')
            ]
            );
    }
}
