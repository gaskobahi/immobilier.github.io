<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proprietaire extends Model
{
    protected $fillable = [
        'name','surname','phone1','phone2','sexe','ville_id'
    ];

    public function titreprietes(){
        return $this->hasMany(Titrepropriete::class);
    }
    public function ville(){
        return $this->belongsTo(Ville::class);
    }

    public function getProprietaireSexe()
    {
        if($this->sexe=='m'){
            return 'Masculin';
        }
        return 'Féminin';
    }

}
