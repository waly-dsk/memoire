<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pret extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function abonne()
    {
        return $this->belongsTo(Abonne::class);
    }

    public function agent()
    {
        return $this->belongsTo(User::class);
    }
}
