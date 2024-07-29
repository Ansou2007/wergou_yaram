<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Garde extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function pharmacies()
    {
        return $this->belongsTo(Pharmacie::class, 'pharmacie_id');
    }
}
