<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdmissionDate extends Model
{
    use HasFactory;

    protected $table = 'ad_admission_date';

    protected $fillable = [
        'campus', 
        'date', 
    ];
}
