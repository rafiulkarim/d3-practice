<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DivisionGeojson extends Model
{
    use HasFactory;

    protected $fillable = [
        'lat',
        'long',
        'division_id',
    ];

    public function division(){
        return $this->belongsTo(Division::class, 'division_id', 'id');
    }
}
