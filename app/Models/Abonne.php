<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Abonne extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function entite()
    {
        return $this->belongsTo(Entite::class);
    }
    public function prets()
    {
        return $this->hasMany(Pret::class);
    }
}
