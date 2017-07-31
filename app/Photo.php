<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
        'name','annonce_id',
    ];
    public function annonce(){
        return $this->belongsTo(Annonce::class);
    }

}
