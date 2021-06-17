<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterviewInterviewersTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('interview_interviewers', function (Blueprint $table) {
            $table->foreignUuid('interview_id')->constrained()
                ->cascadeOnDelete()
                ->comment('References the interviews table');

            $table->foreignUuid('interviewer_id')->constrained('interviewers')
                ->cascadeOnDelete()
                ->comment('References the interviewers record');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('interview_interviewers');
    }
}
