<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteBanner extends Model
{
    use HasFactory;

    // ត្រូវបន្ថែមបន្ទាត់នេះ ដើម្បីអនុញ្ញាតឱ្យប្រព័ន្ធអាច Save ទិន្នន័យចូល Database បាន
    protected $fillable = [
        'page_name', 
        'image_path'
    ];
}