<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'UserA',
            'email' => 'usera123@gmail.com',
            'password' => '$2y$10$jeiZWavSDcqKsyV9qSXQvei2Ou6zvjmtzBegUhRJ71KTLjrOLZnLq',
            'remember_token' => Str::random(10),
            'roles' => 'admin'
        ]);
    }
}
