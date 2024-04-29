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
        // Course 1
        $courseAbsBeginner = Course::create([
            'name' => 'abs begginer ',
            'muscle' => 'abs',
            'level' => 'beginner',
        ]);

        $exercise1 = Exercise::where('id',1)->first();
        $courseAbsBeginner->exercises()->attach([$exercise1->id], ['repetition' => 16, 'time' => 30]);

        $exercise2 = Exercise::where('id',74)->first();
        $courseAbsBeginner->exercises()->attach([$exercise2->id], ['repetition' => 20, 'time' => 40]);

        $exercise3 = Exercise::where('id',47)->first();
        $courseAbsBeginner->exercises()->attach([$exercise3->id], ['time' => 20]);

        $exercise4 = Exercise::where('id',61)->first();
        $courseAbsBeginner->exercises()->attach([$exercise4->id], ['repetition' => 16, 'time' => 16]);

        $exercise5 = Exercise::where('id',40)->first();
        $courseAbsBeginner->exercises()->attach([$exercise5->id], ['repetition' => 20, 'time' => 40]);

        $exercise6 = Exercise::where('id',56)->first();
        $courseAbsBeginner->exercises()->attach([$exercise6->id], ['repetition' => 16, 'time' => 30]);

        $exercise7 = Exercise::where('id',64)->first();
        $courseAbsBeginner->exercises()->attach([$exercise7->id], ['time' => 20]);

        $exercise8 = Exercise::where('id',1)->first();
        $courseAbsBeginner->exercises()->attach([$exercise8->id], ['repetition' => 16 ,'time' => 30]);

        $exercise9 = Exercise::where('id',74)->first();
        $courseAbsBeginner->exercises()->attach([$exercise9->id], ['repetition' => 20 ,'time' => 40]);

        $exercise10 = Exercise::where('id',61)->first();
        $courseAbsBeginner->exercises()->attach([$exercise10->id], ['repetition' => 16 ,'time' => 16]);

        $exercise11 = Exercise::where('id',40)->first();
        $courseAbsBeginner->exercises()->attach([$exercise11->id], ['repetition' => 20 ,'time' => 40]);

        $exercise12 = Exercise::where('id',56)->first();
        $courseAbsBeginner->exercises()->attach([$exercise12->id], ['repetition' => 16 ,'time' => 30]);

        $exercise13 = Exercise::where('id',64)->first();
        $courseAbsBeginner->exercises()->attach([$exercise13->id], ['time' => 20]);

        $exercise14 = Exercise::where('id',24)->first();
        $courseAbsBeginner->exercises()->attach([$exercise14->id], ['time' => 30]);

        $exercise15 = Exercise::where('id',94)->first();
        $courseAbsBeginner->exercises()->attach([$exercise15->id], ['time' => 30]);

        $exercise16 = Exercise::where('id',95)->first();
        $courseAbsBeginner->exercises()->attach([$exercise16->id], ['time' => 30]);


        // Course 2
        $courseChestBeginner = Course::create([
            'name' => 'chest begginer ',
            'muscle' => 'chest',
            'level' => 'beginner',
        ]);

        $exercise1 = Exercise::where('id',47);
        $courseChestBeginner->exercises()->attach([$exercise1->id], ['time' => 30]);

        $exercise2 = Exercise::where('id',67);
        $courseChestBeginner->exercises()->attach([$exercise2->id], ['repetition' => 4, 'time' => 8]);

        $exercise3 = Exercise::where('id',46);
        $courseChestBeginner->exercises()->attach([$exercise3->id], ['repetition' => 6, 'time' => 12]);

        $exercise4 = Exercise::where('id',114);
        $courseChestBeginner->exercises()->attach([$exercise4->id], ['repetition' => 4, 'time' => 8]);

        $exercise5 = Exercise::where('id',104);
        $courseChestBeginner->exercises()->attach([$exercise5->id], ['repetition' => 6, 'time' => 12]);

        $exercise6 = Exercise::where('id',46);
        $courseChestBeginner->exercises()->attach([$exercise6->id], ['repetition' => 6, 'time' => 12]);

        $exercise7 = Exercise::where('id',114);
        $courseChestBeginner->exercises()->attach([$exercise7->id], ['repetition' => 4, 'time' => 8]);

        $exercise8 = Exercise::where('id',104);
        $courseChestBeginner->exercises()->attach([$exercise8->id], ['repetition' => 6, 'time' => 12]);

        $exercise9 = Exercise::where('id',49);
        $courseChestBeginner->exercises()->attach([$exercise9->id], ['repetition' => 4, 'time' => 8]);

        $exercise10 = Exercise::where('id',24);
        $courseChestBeginner->exercises()->attach([$exercise10->id], ['time' => 20]);

        $exercise11 = Exercise::where('id',22);
        $courseChestBeginner->exercises()->attach([$exercise11->id], ['time' => 20]);


        // Course 3
        $courseArmBeginner = Course::create([
            'name' => 'arm begginer ',
            'muscle' => 'arm',
            'level' => 'beginner',
        ]);

        $exercise1 = Exercise::where('id',8);
        $courseArmBeginner->exercises()->attach([$exercise1->id], ['time' => 30]);

        $exercise2 = Exercise::where('id',77);
        $courseArmBeginner->exercises()->attach([$exercise2->id], ['time' => 30]);

        $exercise3 = Exercise::where('id',104);
        $courseArmBeginner->exercises()->attach([$exercise3->id], ['repetition' => 10, 'time' => 20]);

        $exercise4 = Exercise::where('id',4);
        $courseArmBeginner->exercises()->attach([$exercise4->id], ['time' => 30]);

        $exercise5 = Exercise::where('id',5);
        $courseArmBeginner->exercises()->attach([$exercise5->id], ['time' => 30]);

        $exercise6 = Exercise::where('id',29);
        $courseArmBeginner->exercises()->attach([$exercise6->id], ['repetition' => 6, 'time' => 12]);

        $exercise7 = Exercise::where('id',47);
        $courseArmBeginner->exercises()->attach([$exercise7->id], ['time' => 30]);

        $exercise8 = Exercise::where('id',21);
        $courseArmBeginner->exercises()->attach([$exercise8->id], ['time' => 16]);

        $exercise9 = Exercise::where('id',54);
        $courseArmBeginner->exercises()->attach([$exercise9->id], ['repetition' => 8, 'time' => 16]);

        $exercise10 = Exercise::where('id',55);
        $courseArmBeginner->exercises()->attach([$exercise10->id], ['repetition' => 8, 'time' => 16]);

        $exercise11 = Exercise::where('id',28);
        $courseArmBeginner->exercises()->attach([$exercise11->id], ['repetition' => 10, 'time' => 20]);

        $exercise12 = Exercise::where('id',65);
        $courseArmBeginner->exercises()->attach([$exercise12->id], ['time' => 30]);

        $exercise13 = Exercise::where('id',67);
        $courseArmBeginner->exercises()->attach([$exercise13->id], ['repetition' => 10, 'time' => 20]);

        $exercise14 = Exercise::where('id',45);
        $courseArmBeginner->exercises()->attach([$exercise14->id], ['repetition' => 8, 'time' => 80]);

        $exercise15 = Exercise::where('id',110);
        $courseArmBeginner->exercises()->attach([$exercise15->id], ['repetition' => 12, 'time' => 24]);

        $exercise16 = Exercise::where('id',106);
        $courseArmBeginner->exercises()->attach([$exercise16->id], ['time' => 30]);

        $exercise17 = Exercise::where('id',107);
        $courseArmBeginner->exercises()->attach([$exercise17->id], ['time' => 30]);

        $exercise18 = Exercise::where('id',98);
        $courseArmBeginner->exercises()->attach([$exercise18->id], ['time' => 30]);

        $exercise19 = Exercise::where('id',99);
        $courseArmBeginner->exercises()->attach([$exercise19->id], ['time' => 30]);


        // Course 4
        $courseLegBeginner = Course::create([
            'name' => 'leg begginer ',
            'muscle' => 'leg',
            'level' => 'beginner',
        ]);

        $exercise1 = Exercise::where('id',80);
        $courseLegBeginner->exercises()->attach([$exercise1->id], ['time' => 30]);

        $exercise2 = Exercise::where('id',96);
        $courseLegBeginner->exercises()->attach([$exercise2->id], ['repetition' => 12, 'time' => 24]);

        $exercise3 = Exercise::where('id',85);
        $courseLegBeginner->exercises()->attach([$exercise3->id], ['repetition' => 12, 'time' => 24]);

        $exercise4 = Exercise::where('id',86);
        $courseLegBeginner->exercises()->attach([$exercise4->id], ['repetition' => 12, 'time' => 24]);

        $exercise5 = Exercise::where('id',30);
        $courseLegBeginner->exercises()->attach([$exercise5->id], ['repetition' => 16, 'time' => 32]);

        $exercise6 = Exercise::where('id',31);
        $courseLegBeginner->exercises()->attach([$exercise6->id], ['repetition' => 16, 'time' => 32]);

        $exercise7 = Exercise::where('id',109);
        $courseLegBeginner->exercises()->attach([$exercise7->id], ['repetition' => 12, 'time' => 24]);

        $exercise8 = Exercise::where('id',101);
        $courseLegBeginner->exercises()->attach([$exercise8->id], ['repetition' => 12, 'time' => 20]);

        $exercise9 = Exercise::where('id',10);
        $courseLegBeginner->exercises()->attach([$exercise9->id], ['repetition' => 14, 'time' => 42]);

        $exercise10 = Exercise::where('id',96);
        $courseLegBeginner->exercises()->attach([$exercise10->id], ['repetition' => 12, 'time' => 24]);

        $exercise11 = Exercise::where('id',85);
        $courseLegBeginner->exercises()->attach([$exercise11->id], ['repetition' => 12, 'time' => 24]);

        $exercise12 = Exercise::where('id',86);
        $courseLegBeginner->exercises()->attach([$exercise12->id], ['repetition' => 12, 'time' => 24]);

        $exercise13 = Exercise::where('id',30);
        $courseLegBeginner->exercises()->attach([$exercise13->id], ['repetition' => 16, 'time' => 32]);

        $exercise14 = Exercise::where('id',31);
        $courseLegBeginner->exercises()->attach([$exercise14->id], ['repetition' => 16, 'time' => 32]);

        $exercise15 = Exercise::where('id',109);
        $courseLegBeginner->exercises()->attach([$exercise15->id], ['repetition' => 12, 'time' => 24]);

        $exercise16 = Exercise::where('id',101);
        $courseLegBeginner->exercises()->attach([$exercise16->id], ['repetition' => 12, 'time' => 20]);

        $exercise17 = Exercise::where('id',10);
        $courseLegBeginner->exercises()->attach([$exercise17->id], ['repetition' => 14, 'time' => 42]);

        $exercise18 = Exercise::where('id',50);
        $courseLegBeginner->exercises()->attach([$exercise18->id], ['time' => 30]);

        $exercise19 = Exercise::where('id',51);
        $courseLegBeginner->exercises()->attach([$exercise19->id], ['time' => 30]);

        $exercise20 = Exercise::where('id',18);
        $courseLegBeginner->exercises()->attach([$exercise20->id], ['time' => 30]);

        $exercise21 = Exercise::where('id',19);
        $courseLegBeginner->exercises()->attach([$exercise21->id], ['time' => 30]);

        $exercise22 = Exercise::where('id',53);
        $courseLegBeginner->exercises()->attach([$exercise22->id], ['time' => 30]);

        $exercise23 = Exercise::where('id',73);
        $courseLegBeginner->exercises()->attach([$exercise23->id], ['time' => 30]);


        // Course 5
        $courseShoulderAndBackBeginner = Course::create([
            'name' => 'shoulder and back begginer ',
            'muscle' => 'shoulder and back',
            'level' => 'beginner',
        ]);

        $exercise1 = Exercise::where('id',47);
        $courseShoulderAndBackBeginner->exercises()->attach([$exercise1->id], ['time' => 30]);

        $exercise2 = Exercise::where('id',8);
        $courseShoulderAndBackBeginner->exercises()->attach([$exercise2->id], ['time' => 16]);

        $exercise3 = Exercise::where('id',72);
        $courseShoulderAndBackBeginner->exercises()->attach([$exercise3->id], ['repetition' => 14, 'time' => 28]);

        $exercise4 = Exercise::where('id',77);
        $courseShoulderAndBackBeginner->exercises()->attach([$exercise4->id], ['time' => 16]);

        $exercise5 = Exercise::where('id',49);
        $courseShoulderAndBackBeginner->exercises()->attach([$exercise5->id], ['repetition' => 14, 'time' => 30]);

        $exercise6 = Exercise::where('id',83);
        $courseShoulderAndBackBeginner->exercises()->attach([$exercise6->id], ['time' => 30]);

        $exercise7 = Exercise::where('id',84);
        $courseShoulderAndBackBeginner->exercises()->attach([$exercise7->id], ['time' => 30]);

        $exercise8 = Exercise::where('id',9);
        $courseShoulderAndBackBeginner->exercises()->attach([$exercise8->id], ['time' => 30]);

        $exercise9 = Exercise::where('id',72);
        $courseShoulderAndBackBeginner->exercises()->attach([$exercise9->id], ['repetition' => 12, 'time' => 24]);

        $exercise10 = Exercise::where('id',77);
        $courseShoulderAndBackBeginner->exercises()->attach([$exercise10->id], ['time' => 14]);

        $exercise11 = Exercise::where('id',49);
        $courseShoulderAndBackBeginner->exercises()->attach([$exercise11->id], ['repetition' => 12, 'time' => 24]);

        $exercise12 = Exercise::where('id',20);
        $courseShoulderAndBackBeginner->exercises()->attach([$exercise12->id], ['time' => 30]);

        $exercise13 = Exercise::where('id',63);
        $courseShoulderAndBackBeginner->exercises()->attach([$exercise13->id], ['repetition' => 14, 'time' => 30]);

        $exercise14 = Exercise::where('id',68);
        $courseShoulderAndBackBeginner->exercises()->attach([$exercise14->id], ['repetition' => 12, 'time' => 24]);

        $exercise15 = Exercise::where('id',63);
        $courseShoulderAndBackBeginner->exercises()->attach([$exercise15->id], ['repetition' => 14, 'time' => 30]);

        $exercise16 = Exercise::where('id',68);
        $courseShoulderAndBackBeginner->exercises()->attach([$exercise16->id], ['repetition' => 12, 'time' => 24]);

        $exercise17 = Exercise::where('id',23);
        $courseShoulderAndBackBeginner->exercises()->attach([$exercise17->id], ['time' => 30]);


/*

        $exercise1 = Exercise::where('id',1);
        $courseShoulderAndBackBeginner->exercises()->attach([$exercise1->id], ['repetition' => 16, 'time' => 30]);



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
