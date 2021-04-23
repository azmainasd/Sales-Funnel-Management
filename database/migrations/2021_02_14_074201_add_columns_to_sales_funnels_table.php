<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToSalesFunnelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sales_funnels', function (Blueprint $table) {
            $table->boolean('state')->nullable();
            $table->string('poNumber')->nullable();
            $table->string('poAmount')->nullable();
            $table->date('poDate')->nullable();
            $table->date('poExpiryDate')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sales_funnels', function (Blueprint $table) {
            $table->dropColumn('state');
            $table->dropColumn('poNumber');
            $table->dropColumn('poAmount');
            $table->dropColumn('poDate');
            $table->dropColumn('poExpiryDate');
        });
    }
}
