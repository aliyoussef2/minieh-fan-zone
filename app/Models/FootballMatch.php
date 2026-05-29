<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FootballMatch extends Model
{
    protected $table = 'matches';

    protected $fillable = [
        'team_a', 'team_b', 'flag_code_a', 'flag_code_b',
        'match_date', 'match_time', 'stage', 'group', 'stadium', 'status',
    ];

    protected $casts = ['match_date' => 'date'];

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class, 'match_id');
    }

    public function getLabelAttribute(): string
    {
        return "{$this->team_a} vs {$this->team_b}";
    }

    public function getFormattedDateAttribute(): string
    {
        return $this->match_date->format('D, M j');
    }

    public function getFlagUrlAAttribute(): string
    {
        return $this->flag_code_a ? "https://flagcdn.com/w40/{$this->flag_code_a}.png" : '';
    }

    public function getFlagUrlBAttribute(): string
    {
        return $this->flag_code_b ? "https://flagcdn.com/w40/{$this->flag_code_b}.png" : '';
    }

    public function scopeUpcoming($query)
    {
        return $query->where('match_date', '>=', now()->toDateString())
                     ->orderBy('match_date')->orderBy('match_time');
    }

    public function scopeByStage($query, string $stage)
    {
        return $query->where('stage', $stage);
    }
}