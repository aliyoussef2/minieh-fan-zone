<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ticket_categories', function (Blueprint $table) {
            $table->id();
            $table->string('section', 2);
            $table->string('name');
            $table->string('seating_style');
            $table->integer('tables_count');
            $table->integer('per_table');
            $table->integer('total_capacity');
            $table->decimal('price', 8, 2)->nullable();
            $table->string('location_label');
            $table->boolean('is_available')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ticket_categories');
    }
};