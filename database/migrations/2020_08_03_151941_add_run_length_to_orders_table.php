<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRunLengthToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('run_length')->nullable();
            $table->boolean('slip_sheet')->default(0);
            $table->boolean('card_board')->default(0);
            $table->string('stretch_wrap')->nullable();
            $table->string('cont_size')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('cont_size');
            $table->dropColumn('stretch_wrap');
            $table->dropColumn('card_board');
            $table->dropColumn('slip_sheet');
            $table->dropColumn('run_length');
        });
    }
}
