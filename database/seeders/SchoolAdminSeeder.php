<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\School;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SchoolAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $school = School::create([
            'name' => 'Islamabad Model School',
            'email' => 'ims@example.com',
            'phone' => '03121234567',
            'address' => 'G-10/2 Islamabad',
        ]);

        User::create([
            'name' => 'Admin IMS',
            'email' => 'admin@ims.com',
            'password' => Hash::make('password'), // change to secure password later
            'role' => 'admin',
            'school_id' => $school->id,
        ]);
    }
}
