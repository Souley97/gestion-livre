<?php

namespace App\Models;

use App\Models\Emprunt;
use App\Models\Categorie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Livre extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    public function categories()
    {
        return $this->belongsToMany(Categorie::class);
    }

    public function emprunts()
    {
        return $this->hasMany(Emprunt::class);
    }
    

}
