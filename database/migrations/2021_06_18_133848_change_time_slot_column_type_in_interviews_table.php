<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTimeSlotColumnTypeInInterviewsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('interviews', function (Blueprint $table) {
            $table->datetime('time_slot')->after('candidate_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('interviews', function (Blueprint $table) {
            $table->dropColumn('time_slot');
        });
    }
}
