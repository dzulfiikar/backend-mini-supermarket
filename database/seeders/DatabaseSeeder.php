<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
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
        User::factory()
        ->count(5)
        ->state(new Sequence(
            ['roles' => 'admin'],
            ['roles' => 'kasir'],
            ['roles' => 'gudang']
        ))
        ->create();
    }
}
