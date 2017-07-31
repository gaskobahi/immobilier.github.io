<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ville extends Model
{
    protected $fillable = [
        'name', 'ville_id','longitude','latitude',
    ];



    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function annonces(){
        return $this->hasMany(Annonce::class);
    }

    public function ville(){
        return $this->belongsTo(Ville::class);
    }
}
