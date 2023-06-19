<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemoireThese extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = "memoire_theses";
    public function option()
    {
        return $this->belongsTo(Option::class);
    }
}
