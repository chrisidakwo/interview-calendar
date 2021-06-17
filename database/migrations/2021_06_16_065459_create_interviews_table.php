<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterviewsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('interviews', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 191);
            $table->text('description')->nullable();
            $table->uuid('candidate_id')->comment('References the users record');
            $table->uuid('time_slot_id')->nullable();
            $table->timestamp('min_booking_time')->nullable();
            $table->timestamp('max_booking_time')->nullable();
            $table->timestamps();
        });

        Schema::table('interviews', function (Blueprint $table) {
            $table->foreign('candidate_id')
                ->references('id')
                ->on('candidates')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('interviews');
    }
}
