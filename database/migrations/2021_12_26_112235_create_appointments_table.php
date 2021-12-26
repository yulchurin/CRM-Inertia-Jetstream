<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('group_id')->nullable()->constrained();
            $table->foreignId('vehicle_id')->constrained();
            $table->foreignId('driving_schedule_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('place_id')->nullable()->constrained();

            $table->unsignedBigInteger('student')->nullable();
            $table->unsignedBigInteger('instructor');

            $table->string('comment')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('student')->references('id')->on('users');
            $table->foreign('instructor')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
