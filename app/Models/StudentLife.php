<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentLife extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'link',
        'gallery_images', // បន្ថែមវាលនេះ
    ];

    // ប្រាប់ Laravel ថា gallery_images គឺជាទម្រង់ Array (រូបច្រើន)
    protected $casts = [
        'gallery_images' => 'array',
    ];
}