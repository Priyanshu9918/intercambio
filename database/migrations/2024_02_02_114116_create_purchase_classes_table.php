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
        Schema::create('purchase_classes', function (Blueprint $table) {
            $table->id();
            $table->string('order_no')->nullable();
            $table->string('user_id')->nullable();
            $table->string('course_id')->nullable();
            $table->string('batch_id')->nullable();
            $table->string('batch_name')->nullable();
            $table->string('amount')->nullable();
            $table->string('total_class')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('stripe_order_id')->nullable();
            $table->tinyInteger('is_completed')->default('0')->nullable();
            $table->tinyInteger('status')->default('1')->comment('0 => Inactive, 1 => Active')->nullable();
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
        Schema::dropIfExists('purchase_classes');
    }
};
