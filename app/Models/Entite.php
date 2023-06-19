<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entite extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = "entites";
    public function abonnes()
    {
        return $this->hasMany(Abonne::class);
    }
    public function options()
    {
        return $this->hasMany(Option::class);
    }
}
