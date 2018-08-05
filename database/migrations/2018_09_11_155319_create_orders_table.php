<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('email');
            $table->string('name');
            $table->string('address');
            $table->string('city');
            $table->string('province');
            $table->string('postalcode');
            $table->string('phone');

            $table->string('card_name')->nullable();
            $table->string('card_number')->nullable();

            $table->integer('discount')->default(0);
            $table->string('discount_code')->nullable();
            $table->integer('subtotal');
            $table->integer('tax');
            $table->integer('total');

            $table->string('delivery_date')->nullable();

            $table->integer('shipping_method')->nullable();
            $table->integer('payment_method')->nullable();
            $table->integer('status')->nullable();


            $table->text('customer_message')->nullable();
            $table->integer('customer_paid')->nullable();
            $table->text('order_description')->nullable();
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
        Schema::dropIfExists('orders');
    }
}