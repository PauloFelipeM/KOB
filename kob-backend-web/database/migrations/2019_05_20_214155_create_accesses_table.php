<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accesses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('workspace_id')->unsigned();
            $table->boolean('is_admin');
            $table->boolean('is_manager');
            $table->boolean('is_blocked');
            $table->timestamps();            

            $table->foreign('user_id')
            ->references('id')
            ->on('users')
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
        Schema::dropIfExists('accesses');
    }
}
