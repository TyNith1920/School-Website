<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    // បន្ថែមបន្ទាត់នេះ
    protected $fillable = [
        'title',
        'description',
        'image',
        'link',
    ];
}