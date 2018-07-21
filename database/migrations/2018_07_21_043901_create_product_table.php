<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('sku')->unique();
            $table->string('slug')->unique();

            $table->string('meta_title')->nullable();
            $table->string('meta_desc')->nullable();
            $table->string('meta_keyword')->nullable();

            $table->integer('price');
            $table->integer('quantity');
            $table->text('details')->nullable();
            $table->text('description')->nullable();

            $table->boolean('featured')->default(false);
            $table->boolean('visibility')->default(false);
            $table->boolean('active')->default(false);
            $table->boolean('in_stock')->default(false);

            $table->text('images')->nullable();

            $table->integer('sort_order')->default(100);

            $table->string('type_id');
            $table->string('parent_id')->nullable();
            $table->string('child_id')->nullable();

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
        Schema::dropIfExists('products');
    }
}
