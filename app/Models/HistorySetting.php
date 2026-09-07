<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorySetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'vision',
        'mission',
        'founder_image',
        'founder_message',
        'founder_blessing',
        'founder_name',
        'banner_image',
        'banner_slider',
    ];

    protected $casts = [
        'banner_slider' => 'array',
    ];
}