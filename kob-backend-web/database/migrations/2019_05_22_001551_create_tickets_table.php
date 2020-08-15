<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('access_id')->unsigned();
            $table->bigInteger('card_id')->unsigned();
            $table->bigInteger('employee_id')->nullable()->unsigned();
            $table->bigInteger('service_type_id')->unsigned();
            $table->bigInteger('workspace_id')->unsigned();
            $table->float('amount')->nullable();
            $table->float('tip_amount')->nullable();
            $table->dateTime('scheduled_date');
            $table->dateTime('transit_start')->nullable();
            $table->dateTime('transit_finish')->nullable();
            $table->string('payment_status',64)->nullable();
            $table->boolean('payment_done')->default(0);
            $table->string('origin_address',255);
            $table->string('origin_coordinates',255)->nullable();  
            $table->boolean('service_type');   
            $table->integer('number_hours')->default(0);
            $table->string('additional_commments',255)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('access_id')
            ->references('id')
            ->on('accesses')
            ->change();

            $table->foreign('employee_id')
            ->references('id')
            ->on('accesses')
            ->change();

            $table->foreign('card_id')
            ->references('id')
            ->on('cards')
            ->change();

            $table->foreign('service_type_id')
            ->references('id')
            ->on('service_types')
            ->change();

            $table->foreign('workspace_id')
            ->references('id')
            ->on('workspaces')
            ->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
