<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('code',255);
            $table->string('type',255);
            $table->text('description')->nullable();
            $table->string('size')->nullable();
            $table->decimal('price',19,2)->nullable();
            $table->decimal('cost',19,2)->nullable();
            $table->integer('current inventory')->default(0);
            $table->integer('order quantity')->nullable();
            $table->integer('need to be ordered')->nullable();
            $table->decimal('current inventory value',19,2)->default(0);
            $table->string('belong to',255)->nullable();
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
