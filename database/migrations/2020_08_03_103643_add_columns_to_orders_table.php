<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->integer('cases_required')->default(0);
            $table->integer('samples_required')->default(0);
            $table->integer('pack_size')->default(0);
            $table->date('required_by')->nullable();
            $table->date('delivered_by')->nullable();
            $table->string('additives')->nullable();
            $table->decimal('alc_on_label',3,1)->nullable();
            $table->decimal('alc_in_tank',3,1)->nullable();
            $table->decimal('do2',3,1)->nullable();
            $table->decimal('turbidity',3,1)->nullable();
            $table->boolean('carton_labels')->default(0);
            $table->string('bottle_print')->nullable();
            $table->string('neck')->nullable();
            $table->string('front')->nullable();
            $table->string('back')->nullable();
            $table->string('bottles_direction')->nullable();
            $table->string('cartons_direction')->nullable();

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
            $table->dropColumn('cartons_direction');
            $table->dropColumn('bottles_direction');
            $table->dropColumn('back');
            $table->dropColumn('front');
            $table->dropColumn('neck');
            $table->dropColumn('bottle_print');
            $table->dropColumn('carton_labels');
            $table->dropColumn('turbidity');
            $table->dropColumn('do2');
            $table->dropColumn('alc_in_tank');
            $table->dropColumn('alc_on_label');
            $table->dropColumn('additives');
            $table->dropColumn('delivered_by');
            $table->dropColumn('required_by');
            $table->dropColumn('pack_size');
            $table->dropColumn('samples_required');
            $table->dropColumn('cases_required');
        });
    }
}
