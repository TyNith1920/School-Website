<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildSafeguarding extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'pdf_file',
        'video_url',
        'image_1',
        'image_2',
        'images', // បន្ថែមនៅទីនេះ
    ];

    // បន្ថែមមុខងារ Cast នេះដើម្បីបំប្លែង JSON ទៅជា Array ដោយស្វ័យប្រវត្តិ
    protected $casts = [
        'images' => 'array',
    ];
}
