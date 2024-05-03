<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('challenges', function (Blueprint $table) {
            $table->id();
            $table->integer('trainer_id');
            $table->string('image')->nullable();
            $table->integer('total_calories')->nullable();
            $table->integer('total_time')->nullable();
            $table->enum('muscle',['abs','chest','arm','leg','shoulder and back']);
            $table->enum('level',['beginner','intermediate','advanced']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('challenges');
    }
};
