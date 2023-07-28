<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfigAdmission extends Model
{
    use HasFactory;

    protected $table = 'ad_config_admission';

    protected $fillable = [
        'fname', 'lname', 'email', 'password',
    ];
}
