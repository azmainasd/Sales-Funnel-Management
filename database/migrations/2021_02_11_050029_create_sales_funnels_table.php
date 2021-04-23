<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesFunnelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_funnels', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('solution_id')->unsigned();
            $table->foreign('solution_id')->references('id')->on('solutions')->onDelete('cascade');
            $table->integer('industry_id')->unsigned();
            $table->foreign('industry_id')->references('id')->on('industries')->onDelete('cascade');
            $table->integer('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->integer('owner_id')->unsigned();
            $table->foreign('owner_id')->references('id')->on('owners')->onDelete('cascade');
            $table->string('projectScope');
            $table->decimal('amount', 10, 2);
            $table->integer('partner_id')->unsigned()->nullable();
            $table->foreign('partner_id')->references('id')->on('partners')->onDelete('cascade');
            $table->string('sponsor')->nullable();
            $table->string('currentStatus')->nullable();
            $table->string('previousStatus')->nullable();
            $table->string('action')->nullable();
            $table->string('prospect');
            $table->date('closingDate')->nullable();
            $table->string('remarks')->nullable();
            $table->string('ceoRemark')->nullable();
            $table->string('contactPerson')->nullable();
            $table->string('contactNumber')->nullable();
            $table->string('type');
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
        Schema::dropIfExists('sales_funnels');
    }
}
