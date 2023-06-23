<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rayon extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = "rayons";

    public function loges()
    {
        return $this->hasMany(Loge::class);
    }

    public function memoires_theses()
    {
        return $this->hasMany(MemoireThese::class);
    }

    public function livres_imprimes()
    {
        return $this->hasMany(LivreImprime::class);
    }
}
