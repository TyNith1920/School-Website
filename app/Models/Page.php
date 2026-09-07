<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'gallery', // បន្ថែម field gallery ទៅក្នុង $fillable
        'mobile_image',
    ];
    // ប្រាប់ Laravel ថា gallery នេះផ្ទុកទិន្នន័យជាកញ្ចប់ (Array)
    protected $casts = [
        'gallery' => 'array',
    ];

}
