<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('purchase_id')->nullable();
            $table->index('purchase_id');
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
           // $table->dropForeign(['purchase_id']);
            $table->dropIndex('orders_purchase_id_index');
            $table->dropColumn('purchase_id');
        });
    }
}
