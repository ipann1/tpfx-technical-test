<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create(
            [
                'name' => 'admin',
                'email' => 'mhmmdivan1@gmail.com',
                'password' => bcrypt('admin'),
            ]
        );
        User::factory()->create([
            'name' => 'user1',
            'email' => 'user1@example.com',
            'password' => bcrypt('user1'),
        ]);

        User::factory(10)->create();
    }
}
