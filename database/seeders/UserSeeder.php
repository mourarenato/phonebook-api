<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(['email' => 'renatomoura77@gmail.com', 'password' => bcrypt('123456789')]);
        User::create(['email' => 'peterjosh@hotmail.com', 'password' => bcrypt('helloworld32#')]);
        User::create(['email' => 'anamary@gmail.com', 'password' => bcrypt('maryanne10%')]);
        User::create(['email' => 'mariasouza91@outlook.com', 'password' => bcrypt('mybigfriend768@')]);
        User::create(['email' => 'caiopedro32@outlook.com', 'password' => bcrypt('footballfan55$')]);
    }
}
