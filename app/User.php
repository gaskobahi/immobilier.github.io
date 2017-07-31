<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Annonce;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','surname','pseudo','role_id','email',
        'sexe','password','isactif','isconnected','photo'
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

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function getPhotoPath()
    {
        if(empty($this->photo)){
            return 'uploads/users/avatar.jpg';
        }
        return 'uploads/users/'.$this->photo;
    }


    public function getUserRole()
    {
        $role= Role::findOrFail($this->role_id);
        return $role;
    }

    public function checkIfUserHasAnnonce(){
        //$annonce= Annonce::findOrFail($this->id);
        $annonce= DB::table('annonces')->where('user_id',$this->id)->first();
        if(!empty($annonce)){
            return true;
        }
        return false;
    }

    public function hasRole($val)
    {
               if($this->getUserRole()->name==$val){
                   return true;
               }
               return false;
    }

    public function getUserIsactif()
    {
        if($this->isactif===1){
            return 'Actif';
        }
        return 'Inactif';
    }


    public function getUserSexe()
    {
        if($this->sexe=='m'){
            return 'Masculin';
        }
        return 'Féminin';
    }


}
