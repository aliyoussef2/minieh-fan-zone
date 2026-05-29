<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class Reservation extends Model
{
    protected $fillable = [
        'customer_id', 'match_id', 'ticket_category_id', 'quantity',
        'total_price', 'booking_code', 'qr_code', 'payment_reference',
        'payment_status', 'entry_status', 'notes',
    ];

    protected $casts = ['total_price' => 'decimal:2'];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function footballMatch(): BelongsTo
    {
        return $this->belongsTo(FootballMatch::class, 'match_id');
    }

    public function ticketCategory(): BelongsTo
    {
        return $this->belongsTo(TicketCategory::class);
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }

    public static function generateBookingCode(): string
    {
        do {
            $code = 'MFZ-' . strtoupper(Str::random(6));
        } while (self::where('booking_code', $code)->exists());
        return $code;
    }

    public function scopePending($query)
    {
        return $query->where('payment_status', 'pending');
    }

    public function scopeVerified($query)
    {
        return $query->where('payment_status', 'verified');
    }

    public function scopeForMatch($query, int $matchId)
    {
        return $query->where('match_id', $matchId);
    }

    public function getStatusBadgeColorAttribute(): string
    {
        return match($this->payment_status) {
            'verified' => '#22c55e',
            'rejected' => '#ef4444',
            default    => '#facc15',
        };
    }
}