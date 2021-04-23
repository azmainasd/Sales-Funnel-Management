<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class IncreaseColumnsVarcharLengthToSalesFunnelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sales_funnels', function (Blueprint $table) {
            $table->string('currentStatus', 1000)->change();
            $table->string('previousStatus', 1000)->change();
            $table->string('action', 1000)->change();
            $table->string('remarks', 1000)->change();
            $table->string('ceoRemark', 1000)->change();
            $table->string('deleteRemarks', 1000)->change();
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
            $table->string('currentStatus')->change();
            $table->string('previousStatus')->change();
            $table->string('action')->change();
            $table->string('remarks')->change();
            $table->string('ceoRemark')->change();
            $table->string('deleteRemarks')->change();
        });
    }
}
