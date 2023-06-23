<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loge extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = "loges";

    public function rayon()
    {
        return $this->belongsTo(Rayon::class);
    }
}
