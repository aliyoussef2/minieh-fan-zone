<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $fillable = ['file_path', 'original_name', 'is_active', 'order'];

    protected $casts = ['is_active' => 'boolean'];

    public static function active()
    {
        return self::where('is_active', true)->orderBy('order')->get();
    }
}