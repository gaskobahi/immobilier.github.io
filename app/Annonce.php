<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Annonce extends Model
{

    protected $fillable = [
        'titre','description','nombrepiece','superficie','prix','status','expire','typeannonce_id',
        'categorie_id','titrepropriete_id','ville_id','user_id','updatedstatus_by','updatedexpire_by'
    ];

    public function typeannonce(){
        return $this->belongsTo(Typeannonce::class);
    }
    public function categorie(){
        return $this->belongsTo(Categorie::class);
    }
    public function titrepropriete(){
        return $this->belongsTo(Titrepropriete::class);
    }
    public function ville(){
        return $this->belongsTo(Ville::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function photos(){
        return $this->hasMany(Photo::class);
    }



    public function getAnnonceCategorieSuperficeorNombrepiece()
    {
        $categorie= Categorie::findOrFail($this->categorie_id);

        if($categorie->name=='TERRAIN'){
            return $this->superficie .' mètres carré';
        }
        if($this->nombrepiece<2){
            $sup="pièce";
        }else{
            $sup="pièces";
        }

        return $this->nombrepiece.' '.$sup;
    }
    public function getAnnonceCategorieValueSuperficeorNombrepiece()
    {
        $categorie= Categorie::findOrFail($this->categorie_id);

        if($categorie->name=='TERRAIN'){
            return $this->superficie;
        }
        return $this->nombrepiece;
    }

    public function getAnnonceCategorieTitle()
    {
        $categorie= Categorie::findOrFail($this->categorie_id);

        if($categorie->name=='TERRAIN'){
            return ' Superfice :';
        }

        return 'Pièces :';
    }

    public function getAnnonceCategorie(){
        $categorie= Categorie::findOrFail($this->categorie_id);
        return $categorie->name;
    }


    public function getstatus(){
        if($this->status==1){
            return 'Publiée';
        }
        return 'Pas encore publiée';
    }
    public function getUserId(){
            return  $this->user_id;
    }


    public function getRoleNameOfUserAnnonce()
    {

        $thiannonceuserrole= Role::select('roles.name')
            ->join('users','users.role_id','=','roles.id')
            ->where('users.id', '=',$this->user_id)->get();
        //dd($thiannonceuserrole->name);
        return $thiannonceuserrole;
    }

    public function getexpire(){
        if($this->expire==0){
            return 'Activée';
        }
        return 'Expirée';
    }

    public function getAnnonceTypeannonce(){
        $typeannonce= Typeannonce::findOrFail($this->typeannonce_id);

        return $typeannonce->name;
    }

    public function getAnnoncePrix(){
        return $this->prix .' Fcfa';
    }







    ///////////////////////////////////:date of annonce/////////////////:
    public function getDateOfAnnonce(){
        $dt = Carbon::parse($this->publie_at);
        if($this->returnAujourdhui($dt)===true){
            return 'Mise en ligne Aujourd\'hui à '.date_format($dt, 'H:i');
        }elseif($this->returnHier($dt)){
            return 'Mise en ligne Hier à '.date_format($dt, 'H:i');
        }else{
            $this->getNameOfMonth($dt->month);
            return 'Mise en ligne le  '.$dt->day .' '.$this->getNameOfMonth($dt->month).' à '.date_format($dt, 'H:i');
        }

    }


    private function returnAujourdhui($val){
        if($val->isToday()){
            return true;
        }
        return false;
    }

    private function returnHier($val){
        if($val->isYesterday()){
            return true;
        }
        return false;
    }

    private function getNameOfMonth($val){
        $m='';
        if($val==1){
            $m='Janvier';
        }
        if($val==2){
            $m='Fevrier';
        }
        if($val==3){
            $m='Mars';
        }
        if($val==4){
            $m='Avril';
        }
        if($val==5){
            $m='Mai';
        }
        if($val==6){
            $m='Juin';
        }
        if($val==7){
            $m='Juillet';
        }
        if($val==8){
            $m='Aôut';
        }

        if($val==9){
            $m='Septembre';
        }
        if($val==10){
            $m='Octobre';
        }
        if($val==11){
            $m='Novembre';
        }
        if($val==12){
            $m='Decembre';
        }
        return $m;
    }



}
