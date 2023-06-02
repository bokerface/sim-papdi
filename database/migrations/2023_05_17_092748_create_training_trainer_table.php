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
        Schema::create('training_trainer', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('training_id')->nullable();
            $table->unsignedBigInteger('trainer_id')->nullable();
            $table->timestamps();
        });

        Schema::table('training_trainer', function (Blueprint $table) {
            $table->foreign('training_id')->references('id')->on('trainings')->onDelete('cascade');
            $table->foreign('trainer_id')->references('id')->on('trainers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('training_trainer');
    }
};
