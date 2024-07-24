<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Clinica;
use App\Models\Empleado;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => 'password'
        ]);

        Clinica::factory()->count(11)->create();
        Empleado::factory()->count(11)->create();
    }
}
