<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class course_fee extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'subject_id',
        'number_of_days',
        'fees',
    ];
}
