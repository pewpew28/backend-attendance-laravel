<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->unsignedBigInteger('user_id');

            $table->enum('action', [
                'clock_in',
                'start_break',
                'end_break',
                'clock_out',
            ]);

            $table->timestamp('time');

            $table->uuid('location_id');
            $table->string('location_name');

            $table->timestamps();

            $table->foreign('location_id')
                  ->references('id')
                  ->on('locations')
                  ->cascadeOnDelete();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
