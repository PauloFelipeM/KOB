<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateValuesFieldsServicetypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('service_types', function ($table) {
            $table->float('hourly_amount')->after('title');
            $table->float('min_hourly_rate')->after('hourly_amount');
            $table->float('first_span')->after('min_hourly_rate');
            $table->float('first_span_rate')->after('first_span');
            $table->float('next_span')->after('first_span_rate');
            $table->float('next_span_rate')->after('next_span');
            $table->float('remaining_span_rate')->after('next_span_rate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->dropColumn('hourly_amount');
        $table->dropColumn('min_hourly_rate');
        $table->dropColumn('first_span');
        $table->dropColumn('first_span_rate');
        $table->dropColumn('next_span');
        $table->dropColumn('next_span_rate');
        $table->dropColumn('remaining_span_rate');
    }
}
