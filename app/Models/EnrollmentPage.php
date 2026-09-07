<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnrollmentPage extends Model
{
    protected $fillable = [
    'hero_title', 'hero_subtitle', 'section_title', 'section_description', 'image', 'pdf_file'
];
}
