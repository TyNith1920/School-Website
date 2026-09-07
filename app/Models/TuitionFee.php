<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TuitionFee extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'program_name',
        'time_schedule',
        'monthly_fee',
        'annual_fee',
        'lunch_fee',
        'lunch_fee_label', // ទើបបន្ថែមថ្មីសម្រាប់ដាក់អក្សរ LUNCH / SNACK
        'after_school_fee',
        'theme_color',
        'sort_order',
    ];
}