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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('name')->nullable();
            $table->tinyInteger('volunteer_information')->default('0');
            $table->string('here_about_us')->nullable();
            $table->tinyInteger('receiving_text_message')->default('0');
            $table->string('phone')->nullable();
            $table->string('birthday')->nullable();
            $table->string('gender')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->string('class_teaching_type')->nullable();
            $table->string('class_type_preference')->nullable();
            $table->string('voluntee_location')->nullable();
            $table->string('location_comment')->nullable();
            $table->string('time_commitment')->nullable();
            $table->string('voluntee_for_intercombio')->nullable();
            $table->string('other_info')->nullable();
            // $table->tinyInteger('status')->default('1')->comment('0 => Inactive, 1 => Active')->nullable();
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
        Schema::dropIfExists('teachers');
    }
};
