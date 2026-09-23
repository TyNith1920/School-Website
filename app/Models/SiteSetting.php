<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'facebook',
        'instagram',
        'email',
        // 📍 Fields ថ្មីសម្រាប់អក្សររត់
        'show_announcement',
        'announcement_badge',
        'announcement_text',
    ];

    protected $casts = [
        'show_announcement' => 'boolean',
    ];
}