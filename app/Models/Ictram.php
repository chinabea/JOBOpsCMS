<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ictram extends Model
{
    use HasFactory;
    protected $fillable = [
        'unit',
        'jobtype',
        'equipment',
        'problem',
        'is_warrantry',
        // '_token', // Add this line
    ];
}
