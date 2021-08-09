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
            'password' => '$2a$12$FolESodM8w5wooPcdxvJF.O/Jiurj4taVFHwJRxhAgEyPv7I6bikC',
            'remember_token' => Str::random(10),
            'roles' => 'admin'
        ]);
    }
}
