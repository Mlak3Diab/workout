<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Exercise;
use App\Models\CourseExercise;

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


        $courseAbsBeginner->load('exercises');
        $totalCalories1 = $courseAbsBeginner->exercises()->sum('calories');
        $totalTime1 = $courseAbsBeginner->exercises()->sum('course_exercise.time');


        $courseAbsBeginner->update([
            'total_calories' => $totalCalories1,
            'total_time' => $totalTime1
        ]);


        // Course 2
        $courseChestBeginner = Course::create([
            'name' => 'chest begginer ',
            'muscle' => 'chest',
            'level' => 'beginner',
        ]);

        $exercis1 = Exercise::where('id',47)->first();
        $courseChestBeginner->exercises()->attach([$exercis1->id], ['time' => 30]);

        $exercis2 = Exercise::where('id',67)->first();
        $courseChestBeginner->exercises()->attach([$exercis2->id], ['repetition' => 4, 'time' => 8]);

        $exercis3 = Exercise::where('id',46)->first();
        $courseChestBeginner->exercises()->attach([$exercis3->id], ['repetition' => 6, 'time' => 12]);

        $exercis4 = Exercise::where('id',114)->first();
        $courseChestBeginner->exercises()->attach([$exercis4->id], ['repetition' => 4, 'time' => 8]);

        $exercis5 = Exercise::where('id',104)->first();
        $courseChestBeginner->exercises()->attach([$exercis5->id], ['repetition' => 6, 'time' => 12]);

        $exercis6 = Exercise::where('id',46)->first();
        $courseChestBeginner->exercises()->attach([$exercis6->id], ['repetition' => 6, 'time' => 12]);

        $exercis7 = Exercise::where('id',114)->first();
        $courseChestBeginner->exercises()->attach([$exercis7->id], ['repetition' => 4, 'time' => 8]);

        $exercis8 = Exercise::where('id',104)->first();
        $courseChestBeginner->exercises()->attach([$exercis8->id], ['repetition' => 6, 'time' => 12]);

        $exercis9 = Exercise::where('id',49)->first();
        $courseChestBeginner->exercises()->attach([$exercis9->id], ['repetition' => 4, 'time' => 8]);

        $exercis10 = Exercise::where('id',24)->first();
        $courseChestBeginner->exercises()->attach([$exercis10->id], ['time' => 20]);

        $exercis11 = Exercise::where('id',22)->first();
        $courseChestBeginner->exercises()->attach([$exercis11->id], ['time' => 20]);

        $courseChestBeginner->load('exercises');
        $totalCalories2 = $courseChestBeginner->exercises()->sum('calories');
        $totalTime2 = $courseChestBeginner->exercises()->sum('course_exercise.time');


        $courseChestBeginner->update([
            'total_calories' => $totalCalories2,
            'total_time' => $totalTime2
        ]);



        // Course 3
        $courseArmBeginner = Course::create([
            'name' => 'arm begginer ',
            'muscle' => 'arm',
            'level' => 'beginner',
        ]);

        $exerci1 = Exercise::where('id',8)->first();
        $courseArmBeginner->exercises()->attach([$exerci1->id], ['time' => 30]);

        $exerci2 = Exercise::where('id',77)->first();
        $courseArmBeginner->exercises()->attach([$exerci2->id], ['time' => 30]);

        $exerci3 = Exercise::where('id',104)->first();
        $courseArmBeginner->exercises()->attach([$exerci3->id], ['repetition' => 10, 'time' => 20]);

        $exerci4 = Exercise::where('id',4)->first();
        $courseArmBeginner->exercises()->attach([$exerci4->id], ['time' => 30]);

        $exerci5 = Exercise::where('id',5)->first();
        $courseArmBeginner->exercises()->attach([$exerci5->id], ['time' => 30]);

        $exerci6 = Exercise::where('id',29)->first();
        $courseArmBeginner->exercises()->attach([$exerci6->id], ['repetition' => 6, 'time' => 12]);

        $exerci7 = Exercise::where('id',47)->first();
        $courseArmBeginner->exercises()->attach([$exerci7->id], ['time' => 30]);

        $exerci8 = Exercise::where('id',21)->first();
        $courseArmBeginner->exercises()->attach([$exerci8->id], ['time' => 16]);

        $exerci9 = Exercise::where('id',54)->first();
        $courseArmBeginner->exercises()->attach([$exerci9->id], ['repetition' => 8, 'time' => 16]);

        $exerci10 = Exercise::where('id',55)->first();
        $courseArmBeginner->exercises()->attach([$exerci10->id], ['repetition' => 8, 'time' => 16]);

        $exerci11 = Exercise::where('id',28)->first();
        $courseArmBeginner->exercises()->attach([$exerci11->id], ['repetition' => 10, 'time' => 20]);

        $exerci12 = Exercise::where('id',65)->first();
        $courseArmBeginner->exercises()->attach([$exerci12->id], ['time' => 30]);

        $exerci13 = Exercise::where('id',67)->first();
        $courseArmBeginner->exercises()->attach([$exerci13->id], ['repetition' => 10, 'time' => 20]);

        $exerci14 = Exercise::where('id',45)->first();
        $courseArmBeginner->exercises()->attach([$exerci14->id], ['repetition' => 8, 'time' => 80]);

        $exerci15 = Exercise::where('id',110)->first();
        $courseArmBeginner->exercises()->attach([$exerci15->id], ['repetition' => 12, 'time' => 24]);

        $exerci16 = Exercise::where('id',106)->first();
        $courseArmBeginner->exercises()->attach([$exerci16->id], ['time' => 30]);

        $exerci17 = Exercise::where('id',107)->first();
        $courseArmBeginner->exercises()->attach([$exerci17->id], ['time' => 30]);

        $exerci18 = Exercise::where('id',98)->first();
        $courseArmBeginner->exercises()->attach([$exerci18->id], ['time' => 30]);

        $exerci19 = Exercise::where('id',99)->first();
        $courseArmBeginner->exercises()->attach([$exerci19->id], ['time' => 30]);

        $courseArmBeginner->load('exercises');
        $totalCalories3 = $courseArmBeginner->exercises()->sum('calories');
        $totalTime3 = $courseArmBeginner->exercises()->sum('course_exercise.time');


        $courseArmBeginner->update([
            'total_calories' => $totalCalories3,
            'total_time' => $totalTime3
        ]);



        // Course 4
        $courseLegBeginner = Course::create([
            'name' => 'leg begginer ',
            'muscle' => 'leg',
            'level' => 'beginner',
        ]);

        $exerc1 = Exercise::where('id',80)->first();
        $courseLegBeginner->exercises()->attach([$exerc1->id], ['time' => 30]);

        $exerc2 = Exercise::where('id',96)->first();
        $courseLegBeginner->exercises()->attach([$exerc2->id], ['repetition' => 12, 'time' => 24]);

        $exerc3 = Exercise::where('id',85)->first();
        $courseLegBeginner->exercises()->attach([$exerc3->id], ['repetition' => 12, 'time' => 24]);

        $exerc4 = Exercise::where('id',86)->first();
        $courseLegBeginner->exercises()->attach([$exerc4->id], ['repetition' => 12, 'time' => 24]);

        $exerc5 = Exercise::where('id',30)->first();
        $courseLegBeginner->exercises()->attach([$exerc5->id], ['repetition' => 16, 'time' => 32]);

        $exerc6 = Exercise::where('id',31)->first();
        $courseLegBeginner->exercises()->attach([$exerc6->id], ['repetition' => 16, 'time' => 32]);

        $exerc7 = Exercise::where('id',109)->first();
        $courseLegBeginner->exercises()->attach([$exerc7->id], ['repetition' => 12, 'time' => 24]);

        $exerc8 = Exercise::where('id',101)->first();
        $courseLegBeginner->exercises()->attach([$exerc8->id], ['repetition' => 12, 'time' => 20]);

        $exerc9 = Exercise::where('id',10)->first();
        $courseLegBeginner->exercises()->attach([$exerc9->id], ['repetition' => 14, 'time' => 42]);

        $exerc10 = Exercise::where('id',96)->first();
        $courseLegBeginner->exercises()->attach([$exerc10->id], ['repetition' => 12, 'time' => 24]);

        $exerc11 = Exercise::where('id',85)->first();
        $courseLegBeginner->exercises()->attach([$exerc11->id], ['repetition' => 12, 'time' => 24]);

        $exerc12 = Exercise::where('id',86)->first();
        $courseLegBeginner->exercises()->attach([$exerc12->id], ['repetition' => 12, 'time' => 24]);

        $exerc13 = Exercise::where('id',30)->first();
        $courseLegBeginner->exercises()->attach([$exerc13->id], ['repetition' => 16, 'time' => 32]);

        $exerc14 = Exercise::where('id',31)->first();
        $courseLegBeginner->exercises()->attach([$exerc14->id], ['repetition' => 16, 'time' => 32]);

        $exerc15 = Exercise::where('id',109)->first();
        $courseLegBeginner->exercises()->attach([$exerc15->id], ['repetition' => 12, 'time' => 24]);

        $exerc16 = Exercise::where('id',101)->first();
        $courseLegBeginner->exercises()->attach([$exerc16->id], ['repetition' => 12, 'time' => 20]);

        $exerc17 = Exercise::where('id',10)->first();
        $courseLegBeginner->exercises()->attach([$exerc17->id], ['repetition' => 14, 'time' => 42]);

        $exerc18 = Exercise::where('id',50)->first();
        $courseLegBeginner->exercises()->attach([$exerc18->id], ['time' => 30]);

        $exerc19 = Exercise::where('id',51)->first();
        $courseLegBeginner->exercises()->attach([$exerc19->id], ['time' => 30]);

        $exerc20 = Exercise::where('id',18)->first();
        $courseLegBeginner->exercises()->attach([$exerc20->id], ['time' => 30]);

        $exerc21 = Exercise::where('id',19)->first();
        $courseLegBeginner->exercises()->attach([$exerc21->id], ['time' => 30]);

        $exerc22 = Exercise::where('id',53)->first();
        $courseLegBeginner->exercises()->attach([$exerc22->id], ['time' => 30]);

        $exerc23 = Exercise::where('id',73)->first();
        $courseLegBeginner->exercises()->attach([$exerc23->id], ['time' => 30]);

        $courseLegBeginner->load('exercises');
        $totalCalories4 = $courseLegBeginner->exercises()->sum('calories');
        $totalTime4 = $courseLegBeginner->exercises()->sum('course_exercise.time');


        $courseLegBeginner->update([
            'total_calories' => $totalCalories4,
            'total_time' => $totalTime4
        ]);


        // Course 5
        $courseShoulderAndBackBeginner = Course::create([
            'name' => 'shoulder and back begginer ',
            'muscle' => 'shoulder and back',
            'level' => 'beginner',
        ]);

        $exer1 = Exercise::where('id',47)->first();
        $courseShoulderAndBackBeginner->exercises()->attach([$exer1->id], ['time' => 30]);

        $exer2 = Exercise::where('id',8)->first();
        $courseShoulderAndBackBeginner->exercises()->attach([$exer2->id], ['time' => 16]);

        $exer3 = Exercise::where('id',72)->first();
        $courseShoulderAndBackBeginner->exercises()->attach([$exer3->id], ['repetition' => 14, 'time' => 28]);

        $exer4 = Exercise::where('id',77)->first();
        $courseShoulderAndBackBeginner->exercises()->attach([$exer4->id], ['time' => 16]);

        $exer5 = Exercise::where('id',49)->first();
        $courseShoulderAndBackBeginner->exercises()->attach([$exer5->id], ['repetition' => 14, 'time' => 30]);

        $exer6 = Exercise::where('id',83)->first();
        $courseShoulderAndBackBeginner->exercises()->attach([$exer6->id], ['time' => 30]);

        $exer7 = Exercise::where('id',84)->first();
        $courseShoulderAndBackBeginner->exercises()->attach([$exer7->id], ['time' => 30]);

        $exer8 = Exercise::where('id',9)->first();
        $courseShoulderAndBackBeginner->exercises()->attach([$exer8->id], ['time' => 30]);

        $exer9 = Exercise::where('id',72)->first();
        $courseShoulderAndBackBeginner->exercises()->attach([$exer9->id], ['repetition' => 12, 'time' => 24]);

        $exer10 = Exercise::where('id',77)->first();
        $courseShoulderAndBackBeginner->exercises()->attach([$exer10->id], ['time' => 14]);

        $exer11 = Exercise::where('id',49)->first();
        $courseShoulderAndBackBeginner->exercises()->attach([$exer11->id], ['repetition' => 12, 'time' => 24]);

        $exer12 = Exercise::where('id',20)->first();
        $courseShoulderAndBackBeginner->exercises()->attach([$exer12->id], ['time' => 30]);

        $exer13 = Exercise::where('id',63)->first();
        $courseShoulderAndBackBeginner->exercises()->attach([$exer13->id], ['repetition' => 14, 'time' => 30]);

        $exer14 = Exercise::where('id',68)->first();
        $courseShoulderAndBackBeginner->exercises()->attach([$exer14->id], ['repetition' => 12, 'time' => 24]);

        $exer15 = Exercise::where('id',63)->first();
        $courseShoulderAndBackBeginner->exercises()->attach([$exer15->id], ['repetition' => 14, 'time' => 30]);

        $exer16 = Exercise::where('id',68)->first();
        $courseShoulderAndBackBeginner->exercises()->attach([$exer16->id], ['repetition' => 12, 'time' => 24]);

        $exer17 = Exercise::where('id',23)->first();
        $courseShoulderAndBackBeginner->exercises()->attach([$exer17->id], ['time' => 30]);

        $courseShoulderAndBackBeginner->load('exercises');
        $totalCalories5 = $courseShoulderAndBackBeginner->exercises()->sum('calories');
        $totalTime5 = $courseShoulderAndBackBeginner->exercises()->sum('course_exercise.time');


        $courseShoulderAndBackBeginner->update([
            'total_calories' => $totalCalories5,
            'total_time' => $totalTime5
        ]);



        // Course 6
        $courseabsIntermediate = Course::create([
            'name' => 'abs intermediate ',
            'muscle' => 'abs',
            'level' => 'intermediate',
        ]);


        $exe1 = Exercise::where('id',47)->first();
        $courseabsIntermediate->exercises()->attach([$exe1->id], ['time' => 30]);

        $exe1 = Exercise::where('id',40)->first();
        $courseabsIntermediate->exercises()->attach([$exe1->id], ['repetition' => 26, 'time' => 80]);

        $exe1 = Exercise::where('id',61)->first();
        $courseabsIntermediate->exercises()->attach([$exe1->id], ['repetition' => 20, 'time' => 20]);

        $exe1 = Exercise::where('id',16)->first();
        $courseabsIntermediate->exercises()->attach([$exe1->id], ['repetition' => 20, 'time' => 60]);

        $exe1 = Exercise::where('id',108)->first();
        $courseabsIntermediate->exercises()->attach([$exe1->id], ['repetition' => 20, 'time' => 40]);

        $exe1 = Exercise::where('id',1)->first();
        $courseabsIntermediate->exercises()->attach([$exe1->id], ['repetition' => 20, 'time' => 60]);

        $exe1 = Exercise::where('id',64)->first();
        $courseabsIntermediate->exercises()->attach([$exe1->id], ['time' => 30]);

        $exe1 = Exercise::where('id',56)->first();
        $courseabsIntermediate->exercises()->attach([$exe1->id], ['repetition' => 16, 'time' => 50]);

        $exe1 = Exercise::where('id',25)->first();
        $courseabsIntermediate->exercises()->attach([$exe1->id], ['repetition' => 20, 'time' => 40]);

        $exe1 = Exercise::where('id',24)->first();
        $courseabsIntermediate->exercises()->attach([$exe1->id], ['time' => 30]);

        $exe1 = Exercise::where('id',66)->first();
        $courseabsIntermediate->exercises()->attach([$exe1->id], ['repetition' => 20, 'time' => 40]);

        $exe1 = Exercise::where('id',78)->first();
        $courseabsIntermediate->exercises()->attach([$exe1->id], ['repetition' => 12, 'time' => 30]);

        $exe1 = Exercise::where('id',79)->first();
        $courseabsIntermediate->exercises()->attach([$exe1->id], ['repetition' => 12, 'time' => 30]);

        $exe1 = Exercise::where('id',87)->first();
        $courseabsIntermediate->exercises()->attach([$exe1->id], ['time' => 20]);

        $exe1 = Exercise::where('id',88)->first();
        $courseabsIntermediate->exercises()->attach([$exe1->id], ['time' => 20]);

        $exe1 = Exercise::where('id',94)->first();
        $courseabsIntermediate->exercises()->attach([$exe1->id], ['time' => 30]);

        $exe1 = Exercise::where('id',95)->first();
        $courseabsIntermediate->exercises()->attach([$exe1->id], ['time' => 30]);

        $courseabsIntermediate->load('exercises');
        $totalCalories6 = $courseabsIntermediate->exercises()->sum('calories');
        $totalTime6 = $courseabsIntermediate->exercises()->sum('course_exercise.time');


        $courseabsIntermediate->update([
            'total_calories' => $totalCalories6,
            'total_time' => $totalTime6
        ]);


        // Course 7
        $coursechestIntermediate = Course::create([
            'name' => 'chest intermediate ',
            'muscle' => 'chest',
            'level' => 'intermediate',
        ]);


        $ex1 = Exercise::where('id',47)->first();
        $coursechestIntermediate->exercises()->attach([$ex1->id], ['time' => 30]);

        $ex2 = Exercise::where('id',49)->first();
        $coursechestIntermediate->exercises()->attach([$ex2->id], ['repetition' => 16, 'time' => 30]);

        $ex3 = Exercise::where('id',41)->first();
        $coursechestIntermediate->exercises()->attach([$ex3->id], ['repetition' => 10, 'time' => 20]);

        $ex4 = Exercise::where('id',97)->first();
        $coursechestIntermediate->exercises()->attach([$ex4->id], ['repetition' => 12, 'time' => 20]);

        $ex5 = Exercise::where('id',49)->first();
        $coursechestIntermediate->exercises()->attach([$ex5->id], ['repetition' => 16, 'time' => 30]);

        $ex6 = Exercise::where('id',41)->first();
        $coursechestIntermediate->exercises()->attach([$ex6->id], ['repetition' => 10, 'time' => 20]);

        $ex7 = Exercise::where('id',97)->first();
        $coursechestIntermediate->exercises()->attach([$ex7->id], ['repetition' => 12, 'time' => 20]);

        $ex8 = Exercise::where('id',67)->first();
        $coursechestIntermediate->exercises()->attach([$ex8->id], ['repetition' => 12, 'time' => 24]);

        $ex9 = Exercise::where('id',114)->first();
        $coursechestIntermediate->exercises()->attach([$ex9->id], ['repetition' => 16, 'time' => 30]);

        $ex10 = Exercise::where('id',66)->first();
        $coursechestIntermediate->exercises()->attach([$ex10->id], ['repetition' => 10, 'time' => 80]);

        $ex11 = Exercise::where('id',27)->first();
        $coursechestIntermediate->exercises()->attach([$ex11->id], ['repetition' => 12, 'time' => 24]);

        $ex12 = Exercise::where('id',76)->first();
        $coursechestIntermediate->exercises()->attach([$ex12->id], ['time' => 30]);

        $ex13 = Exercise::where('id',24)->first();
        $coursechestIntermediate->exercises()->attach([$ex13->id], ['time' => 30]);

        $ex14 = Exercise::where('id',22)->first();
        $coursechestIntermediate->exercises()->attach([$ex14->id], ['time' => 30]);

        $coursechestIntermediate->load('exercises');
        $totalCalories7 = $coursechestIntermediate->exercises()->sum('calories');
        $totalTime7 = $coursechestIntermediate->exercises()->sum('course_exercise.time');


        $coursechestIntermediate->update([
            'total_calories' => $totalCalories7,
            'total_time' => $totalTime7
        ]);



        // Course 8
        $courseArmIntermediate = Course::create([
            'name' => 'arm intermediate ',
            'muscle' => 'arm',
            'level' => 'intermediate',
        ]);

        $e1 = Exercise::where('id',9)->first();
        $courseArmIntermediate->exercises()->attach([$e1->id], ['time' => 30]);

        $e2 = Exercise::where('id',4)->first();
        $courseArmIntermediate->exercises()->attach([$e2->id], ['time' => 30]);

        $e3 = Exercise::where('id',5)->first();
        $courseArmIntermediate->exercises()->attach([$e3->id], ['time' => 30]);

        $e4 = Exercise::where('id',36)->first();
        $courseArmIntermediate->exercises()->attach([$e4->id], ['repetition' => 12, 'time' => 24]);

        $e5 = Exercise::where('id',59)->first();
        $courseArmIntermediate->exercises()->attach([$e5->id], ['repetition' => 12, 'time' => 24]);

        $e6 = Exercise::where('id',2)->first();
        $courseArmIntermediate->exercises()->attach([$e6->id], ['time' => 30]);

        $e7 = Exercise::where('id',66)->first();
        $courseArmIntermediate->exercises()->attach([$e7->id], ['repetition' => 12, 'time' => 24]);

        $e8 = Exercise::where('id',54)->first();
        $courseArmIntermediate->exercises()->attach([$e8->id], ['repetition' => 10, 'time' => 20]);

        $e9 = Exercise::where('id',55)->first();
        $courseArmIntermediate->exercises()->attach([$e9->id], ['repetition' => 10, 'time' => 20]);

        $e10 = Exercise::where('id',67)->first();
        $courseArmIntermediate->exercises()->attach([$e10->id], ['repetition' => 12, 'time' => 24]);

        $e11 = Exercise::where('id',92)->first();
        $courseArmIntermediate->exercises()->attach([$e11->id], ['time' => 30]);

        $e12 = Exercise::where('id',15)->first();
        $courseArmIntermediate->exercises()->attach([$e12->id], ['repetition' => 8, 'time' => 24]);

        $e13 = Exercise::where('id',36)->first();
        $courseArmIntermediate->exercises()->attach([$e13->id], ['repetition' => 12, 'time' => 24]);

        $e14 = Exercise::where('id',59)->first();
        $courseArmIntermediate->exercises()->attach([$e14->id], ['repetition' => 12, 'time' => 24]);

        $e15 = Exercise::where('id',2)->first();
        $courseArmIntermediate->exercises()->attach([$e15->id], ['time' => 30]);

        $e16 = Exercise::where('id',66)->first();
        $courseArmIntermediate->exercises()->attach([$e16->id], ['repetition' => 12, 'time' => 24]);

        $e17 = Exercise::where('id',54)->first();
        $courseArmIntermediate->exercises()->attach([$e17->id], ['repetition' => 10, 'time' => 20]);

        $e18 = Exercise::where('id',55)->first();
        $courseArmIntermediate->exercises()->attach([$e18->id], ['repetition' => 10, 'time' => 20]);

        $e19 = Exercise::where('id',67)->first();
        $courseArmIntermediate->exercises()->attach([$e19->id], ['repetition' => 12, 'time' => 24]);

        $e20 = Exercise::where('id',92)->first();
        $courseArmIntermediate->exercises()->attach([$e20->id], ['time' => 30]);

        $e21 = Exercise::where('id',15)->first();
        $courseArmIntermediate->exercises()->attach([$e21->id], ['repetition' => 8, 'time' => 24]);

        $e22 = Exercise::where('id',106)->first();
        $courseArmIntermediate->exercises()->attach([$e22->id], ['time' => 30]);

        $e23 = Exercise::where('id',107)->first();
        $courseArmIntermediate->exercises()->attach([$e23->id], ['time' => 30]);

        $e24 = Exercise::where('id',98)->first();
        $courseArmIntermediate->exercises()->attach([$e24->id], ['time' => 30]);

        $e25 = Exercise::where('id',99)->first();
        $courseArmIntermediate->exercises()->attach([$e25->id], ['time' => 30]);

        $courseArmIntermediate->load('exercises');
        $totalCalories8 = $courseArmIntermediate->exercises()->sum('calories');
        $totalTime8 = $courseArmIntermediate->exercises()->sum('course_exercise.time');


        $courseArmIntermediate->update([
            'total_calories' => $totalCalories8,
            'total_time' => $totalTime8
        ]);



        // Course 9
        $courseLegIntermediate = Course::create([
            'name' => 'leg intermediate ',
            'muscle' => 'leg',
            'level' => 'intermediate',
        ]);

        $ee1 = Exercise::where('id',47)->first();
        $courseLegIntermediate->exercises()->attach([$ee1->id], ['time' => 30]);

        $ee2 = Exercise::where('id',113)->first();
        $courseLegIntermediate->exercises()->attach([$ee2->id], ['time' => 30]);

        $ee3 = Exercise::where('id',96)->first();
        $courseLegIntermediate->exercises()->attach([$ee3->id], ['repetition' => 12, 'time' => 24]);

        $ee4 = Exercise::where('id',34)->first();
        $courseLegIntermediate->exercises()->attach([$ee4->id], ['repetition' => 12, 'time' => 36]);

        $ee5 = Exercise::where('id',35)->first();
        $courseLegIntermediate->exercises()->attach([$ee5->id], ['repetition' => 12, 'time' => 36]);

        $ee6 = Exercise::where('id',100)->first();
        $courseLegIntermediate->exercises()->attach([$ee6->id], ['repetition' => 12, 'time' => 24]);

        $ee7 = Exercise::where('id',69)->first();
        $courseLegIntermediate->exercises()->attach([$ee7->id], ['repetition' => 12, 'time' => 24]);

        $ee8 = Exercise::where('id',17)->first();
        $courseLegIntermediate->exercises()->attach([$ee8->id], ['repetition' => 12, 'time' => 24]);

        $ee9 = Exercise::where('id',57)->first();
        $courseLegIntermediate->exercises()->attach([$ee9->id], ['repetition' => 14, 'time' => 28]);

        $ee10 = Exercise::where('id',81)->first();
        $courseLegIntermediate->exercises()->attach([$ee10->id], ['repetition' => 12, 'time' => 24]);

        $ee11 = Exercise::where('id',82)->first();
        $courseLegIntermediate->exercises()->attach([$ee11->id], ['repetition' => 12, 'time' => 24]);

        $ee12 = Exercise::where('id',89)->first();
        $courseLegIntermediate->exercises()->attach([$ee12->id], ['repetition' => 12, 'time' => 12]);

        $ee13 = Exercise::where('id',90)->first();
        $courseLegIntermediate->exercises()->attach([$ee13->id], ['repetition' => 12, 'time' => 12]);

        $ee14 = Exercise::where('id',96)->first();
        $courseLegIntermediate->exercises()->attach([$ee14->id], ['repetition' => 12, 'time' => 24]);

        $ee15 = Exercise::where('id',34)->first();
        $courseLegIntermediate->exercises()->attach([$ee15->id], ['repetition' => 12, 'time' => 36]);

        $ee16 = Exercise::where('id',35)->first();
        $courseLegIntermediate->exercises()->attach([$ee16->id], ['repetition' => 12, 'time' => 36]);

        $ee17 = Exercise::where('id',100)->first();
        $courseLegIntermediate->exercises()->attach([$ee17->id], ['repetition' => 12, 'time' => 24]);

        $ee18 = Exercise::where('id',69)->first();
        $courseLegIntermediate->exercises()->attach([$ee18->id], ['repetition' => 12, 'time' => 24]);

        $ee19 = Exercise::where('id',17)->first();
        $courseLegIntermediate->exercises()->attach([$ee19->id], ['repetition' => 12, 'time' => 24]);

        $ee20 = Exercise::where('id',57)->first();
        $courseLegIntermediate->exercises()->attach([$ee20->id], ['repetition' => 14, 'time' => 28]);

        $ee21 = Exercise::where('id',81)->first();
        $courseLegIntermediate->exercises()->attach([$ee21->id], ['repetition' => 12, 'time' => 24]);

        $ee22 = Exercise::where('id',82)->first();
        $courseLegIntermediate->exercises()->attach([$ee22->id], ['repetition' => 12, 'time' => 24]);

        $ee23 = Exercise::where('id',89)->first();
        $courseLegIntermediate->exercises()->attach([$ee23->id], ['repetition' => 12, 'time' => 12]);

        $ee24 = Exercise::where('id',90)->first();
        $courseLegIntermediate->exercises()->attach([$ee24->id], ['repetition' => 12, 'time' => 12]);

        $ee25 = Exercise::where('id',96)->first();
        $courseLegIntermediate->exercises()->attach([$ee25->id], ['repetition' => 12, 'time' => 24]);

        $ee26 = Exercise::where('id',34)->first();
        $courseLegIntermediate->exercises()->attach([$ee26->id], ['repetition' => 12, 'time' => 36]);

        $ee27 = Exercise::where('id',35)->first();
        $courseLegIntermediate->exercises()->attach([$ee27->id], ['repetition' => 12, 'time' => 36]);

        $ee28 = Exercise::where('id',100)->first();
        $courseLegIntermediate->exercises()->attach([$ee28->id], ['repetition' => 12, 'time' => 24]);

        $ee29 = Exercise::where('id',69)->first();
        $courseLegIntermediate->exercises()->attach([$ee29->id], ['repetition' => 12, 'time' => 24]);

        $ee30 = Exercise::where('id',17)->first();
        $courseLegIntermediate->exercises()->attach([$ee30->id], ['repetition' => 12, 'time' => 24]);

        $ee31 = Exercise::where('id',18)->first();
        $courseLegIntermediate->exercises()->attach([$ee31->id], ['time' => 30]);

        $ee32 = Exercise::where('id',19)->first();
        $courseLegIntermediate->exercises()->attach([$ee32->id], ['time' => 30]);

        $ee33 = Exercise::where('id',53)->first();
        $courseLegIntermediate->exercises()->attach([$ee33->id], ['time' => 30]);

        $ee34 = Exercise::where('id',73)->first();
        $courseLegIntermediate->exercises()->attach([$ee34->id], ['time' => 30]);

        $ee35 = Exercise::where('id',50)->first();
        $courseLegIntermediate->exercises()->attach([$ee35->id], ['time' => 30]);

        $ee36 = Exercise::where('id',51)->first();
        $courseLegIntermediate->exercises()->attach([$ee36->id], ['time' => 30]);

        $courseLegIntermediate->load('exercises');
        $totalCalories9 = $courseLegIntermediate->exercises()->sum('calories');
        $totalTime9 = $courseLegIntermediate->exercises()->sum('course_exercise.time');


        $courseLegIntermediate->update([
            'total_calories' => $totalCalories9,
            'total_time' => $totalTime9
        ]);



        // Course 10
        $courseBackAndShoulderIntermediate = Course::create([
            'name' => 'shoulder and back intermediate ',
            'muscle' => 'shoulder and back',
            'level' => 'intermediate',
        ]);

        $eex1 = Exercise::where('id',47)->first();
        $courseBackAndShoulderIntermediate->exercises()->attach([$eex1->id], ['time' => 30]);

        $eex2 = Exercise::where('id',46)->first();
        $courseBackAndShoulderIntermediate->exercises()->attach([$eex2->id], ['repetition' => 12, 'time' => 24]);

        $eex3 = Exercise::where('id',105)->first();
        $courseBackAndShoulderIntermediate->exercises()->attach([$eex3->id], ['repetition' => 12, 'time' => 24]);

        $eex4 = Exercise::where('id',36)->first();
        $courseBackAndShoulderIntermediate->exercises()->attach([$eex4->id], ['repetition' => 14, 'time' => 28]);

        $eex5 = Exercise::where('id',43)->first();
        $courseBackAndShoulderIntermediate->exercises()->attach([$eex5->id], ['repetition' => 12, 'time' => 24]);

        $eex6 = Exercise::where('id',103)->first();
        $courseBackAndShoulderIntermediate->exercises()->attach([$eex6->id], ['repetition' => 12, 'time' => 24]);

        $eex7 = Exercise::where('id',46)->first();
        $courseBackAndShoulderIntermediate->exercises()->attach([$eex7->id], ['repetition' => 12, 'time' => 24]);

        $eex8 = Exercise::where('id',105)->first();
        $courseBackAndShoulderIntermediate->exercises()->attach([$eex8->id], ['repetition' => 12, 'time' => 24]);

        $eex9 = Exercise::where('id',36)->first();
        $courseBackAndShoulderIntermediate->exercises()->attach([$eex9->id], ['repetition' => 14, 'time' => 28]);

        $eex10 = Exercise::where('id',43)->first();
        $courseBackAndShoulderIntermediate->exercises()->attach([$eex10->id], ['repetition' => 12, 'time' => 24]);

        $eex11 = Exercise::where('id',103)->first();
        $courseBackAndShoulderIntermediate->exercises()->attach([$eex11->id], ['repetition' => 12, 'time' => 24]);

        $eex12 = Exercise::where('id',72)->first();
        $courseBackAndShoulderIntermediate->exercises()->attach([$eex12->id], ['repetition' => 12, 'time' => 24]);

        $eex13 = Exercise::where('id',42)->first();
        $courseBackAndShoulderIntermediate->exercises()->attach([$eex13->id], ['repetition' => 10, 'time' => 60]);

        $eex14 = Exercise::where('id',23)->first();
        $courseBackAndShoulderIntermediate->exercises()->attach([$eex14->id], ['time' => 30]);

        $eex15 = Exercise::where('id',20)->first();
        $courseBackAndShoulderIntermediate->exercises()->attach([$eex15->id], ['time' => 30]);

        $eex16 = Exercise::where('id',83)->first();
        $courseBackAndShoulderIntermediate->exercises()->attach([$eex16->id], ['time' => 30]);

        $eex17 = Exercise::where('id',84)->first();
        $courseBackAndShoulderIntermediate->exercises()->attach([$eex17->id], ['time' => 30]);

        $courseBackAndShoulderIntermediate->load('exercises');
        $totalCalories10 = $courseBackAndShoulderIntermediate->exercises()->sum('calories');
        $totalTime10 = $courseBackAndShoulderIntermediate->exercises()->sum('course_exercise.time');


        $courseBackAndShoulderIntermediate->update([
            'total_calories' => $totalCalories10,
            'total_time' => $totalTime10
        ]);



        // Course 11
        $courseAbsAdvanced = Course::create([
            'name' => 'abs advanced',
            'muscle' => 'abs',
            'level' => 'advanced',
        ]);

        $eexe1 = Exercise::where('id',47)->first();
        $courseAbsAdvanced->exercises()->attach([$eexe1->id], ['time' => 30]);

        $eexe2 = Exercise::where('id',91)->first();
        $courseAbsAdvanced->exercises()->attach([$eexe2->id], ['repetition' => 20, 'time' => 40]);

        $eexe3 = Exercise::where('id',78)->first();
        $courseAbsAdvanced->exercises()->attach([$eexe3->id], ['repetition' => 20, 'time' => 40]);

        $eexe4 = Exercise::where('id',79)->first();
        $courseAbsAdvanced->exercises()->attach([$eexe4->id], ['repetition' => 20, 'time' => 40]);

        $eexe5 = Exercise::where('id',1)->first();
        $courseAbsAdvanced->exercises()->attach([$eexe5->id], ['repetition' => 30, 'time' => 60]);

        $eexe6 = Exercise::where('id',11)->first();
        $courseAbsAdvanced->exercises()->attach([$eexe6->id], ['repetition' => 24, 'time' => 24]);

        $eexe7 = Exercise::where('id',87)->first();
        $courseAbsAdvanced->exercises()->attach([$eexe7->id], ['time' => 20]);

        $eexe8 = Exercise::where('id',88)->first();
        $courseAbsAdvanced->exercises()->attach([$eexe8->id], ['time' => 20]);

        $eexe9 = Exercise::where('id',108)->first();
        $courseAbsAdvanced->exercises()->attach([$eexe9->id], ['repetition' => 18, 'time' => 36]);

        $eexe10 = Exercise::where('id',66)->first();
        $courseAbsAdvanced->exercises()->attach([$eexe10->id], ['repetition' => 24, 'time' => 192]);

        $eexe11 = Exercise::where('id',74)->first();
        $courseAbsAdvanced->exercises()->attach([$eexe11->id], ['repetition' => 48, 'time' => 96]);

        $eexe12 = Exercise::where('id',1)->first();
        $courseAbsAdvanced->exercises()->attach([$eexe12->id], ['repetition' => 48, 'time' => 96]);

        $eexe13 = Exercise::where('id',16)->first();
        $courseAbsAdvanced->exercises()->attach([$eexe13->id], ['repetition' => 30, 'time' => 90]);

        $eexe14 = Exercise::where('id',40)->first();
        $courseAbsAdvanced->exercises()->attach([$eexe14->id], ['repetition' => 34, 'time' => 68]);

        $eexe15 = Exercise::where('id',61)->first();
        $courseAbsAdvanced->exercises()->attach([$eexe15->id], ['repetition' => 30, 'time' => 30]);

        $eexe16 = Exercise::where('id',25)->first();
        $courseAbsAdvanced->exercises()->attach([$eexe16->id], ['repetition' => 24, 'time' => 96]);

        $eexe17 = Exercise::where('id',108)->first();
        $courseAbsAdvanced->exercises()->attach([$eexe17->id], ['repetition' => 16, 'time' => 32]);

        $eexe18 = Exercise::where('id',64)->first();
        $courseAbsAdvanced->exercises()->attach([$eexe18->id], ['time' => 60]);

        $eexe19 = Exercise::where('id',24)->first();
        $courseAbsAdvanced->exercises()->attach([$eexe19->id], ['time' => 30]);

        $eexe20 = Exercise::where('id',94)->first();
        $courseAbsAdvanced->exercises()->attach([$eexe20->id], ['time' => 30]);

        $eexe21 = Exercise::where('id',95)->first();
        $courseAbsAdvanced->exercises()->attach([$eexe21->id], ['time' => 30]);

        $courseAbsAdvanced->load('exercises');
        $totalCalories11 = $courseAbsAdvanced->exercises()->sum('calories');
        $totalTime11 = $courseAbsAdvanced->exercises()->sum('course_exercise.time');


        $courseAbsAdvanced->update([
            'total_calories' => $totalCalories11,
            'total_time' => $totalTime11
        ]);



        // Course 12
        $courseChestAdvanced = Course::create([
            'name' => 'chest advanced',
            'muscle' => 'chest',
            'level' => 'advanced',
        ]);

        $eexer1 = Exercise::where('id',47)->first();
        $courseChestAdvanced->exercises()->attach([$eexer1->id], ['time' => 30]);

        $eexer2 = Exercise::where('id',3)->first();
        $courseChestAdvanced->exercises()->attach([$eexer2->id], ['repetition' => 20, 'time' => 24]);

        $eexer3 = Exercise::where('id',76)->first();
        $courseChestAdvanced->exercises()->attach([$eexer3->id], ['time' => 30]);

        $eexer4 = Exercise::where('id',15)->first();
        $courseChestAdvanced->exercises()->attach([$eexer4->id], ['repetition' => 10, 'time' => 30]);

        $eexer5 = Exercise::where('id',41)->first();
        $courseChestAdvanced->exercises()->attach([$eexer5->id], ['repetition' => 16, 'time' => 48]);

        $eexer6 = Exercise::where('id',76)->first();
        $courseChestAdvanced->exercises()->attach([$eexer6->id], ['time' => 30]);

        $eexer7 = Exercise::where('id',15)->first();
        $courseChestAdvanced->exercises()->attach([$eexer7->id], ['repetition' => 10, 'time' => 30]);

        $eexer8 = Exercise::where('id',41)->first();
        $courseChestAdvanced->exercises()->attach([$eexer8->id], ['repetition' => 16, 'time' => 48]);

        $eexer9 = Exercise::where('id',66)->first();
        $courseChestAdvanced->exercises()->attach([$eexer9->id], ['repetition' => 12, 'time' => 96]);

        $eexer10 = Exercise::where('id',97)->first();
        $courseChestAdvanced->exercises()->attach([$eexer10->id], ['repetition' => 12, 'time' => 36]);

        $eexer11 = Exercise::where('id',29)->first();
        $courseChestAdvanced->exercises()->attach([$eexer11->id], ['repetition' => 16, 'time' => 32]);

        $eexer12 = Exercise::where('id',14)->first();
        $courseChestAdvanced->exercises()->attach([$eexer12->id], ['repetition' => 12, 'time' => 32]);

        $eexer13 = Exercise::where('id',93)->first();
        $courseChestAdvanced->exercises()->attach([$eexer13->id], ['repetition' => 20, 'time' => 40]);

        $eexer14 = Exercise::where('id',27)->first();
        $courseChestAdvanced->exercises()->attach([$eexer14->id], ['repetition' => 12, 'time' => 24]);

        $eexer15 = Exercise::where('id',24)->first();
        $courseChestAdvanced->exercises()->attach([$eexer15->id], ['time' => 30]);

        $eexer16 = Exercise::where('id',22)->first();
        $courseChestAdvanced->exercises()->attach([$eexer16->id], ['time' => 30]);

        $courseChestAdvanced->load('exercises');
        $totalCalories12 = $courseChestAdvanced->exercises()->sum('calories');
        $totalTime12 = $courseChestAdvanced->exercises()->sum('course_exercise.time');


        $courseChestAdvanced->update([
            'total_calories' => $totalCalories12,
            'total_time' => $totalTime12
        ]);



        // Course 13
        $courseArmAdvanced = Course::create([
            'name' => 'arm advanced',
            'muscle' => 'arm',
            'level' => 'advanced',
        ]);

        $eexerc1 = Exercise::where('id',4)->first();
        $courseArmAdvanced->exercises()->attach([$eexerc1->id], ['time' => 30]);

        $eexerc2 = Exercise::where('id',5)->first();
        $courseArmAdvanced->exercises()->attach([$eexerc2->id], ['time' => 30]);

        $eexerc3 = Exercise::where('id',92)->first();
        $courseArmAdvanced->exercises()->attach([$eexerc3->id], ['time' => 30]);

        $eexerc4 = Exercise::where('id',2)->first();
        $courseArmAdvanced->exercises()->attach([$eexerc4->id], ['time' => 30]);

        $eexerc5 = Exercise::where('id',6)->first();
        $courseArmAdvanced->exercises()->attach([$eexerc5->id], ['repetition' => 12, 'time' => 48]);

        $eexerc6 = Exercise::where('id',7)->first();
        $courseArmAdvanced->exercises()->attach([$eexerc6->id], ['repetition' => 12, 'time' => 48]);

        $eexerc7 = Exercise::where('id',36)->first();
        $courseArmAdvanced->exercises()->attach([$eexerc7->id], ['repetition' => 16, 'time' => 32]);

        $eexerc8 = Exercise::where('id',59)->first();
        $courseArmAdvanced->exercises()->attach([$eexerc8->id], ['repetition' => 12, 'time' => 24]);

        $eexerc9 = Exercise::where('id',75)->first();
        $courseArmAdvanced->exercises()->attach([$eexerc9->id], ['repetition' => 16, 'time' => 32]);

        $eexerc10 = Exercise::where('id',2)->first();
        $courseArmAdvanced->exercises()->attach([$eexerc10->id], ['time' => 30]);

        $eexerc11 = Exercise::where('id',6)->first();
        $courseArmAdvanced->exercises()->attach([$eexerc11->id], ['repetition' => 12, 'time' => 48]);

        $eexerc12 = Exercise::where('id',7)->first();
        $courseArmAdvanced->exercises()->attach([$eexerc12->id], ['repetition' => 12, 'time' => 48]);

        $eexerc13 = Exercise::where('id',36)->first();
        $courseArmAdvanced->exercises()->attach([$eexerc13->id], ['repetition' => 16, 'time' => 32]);

        $eexerc14 = Exercise::where('id',59)->first();
        $courseArmAdvanced->exercises()->attach([$eexerc14->id], ['repetition' => 12, 'time' => 24]);

        $eexerc15 = Exercise::where('id',75)->first();
        $courseArmAdvanced->exercises()->attach([$eexerc15->id], ['repetition' => 16, 'time' => 32]);

        $eexerc16 = Exercise::where('id',54)->first();
        $courseArmAdvanced->exercises()->attach([$eexerc16->id], ['repetition' => 16, 'time' => 32]);

        $eexerc17 = Exercise::where('id',55)->first();
        $courseArmAdvanced->exercises()->attach([$eexerc17->id], ['repetition' => 16, 'time' => 32]);

        $eexerc18 = Exercise::where('id',15)->first();
        $courseArmAdvanced->exercises()->attach([$eexerc18->id], ['repetition' => 16, 'time' => 64]);

        $eexerc19 = Exercise::where('id',32)->first();
        $courseArmAdvanced->exercises()->attach([$eexerc19->id], ['repetition' => 8, 'time' => 24]);

        $eexerc20 = Exercise::where('id',33)->first();
        $courseArmAdvanced->exercises()->attach([$eexerc20->id], ['repetition' => 8, 'time' => 24]);

        $eexerc21 = Exercise::where('id',66)->first();
        $courseArmAdvanced->exercises()->attach([$eexerc21->id], ['repetition' => 12, 'time' => 24]);

        $eexerc22 = Exercise::where('id',15)->first();
        $courseArmAdvanced->exercises()->attach([$eexerc22->id], ['repetition' => 16, 'time' => 64]);

        $eexerc23 = Exercise::where('id',60)->first();
        $courseArmAdvanced->exercises()->attach([$eexerc23->id], ['time' => 30]);

        $eexerc24 = Exercise::where('id',21)->first();
        $courseArmAdvanced->exercises()->attach([$eexerc24->id], ['time' => 18]);

        $eexerc25 = Exercise::where('id',106)->first();
        $courseArmAdvanced->exercises()->attach([$eexerc25->id], ['time' => 30]);

        $eexerc26 = Exercise::where('id',107)->first();
        $courseArmAdvanced->exercises()->attach([$eexerc26->id], ['time' => 30]);

        $eexerc27 = Exercise::where('id',98)->first();
        $courseArmAdvanced->exercises()->attach([$eexerc27->id], ['time' => 30]);

        $eexerc28 = Exercise::where('id',99)->first();
        $courseArmAdvanced->exercises()->attach([$eexerc28->id], ['time' => 30]);

        $courseArmAdvanced->load('exercises');
        $totalCalories13 = $courseArmAdvanced->exercises()->sum('calories');
        $totalTime13 = $courseArmAdvanced->exercises()->sum('course_exercise.time');


        $courseArmAdvanced->update([
            'total_calories' => $totalCalories13,
            'total_time' => $totalTime13
        ]);


        // Course 14
        $courseLegAdvanced = Course::create([
            'name' => 'leg advanced',
            'muscle' => 'leg',
            'level' => 'advanced',
        ]);

        $eexerci1 = Exercise::where('id',15)->first();
        $courseLegAdvanced->exercises()->attach([$eexerci1->id], ['repetition' => 10, 'time' => 30]);

        $eexerci2 = Exercise::where('id',96)->first();
        $courseLegAdvanced->exercises()->attach([$eexerci2->id], ['repetition' => 14, 'time' => 28]);

        $eexerci3 = Exercise::where('id',12)->first();
        $courseLegAdvanced->exercises()->attach([$eexerci3->id], ['repetition' => 12, 'time' => 24]);

        $eexerci4 = Exercise::where('id',13)->first();
        $courseLegAdvanced->exercises()->attach([$eexerci4->id], ['repetition' => 12, 'time' => 24]);

        $eexerci5 = Exercise::where('id',26)->first();
        $courseLegAdvanced->exercises()->attach([$eexerci5->id], ['repetition' => 14, 'time' => 52]);

        $eexerci6 = Exercise::where('id',81)->first();
        $courseLegAdvanced->exercises()->attach([$eexerci6->id], ['repetition' => 12, 'time' => 24]);

        $eexerci7 = Exercise::where('id',82)->first();
        $courseLegAdvanced->exercises()->attach([$eexerci7->id], ['repetition' => 12, 'time' => 24]);

        $eexerci8 = Exercise::where('id',48)->first();
        $courseLegAdvanced->exercises()->attach([$eexerci8->id], ['repetition' => 12, 'time' => 24]);

        $eexerci9 = Exercise::where('id',38)->first();
        $courseLegAdvanced->exercises()->attach([$eexerci9->id], ['repetition' => 12, 'time' => 52]);

        $eexerci10 = Exercise::where('id',39)->first();
        $courseLegAdvanced->exercises()->attach([$eexerci10->id], ['repetition' => 12, 'time' => 52]);

        $eexerci11 = Exercise::where('id',52)->first();
        $courseLegAdvanced->exercises()->attach([$eexerci11->id], ['repetition' => 16, 'time' => 32]);

        $eexerci12 = Exercise::where('id',111)->first();
        $courseLegAdvanced->exercises()->attach([$eexerci12->id], ['repetition' => 16, 'time' => 32]);

        $eexerci13 = Exercise::where('id',112)->first();
        $courseLegAdvanced->exercises()->attach([$eexerci13->id], ['repetition' => 16, 'time' => 32]);

        $eexerci14 = Exercise::where('id',96)->first();
        $courseLegAdvanced->exercises()->attach([$eexerci14->id], ['repetition' => 14, 'time' => 28]);

        $eexerci15 = Exercise::where('id',12)->first();
        $courseLegAdvanced->exercises()->attach([$eexerci15->id], ['repetition' => 12, 'time' => 24]);

        $eexerci16 = Exercise::where('id',13)->first();
        $courseLegAdvanced->exercises()->attach([$eexerci16->id], ['repetition' => 12, 'time' => 24]);

        $eexerci17 = Exercise::where('id',26)->first();
        $courseLegAdvanced->exercises()->attach([$eexerci17->id], ['repetition' => 14, 'time' => 52]);

        $eexerci18 = Exercise::where('id',81)->first();
        $courseLegAdvanced->exercises()->attach([$eexerci18->id], ['repetition' => 12, 'time' => 24]);

        $eexerci19 = Exercise::where('id',82)->first();
        $courseLegAdvanced->exercises()->attach([$eexerci19->id], ['repetition' => 12, 'time' => 24]);

        $eexerci20 = Exercise::where('id',48)->first();
        $courseLegAdvanced->exercises()->attach([$eexerci20->id], ['repetition' => 12, 'time' => 24]);

        $eexerci21 = Exercise::where('id',38)->first();
        $courseLegAdvanced->exercises()->attach([$eexerci21->id], ['repetition' => 12, 'time' => 52]);

        $eexerci22 = Exercise::where('id',39)->first();
        $courseLegAdvanced->exercises()->attach([$eexerci22->id], ['repetition' => 12, 'time' => 52]);

        $eexerci23 = Exercise::where('id',52)->first();
        $courseLegAdvanced->exercises()->attach([$eexerci23->id], ['repetition' => 16, 'time' => 32]);

        $eexerci24 = Exercise::where('id',111)->first();
        $courseLegAdvanced->exercises()->attach([$eexerci24->id], ['repetition' => 16, 'time' => 32]);

        $eexerci25 = Exercise::where('id',112)->first();
        $courseLegAdvanced->exercises()->attach([$eexerci15->id], ['repetition' => 16, 'time' => 32]);

        $eexerci26 = Exercise::where('id',96)->first();
        $courseLegAdvanced->exercises()->attach([$eexerci26->id], ['repetition' => 14, 'time' => 28]);

        $eexerci27 = Exercise::where('id',12)->first();
        $courseLegAdvanced->exercises()->attach([$eexerci27->id], ['repetition' => 12, 'time' => 24]);

        $eexerci28 = Exercise::where('id',13)->first();
        $courseLegAdvanced->exercises()->attach([$eexerci28->id], ['repetition' => 12, 'time' => 24]);

        $eexerci29 = Exercise::where('id',26)->first();
        $courseLegAdvanced->exercises()->attach([$eexerci29->id], ['repetition' => 14, 'time' => 52]);

        $eexerci30 = Exercise::where('id',81)->first();
        $courseLegAdvanced->exercises()->attach([$eexerci30->id], ['repetition' => 12, 'time' => 24]);

        $eexerci31 = Exercise::where('id',82)->first();
        $courseLegAdvanced->exercises()->attach([$eexerci31->id], ['repetition' => 12, 'time' => 24]);

        $eexerci32 = Exercise::where('id',48)->first();
        $courseLegAdvanced->exercises()->attach([$eexerci32->id], ['repetition' => 12, 'time' => 24]);

        $eexerci33 = Exercise::where('id',38)->first();
        $courseLegAdvanced->exercises()->attach([$eexerci33->id], ['repetition' => 12, 'time' => 52]);

        $eexerci34 = Exercise::where('id',39)->first();
        $courseLegAdvanced->exercises()->attach([$eexerci34->id], ['repetition' => 12, 'time' => 52]);

        $eexerci35 = Exercise::where('id',52)->first();
        $courseLegAdvanced->exercises()->attach([$eexerci35->id], ['repetition' => 16, 'time' => 32]);

        $eexerci36 = Exercise::where('id',111)->first();
        $courseLegAdvanced->exercises()->attach([$eexerci36->id], ['repetition' => 16, 'time' => 32]);

        $eexerci37 = Exercise::where('id',112)->first();
        $courseLegAdvanced->exercises()->attach([$eexerci37->id], ['repetition' => 16, 'time' => 32]);

        $eexerci38 = Exercise::where('id',113)->first();
        $courseLegAdvanced->exercises()->attach([$eexerci38->id], ['time' => 40]);

        $eexerci39 = Exercise::where('id',73)->first();
        $courseLegAdvanced->exercises()->attach([$eexerci39->id], ['time' => 30]);

        $eexerci40 = Exercise::where('id',53)->first();
        $courseLegAdvanced->exercises()->attach([$eexerci40->id], ['time' => 30]);

        $eexerci41 = Exercise::where('id',58)->first();
        $courseLegAdvanced->exercises()->attach([$eexerci41->id], ['time' => 30]);

        $eexerci42 = Exercise::where('id',18)->first();
        $courseLegAdvanced->exercises()->attach([$eexerci42->id], ['time' => 30]);

        $eexerci43 = Exercise::where('id',19)->first();
        $courseLegAdvanced->exercises()->attach([$eexerci43->id], ['time' => 30]);

        $courseLegAdvanced->load('exercises');
        $totalCalories14 = $courseLegAdvanced->exercises()->sum('calories');
        $totalTime14 = $courseLegAdvanced->exercises()->sum('course_exercise.time');


        $courseLegAdvanced->update([
            'total_calories' => $totalCalories14,
            'total_time' => $totalTime14
        ]);


        // Course 15
        $courseBackAndShoulderAdvanced = Course::create([
            'name' => 'shoulder and back advanced',
            'muscle' => 'shoulder and back',
            'level' => 'advanced',
        ]);

        $eexercis1 = Exercise::where('id',47)->first();
        $courseBackAndShoulderAdvanced->exercises()->attach([$eexercis1->id], ['time' => 30]);

        $eexercis2 = Exercise::where('id',46)->first();
        $courseBackAndShoulderAdvanced->exercises()->attach([$eexercis2->id], ['repetition' => 16, 'time' => 64]);

        $eexercis3 = Exercise::where('id',44)->first();
        $courseBackAndShoulderAdvanced->exercises()->attach([$eexercis3->id], ['repetition' => 14, 'time' => 28]);

        $eexercis4 = Exercise::where('id',70)->first();
        $courseBackAndShoulderAdvanced->exercises()->attach([$eexercis4->id], ['repetition' => 10, 'time' => 30]);

        $eexercis5 = Exercise::where('id',62)->first();
        $courseBackAndShoulderAdvanced->exercises()->attach([$eexercis5->id], ['repetition' => 12, 'time' => 24]);

        $eexercis6 = Exercise::where('id',102)->first();
        $courseBackAndShoulderAdvanced->exercises()->attach([$eexercis6->id], ['repetition' => 12, 'time' => 24]);

        $eexercis7 = Exercise::where('id',46)->first();
        $courseBackAndShoulderAdvanced->exercises()->attach([$eexercis7->id], ['repetition' => 16, 'time' => 64]);

        $eexercis8 = Exercise::where('id',44)->first();
        $courseBackAndShoulderAdvanced->exercises()->attach([$eexercis8->id], ['repetition' => 14, 'time' => 28]);

        $eexercis9 = Exercise::where('id',70)->first();
        $courseBackAndShoulderAdvanced->exercises()->attach([$eexercis9->id], ['repetition' => 10, 'time' => 30]);

        $eexercis10 = Exercise::where('id',62)->first();
        $courseBackAndShoulderAdvanced->exercises()->attach([$eexercis10->id], ['repetition' => 12, 'time' => 24]);

        $eexercis11 = Exercise::where('id',102)->first();
        $courseBackAndShoulderAdvanced->exercises()->attach([$eexercis11->id], ['repetition' => 12, 'time' => 24]);

        $eexercis12 = Exercise::where('id',20)->first();
        $courseBackAndShoulderAdvanced->exercises()->attach([$eexercis12->id], ['time' => 30]);

        $eexercis13 = Exercise::where('id',23)->first();
        $courseBackAndShoulderAdvanced->exercises()->attach([$eexercis13->id], ['time' => 30]);

        $eexercis14 = Exercise::where('id',37)->first();
        $courseBackAndShoulderAdvanced->exercises()->attach([$eexercis14->id], ['repetition' => 14, 'time' => 28]);

        $eexercis15 = Exercise::where('id',71)->first();
        $courseBackAndShoulderAdvanced->exercises()->attach([$eexercis15->id], ['repetition' => 12, 'time' => 36]);

        $eexercis16 = Exercise::where('id',83)->first();
        $courseBackAndShoulderAdvanced->exercises()->attach([$eexercis16->id], ['time' => 30]);

        $eexercis17 = Exercise::where('id',84)->first();
        $courseBackAndShoulderAdvanced->exercises()->attach([$eexercis17->id], ['time' => 30]);

        $courseBackAndShoulderAdvanced->load('exercises');
        $totalCalories15 = $courseBackAndShoulderAdvanced->exercises()->sum('calories');
        $totalTime15 = $courseBackAndShoulderAdvanced->exercises()->sum('course_exercise.time');


        $courseBackAndShoulderAdvanced->update([
            'total_calories' => $totalCalories15,
            'total_time' => $totalTime15
        ]);



    }
}
