<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = "divisions";

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }
    public function livres_imprimes()
    {
        return $this->hasMany(LivreImprime::class);
    }
}
