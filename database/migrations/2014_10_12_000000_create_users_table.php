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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('fcm_token');
            $table->double('weight')->nullable();
            $table->integer('length')->nullable();
            $table->integer('age')->nullable();
            $table->double('BMI')->nullable();
            $table->integer('total_time_practice')->nullable();
            $table->integer('total_calorie')->nullable();
            $table->string('image')->nullable();
            $table->integer('points')->nullable();
            //$table->foreignId('plan_id')->constrained('plans')->cascadeOnDelete();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
