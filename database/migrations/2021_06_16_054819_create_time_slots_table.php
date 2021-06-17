<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeSlotsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('time_slots', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->tinyInteger('day');
            $table->string('start_time', 5);
            $table->string('end_time', 5);
            $table->timestamps();
        });

        Schema::table('time_slots', function (Blueprint $table) {
            $table->unique(['day', 'start_time', 'end_time'], 'day_time_slot');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        if (Schema::hasTable('time_slots')) {
            Schema::table('time_slots', function (Blueprint $table) {
                $table->dropUnique('day_time_slot');
            });

            Schema::drop('time_slots');
        }
    }
}
