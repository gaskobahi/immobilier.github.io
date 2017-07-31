<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Typeannonce extends Model
{
    protected $fillable = [
        'name'
    ];

    public function annonces(){
        return $this->hasMany(Annonce::class);
    }

    public function checkIfHasAnnonce(){
        //$annonce= Annonce::findOrFail($this->id);
        $annonce= DB::table('annonces')->where('typeannonce_id',$this->id)->first();
        if(!empty($annonce)){
            return true;
        }
        return false;
    }

}
