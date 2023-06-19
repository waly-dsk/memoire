<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;
    protected $fillable = [
        "intitule",
        "entite_id",
    ];
    protected $table = "options";

    public function entite()
    {
        return $this->belongsTo(Entite::class);
    }
}
