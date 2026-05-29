<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('reservations');
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->cascadeOnDelete();
            $table->foreignId('match_id')->constrained('matches')->cascadeOnDelete();
            $table->foreignId('ticket_category_id')->constrained('ticket_categories')->cascadeOnDelete();
            $table->integer('quantity');
            $table->decimal('total_price', 10, 2)->nullable();
            $table->string('booking_code', 20)->unique();
            $table->string('qr_code')->nullable();
            $table->string('payment_reference')->nullable();
            $table->enum('payment_status', ['pending','verified','rejected'])->default('pending');
            $table->enum('entry_status', ['not_entered','entered'])->default('not_entered');
            $table->text('notes')->nullable();
            $table->index('booking_code');
            $table->index('payment_status');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};