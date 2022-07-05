<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Simplegraph extends Model
{
    use HasFactory;

    protected $fillable = [
        'x', 'y'
    ];
}
