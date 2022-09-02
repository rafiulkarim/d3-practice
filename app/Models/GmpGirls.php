<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GmpGirls extends Model
{
    use HasFactory;

    protected $fillable = [
        'age', 'z3n','z2n'
    ];
}
