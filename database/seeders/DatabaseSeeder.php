<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AdminSeeder::class);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@demo.com',
        ]);

        User::factory(15)->create();
    }
}
