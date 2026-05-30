<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TicketCategory extends Model
{
    protected $fillable = [
        'section', 'name', 'seating_style', 'tables_count',
        'per_table', 'total_capacity', 'price', 'location_label',
        'is_available', 'sold_out',
    ];

    protected $casts = [
        'price'        => 'decimal:2',
        'is_available' => 'boolean',
        'sold_out'     => 'boolean',
    ];

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    public function getDisplayNameAttribute(): string
    {
        return "Section {$this->section} — {$this->name}";
    }

    public function getSectionColorAttribute(): string
    {
        return match($this->section) {
            'A', 'B', 'C' => '#9B4DCA',
            'D', 'E', 'F' => '#1565C0',
            'G', 'H'      => '#1B5E20',
            'I'            => '#B45309',
            default        => '#1E88FF',
        };
    }

    public function scopeAvailable($query)
    {
        return $query->where('is_available', true);
    }

    public function scopeBySection($query, string $section)
    {
        return $query->where('section', $section);
    }
}