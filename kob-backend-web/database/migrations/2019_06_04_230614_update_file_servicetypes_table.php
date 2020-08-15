<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateFileServicetypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('service_types', function ($table) {
            $table->string('original_filename',255)->nullable()->after('remaining_span_rate');
            $table->string('storage_filename',255)->nullable()->after('original_filename');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->dropColumn('original_filename');
        $table->dropColumn('storage_filename');
    }
}
