<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->string('team_a');
            $table->string('team_b');
            $table->string('flag_code_a', 10)->nullable();
            $table->string('flag_code_b', 10)->nullable();
            $table->date('match_date');
            $table->time('match_time');
            $table->string('stage');
            $table->string('group')->nullable();
            $table->string('stadium')->nullable();
            $table->enum('status', ['upcoming','live','finished'])->default('upcoming');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('matches');
    }
};