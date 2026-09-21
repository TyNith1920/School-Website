<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteBanner extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_name', 
        'image_path',
    ];

    // 📍 បន្ថែមនេះដើម្បីឱ្យ Laravel បំប្លែងរូបភាពច្រើនសន្លឹកជា Array / JSON ដោយស្វ័យប្រវត្តិ
    protected $casts = [
        'image_path' => 'array',
    ];
}