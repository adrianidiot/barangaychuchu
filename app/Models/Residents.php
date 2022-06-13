<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Residents extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'category_type',
        'sex',
        'age',
        'birth_date',
        'birth_place',
        'civil_status',
        'occupation'
    ];
}
