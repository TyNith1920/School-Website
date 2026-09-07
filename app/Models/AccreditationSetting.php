<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // ត្រូវបន្ថែមបន្ទាត់នេះ
use Illuminate\Database\Eloquent\Model;

class AccreditationSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'banner_image'
    ];
}