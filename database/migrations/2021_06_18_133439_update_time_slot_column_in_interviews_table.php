<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTimeSlotColumnInInterviewsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('interviews', function (Blueprint $table) {
            $table->dropColumn('time_slot_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('interviews', function (Blueprint $table) {
            $table->uuid('time_slot_id')->after('candidate_id')->nullable();
        });
    }
}
