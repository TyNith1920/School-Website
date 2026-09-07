<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    use HasFactory;

    protected $fillable = [
        'weekdays_time',
        'weekend_time',
        'telegram',
        'phone',
        'email',
        'logos_image',
        'address', // សម្រាប់អាសយដ្ឋាន
        'telegram_qr', // សម្រាប់រូប QR Code
    ];

    // បន្ថែមមុខងារ casts នេះដើម្បីអាចផ្ទុករូបភាពបានច្រើនទម្រង់ជា Array
    protected $casts = [
        'logos_image' => 'array',
    ];
}