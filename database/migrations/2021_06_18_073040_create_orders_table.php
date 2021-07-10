<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
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
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('address')->nullable();
            $table->timestamp('chekout_date')->nullable();
            $table->timestamp('accepted_payment_date')->nullable();
            $table->timestamp('shipment_date')->nullable();
            $table->timestamp('closed_date')->nullable();
            $table->string('status');
            $table->timestamps();
        });

        Schema::create('payments', function (Blueprint $table) {
            $table->uuid('payment_code')->primary();
            $table->string('payment')->nullable(); 
            $table->integer('total_payment')->nullable(); 
            $table->timestamps();
        });

        Schema::create('order_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->integer('qty');
            $table->integer('total');
            $table->uuid('payment_code')->nullable();
            $table->foreign('payment_code')->references('payment_code')->on('payments')->onDelete('cascade');
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
        Schema::dropIfExists('order_detail');
        Schema::dropIfExists('payments');
        Schema::dropIfExists('orders');
    }
}
