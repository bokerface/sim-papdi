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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->enum('payment_method', ['BankTransfer', 'Midtrans'])->nullable();
            $table->unsignedBigInteger('training_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->date('order_date')->nullable();
            $table->date('payment_date')->nullable();
            $table->bigInteger('payment_amount')->nullable();
            $table->string('status_order')->nullable();
            $table->bigInteger('transaction_id')->nullable();
            $table->timestamps();
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('training_id')->references('id')->on('trainings')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
