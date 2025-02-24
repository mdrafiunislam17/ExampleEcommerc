<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlineJob extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'father_name',
        'mother_name',
        'date_of_birth',
        'gender',
        'martial_status',
        'national_id',
        'religion_status',
        'present_address',
        'permanent_address',
        'email',
        'mobile',
        'photo',
        'cv',
    ];


}
