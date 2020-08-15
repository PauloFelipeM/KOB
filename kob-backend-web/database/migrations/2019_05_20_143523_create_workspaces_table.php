<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkspacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workspaces', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title',255);
            $table->string('domain',255);
            $table->boolean('disabled');
            $table->text('address');
            $table->string('id_number',32);
            $table->string('phone',64);
            $table->string('contact',255);
            $table->string('email',168);
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
        Schema::dropIfExists('workspaces');
    }
}
