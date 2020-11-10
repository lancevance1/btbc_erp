<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductIdToProductSupplierTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_supplier', function (Blueprint $table) {
            $table->foreignId('product_id')
                ->constrained('products')
                ->onDelete('cascade');
            $table->foreignId('supplier_id')
                ->constrained('suppliers')
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
        Schema::table('product_supplier', function (Blueprint $table) {

            $table->dropForeign(['product_id']);
            $table->dropForeign(['supplier_id']);

            $table->dropIndex('product_supplier_product_id_foreign');
            $table->dropIndex('product_supplier_supplier_id_foreign');

            $table->dropColumn(['product_id']);
            $table->dropColumn(['supplier_id']);
        });
    }
}
