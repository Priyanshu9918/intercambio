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
        Schema::create('finish_courses', function (Blueprint $table) {
            $table->id();
            $table->string('pairing_id')->nullable();
            $table->string('student_id')->nullable();
            $table->string('teacher_id')->nullable();
            $table->string('level')->nullable();
            $table->string('reason')->nullable();
            $table->tinyInteger('status')->default('1')->comment('0 => Reject, 1 => Approved')->nullable();
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
        Schema::dropIfExists('finish_courses');
    }
};
