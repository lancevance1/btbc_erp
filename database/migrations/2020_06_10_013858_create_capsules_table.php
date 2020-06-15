<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCapsulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('capsules', function (Blueprint $table) {
            $table->id();
            $table->string('code',255);
            $table->text('description');
            $table->string('size');
            $table->double('price',8,2);
            $table->double('cost',8,2);
            $table->integer('current inventory');
            $table->integer('order quantity');
            $table->integer('need to be ordered');
            $table->double('current inventory value',8,2);
            $table->string('belong to',255);
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
        Schema::dropIfExists('capsules');
    }
}
