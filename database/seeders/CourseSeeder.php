<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Exercise;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        // Get exercises by their IDs
        $exerciseIds = [1, 3, 5]; // Example exercise IDs
        $exercises = Exercise::whereIn('id', $exerciseIds)->get();

        // Create courses
        $course1 = Course::create([
            'name' => 'abs begginer ',
            'total_time' => 60,
            'kcal' => 500,
            'muscle' => 'chest',
            'level' => 'beginner',
        ]);

        $course1->exercises()->attach($exercise->id, ['time' => 30]);

        */


        /*
        $course1 = Course::create([
            'name' => 'Course 1',
            'total_time' => 60,
            'kcal' => 500,
            'muscle' => 'chest',
            'level' => 'beginner',
        ]);

        $course2 = Course::create([
            'name' => 'Course 2',
            'total_time' => 45,
            'kcal' => 400,
            'muscle' => 'leg',
            'level' => 'intermediate',
        ]);

        // Create exercises
        $exercise1 = Exercise::create([
            'name' => 'Exercise 1',
            'description' => 'Description of Exercise 1',
            'gif' => 'exercise1.gif',
            'calories' => 100,
        ]);

        $exercise2 = Exercise::create([
            'name' => 'Exercise 2',
            'description' => 'Description of Exercise 2',
            'gif' => 'exercise2.gif',
            'calories' => 150,
        ]);

        // Associate exercises with courses
        $course1->exercises()->attach([$exercise1->id, $exercise2->id]);
        $course2->exercises()->attach([$exercise2->id]);

        // You can add more exercises and associate them with courses as needed
    */

    }
}
