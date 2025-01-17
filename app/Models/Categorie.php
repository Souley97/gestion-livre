<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Livre;

class Categorie extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function livres()
    {
        return $this->hasMany(Livre::class);
    }
}
