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
        Schema::create('new_batch_pairs', function (Blueprint $table) {
            $table->id();
            $table->string('course_id')->nullable();
            $table->string('new_batch_id')->nullable();
            $table->string('new_batch_name')->nullable();
            $table->string('student_id')->nullable();
            $table->string('teacher_id')->nullable();
            $table->string('level')->nullable();
            $table->string('class_type')->nullable();
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
        Schema::dropIfExists('new_batch_pairs');
    }
};
