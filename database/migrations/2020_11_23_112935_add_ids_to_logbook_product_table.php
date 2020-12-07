<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdsToLogbookProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('logbook_product', function (Blueprint $table) {
            $table->foreignId('product_id')
                ->constrained('products')
                ->onDelete('cascade');
            $table->foreignId('logbook_id')
                ->constrained('logbooks')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('logbook_product', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropForeign(['logbook_id']);

            $table->dropIndex('logbook_product_product_id_foreign');
            $table->dropIndex('logbook_product_logbook_id_foreign');

            $table->dropColumn(['product_id']);
            $table->dropColumn(['logbook_id']);
        });
    }
}
