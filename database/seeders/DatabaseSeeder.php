<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Grade;

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

        //  $this->call(SchoolAdminSeeder::class);
          $this->call([
        GradeSeeder::class,
    ]);
    }
}
