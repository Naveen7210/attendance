<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subject_fee extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_id',
        'number_of_days',
        'fees',
    ];
}
