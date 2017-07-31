<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Titrepropriete extends Model
{
    protected $fillable = [
        'name','piece','proprietaire_id',
    ];

    public function proprietaire(){
        return $this->belongsTo(Proprietaire::class);
    }
    public function Annonces(){
        return $this->hasMany(Annonce::class);
    }
}
