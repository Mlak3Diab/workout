<?php

namespace Database\Seeders;

use App\Models\Muscle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MuscleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // run php artisan db:seed --class=MuscleSeeder
    public function run()
    {
        Muscle::create(['muscle_name' => 'abs']);
        Muscle::create(['muscle_name' => 'chest']);
        Muscle::create(['muscle_name' => 'arm']);
        Muscle::create(['muscle_name' => 'leg']);
        Muscle::create(['muscle_name' => 'shoulder and back']);
        Muscle::create(['muscle_name' => 'Full body']);
    }
}
