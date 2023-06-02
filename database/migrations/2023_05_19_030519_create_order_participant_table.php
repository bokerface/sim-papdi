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
        Schema::create('order_participant', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('participant_id')->nullable();
            $table->unsignedBigInteger('order_id')->nullable();
            $table->timestamps();
        });

        Schema::table('order_participant', function (Blueprint $table) {
            $table->foreign('participant_id')->references('id')->on('participants')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_participant');
    }
};
