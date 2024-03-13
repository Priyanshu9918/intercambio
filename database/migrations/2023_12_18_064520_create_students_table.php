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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('name')->nullable();
            $table->string('l_name')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('trem_condition')->nullable();
            $table->string('phone')->nullable();
            $table->string('birthday')->nullable();
            $table->string('gender')->nullable();
            $table->string('street_address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->string('time_zone')->nullable();
            $table->string('under_age')->nullable();
            $table->string('emergency_name')->nullable();
            $table->string('emergency_number')->nullable();
            $table->tinyInteger('status')->default('1')->comment('0 => Inactive, 1 => Active')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
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
        Schema::dropIfExists('students');
    }
};
