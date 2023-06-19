<?php

namespace App\Models;

use App\Models\Division;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categorie extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $table = "categories";

    public function divisions()
    {
        return $this->hasMany(Division::class);
    }
}
