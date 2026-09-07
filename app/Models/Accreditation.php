<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accreditation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'logo',
        'description',
        'website_link',
        'sort_order',
        'document_image',
        'gallery',
    ];

    protected $casts = [
        'gallery' => 'array',
        'document_image' => 'array',
        'sort_order' => 'integer',
    ];
}