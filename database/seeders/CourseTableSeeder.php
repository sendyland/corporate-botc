<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $courses = [
            ['title' => "Ship's Cook Certificate", 'description' => "", 'price' => 1800000],
            ['title' => "Steward Certificate", 'description' => "", 'price' => 1800000],
            ['title' => "Food Handling & Food Safety Certificate", 'description' => "", 'price' => 1800000],
            ['title' => "HACCP Certificate", 'description' => "", 'price' => 1800000],
            ['title' => "Campboss Certificate", 'description' => "", 'price' => 1800000],
            ['title' => "English Language Certificate", 'description' => "", 'price' => 1800000],
            ['title' => "HSE Certificate", 'description' => "", 'price' => 1800000],
            ['title' => "Cooking Course", 'description' => "", 'price' => 1800000],
            ['title' => "BNSP Certificate", 'description' => "", 'price' => 1800000],
            ['title' => "Onshore Cook Certificate", 'description' => "", 'price' => 1800000],
            ['title' => "Food Hygiene Certificate", 'description' => "", 'price' => 1800000]
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}
