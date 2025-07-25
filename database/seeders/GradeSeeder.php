<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Grade;


class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          $grades = [
            ['school_id' => 1, 'grade_name' => 'A+', 'min_percentage' => 90, 'max_percentage' => 100],
            ['school_id' => 1, 'grade_name' => 'A',  'min_percentage' => 80, 'max_percentage' => 89],
            ['school_id' => 1, 'grade_name' => 'B',  'min_percentage' => 70, 'max_percentage' => 79],
            ['school_id' => 1, 'grade_name' => 'C',  'min_percentage' => 60, 'max_percentage' => 69],
            ['school_id' => 1, 'grade_name' => 'F',  'min_percentage' => 0,  'max_percentage' => 59],
        ];

        foreach ($grades as $grade) {
            Grade::create($grade);
        }
    }
}
