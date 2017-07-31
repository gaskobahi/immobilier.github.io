<?php

namespace App\Http\Controllers;

use App\Annonce;
use App\Categorie;
use App\Http\Requests\AnnonceCreateRequest;
use App\Http\Requests\AnnonceUpdateRequest;
use App\Photo;
use App\Proprietaire;
use App\Titrepropriete;
use App\Typeannonce;
use App\Ville;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;


class AnnonceController extends Controller
{

  public function index(){
      $annonces=Annonce::orderBy('created_at', 'desc')->paginate(2);
      $totalannonce=count($annonces);
    //dd($annonces);
/*
      $annonceTerrains = Annonce::join('categories', 'categories.id', '=', 'annonces.categorie_id')
          ->where('categories.name', '=','terrain')
          ->select('annonces.*','categories.name')
          ->orderBy('annonces.created_at','desc')
          ->paginate(6);
      //dd($annonceTerrains);
      $annonceMaisons = Annonce::join('categories', 'categories.id', '=', 'annonces.categorie_id')
          ->where('categories.name', '=','maison')
          ->select('annonces.*','categories.name')
          ->orderBy('annonces.created_at','desc')
          ->paginate(6);*/
     // $annonceMaisons=Annonce::where('categorie_id',2)->orderBy('created_at','desc')->paginate(6);
      $link=$annonces->links();
    /*  $linkmaison=$annonceMaisons->links();
      $linkterrain=$annonceTerrains->links();*/
      return view('layouts.backend.annonce.index',compact('annonces','link','totalannonce'));
  }

  public function create(){
     $titreproprietes = Titrepropriete::all();
      $proprietaires = Proprietaire::all();
     $villes = Ville::all();
     $typeannonces= Typeannonce::all();
     $categories = Categorie::all();

      return view('layouts.backend.annonce.create',compact('titreproprietes','villes','typeannonces','categories','proprietaires'));
  }

  public function upload(AnnonceCreateRequest $request){

      $destinationPath='uploads/photos/';
      $this->validateNombrepieceOrSuperficie($request->categorie_id,$request);

     // dd(is_string($catvalue));
     // $annonce=new Annonce();
     // dd($annonce);
      $annonce = Annonce::create([
          'titre' => ucwords($request['titre']),
          'description' => ucwords($request['description']),
          'nombrepiece' => $request['nombrepiece'],
          'superficie' => $request['superficie'],
          'prix' => $request['prix'],
          'typeannonce_id' =>$request['typeannonce_id'],
          'categorie_id' => $request['categorie_id'],
          'titrepropriete_id' => $request['titrepropriete_id'],
          'ville_id' => $request['ville_id'],
         'status' => $request['status'],
        'user_id' => Auth::user()->id,
      ]);


      if($request->hasFile('photos')) {
          $photos = $request->file('photos');
          //dd($photos);
          $i=1;
          foreach ($photos as $photo) {

                  $filename= $annonce->id .''. $i.''.$photo->getClientOriginalExtension();
                 // dd($filename);
                  if(file_exists(public_path($destinationPath.$filename))){
                      unlink(public_path($destinationPath.$filename));
                  }
                  Image::make($photo)->resize(500,500)->save(public_path($destinationPath.$filename));
                  Photo::create([
                      'annonce_id' => $annonce->id,
                      'name' => $filename
                  ]);
              $i++;
          }
      }

      return redirect(route('annonce.index'));
  }

 public function removephoto(Request $request){
     $photo = Photo::findOrFail($request['id']);
     $photo->delete();
     return response()->json([201]);
      //$id=$request['id'];
     // $this->detail($id);
      //return view(route('annonce.detail',$id));
  }

    public function detail($id){
        $annonce = Annonce::findOrFail($id);
        return view('layouts.backend.annonce.detail',compact('annonce'));
    }


    public function edit($id){
        $annonce = Annonce::findOrFail($id);
        $titreproprietes = Titrepropriete::all();
        $villes = Ville::all();
        $typeannonces= Typeannonce::all();
        $categories = Categorie::all();
        return view('layouts.backend.annonce.edit',compact('annonce','titreproprietes','villes','typeannonces','categories'));
    }

    public function update(AnnonceUpdateRequest $request,$id){

        $destinationPath='uploads/photos/';
        $annonce=Annonce::find($id);
        $annonce->titre=ucwords($request['titre']);
        $annonce->description=ucwords($request['description']);
        $annonce->nombrepiece=$request['nombrepiece'];
        $annonce->superficie= $request['superficie'];
        $annonce->prix=$request['prix'];
        $annonce->typeannonce_id=$request['typeannonce_id'];
        $annonce->categorie_id=$request['categorie_id'];
        $annonce->titrepropriete_id=$request['titrepropriete_id'];
        $annonce->ville_id=$request['ville_id'];
        $annonce->user_id=Auth::user()->id;
        $annonce->update();
        if($request->hasFile('photos')) {
            $photos = $request->file('photos');
            $i=1;
            foreach ($photos as $p) {
                $date=strtotime('now');
                $filename= $i.'_'.$annonce->id .'_'.$date.''.$p->getClientOriginalExtension();
                //dd($filename);
                if(file_exists(public_path($destinationPath.$filename))){
                    unlink(public_path($destinationPath.$filename));
                }
                Image::make($p)->resize(800,800)->save(public_path($destinationPath.$filename));
                Photo::create([
                    'annonce_id' => $annonce->id,
                    'name' => $filename
                ]);
                $i++;
            }
        }

        return redirect(route('annonce.index'));
    }


    public function updatestatutannonce(Request $request){
        $req=$request->only('id','status');

        $annonce=Annonce::find($req['id']);
         $annonce->status=$request['status'];
         $annonce->publie_at=date("Y-m-d H:i:s");;
        $annonce->updatedstatus_by=Auth::user()->pseudo;
        $annonce->update();
        return response()->json([
            'id'=>$annonce->id,
            'status'=>$annonce->status,
            'publie_at'=>$annonce->publie_at,
            'updatedstatus_by'=>$annonce->updatedstatus_by,
        ]);
    }


    public function updateexpireannonce(Request $request){
        $req=$request->only('id','expire');

        $annonce=Annonce::find($req['id']);
        $annonce->expire=$request['expire'];
        $annonce->updatedexpire_by=Auth::user()->pseudo;
        $annonce->update();
        return response()->json([
            'id'=>$annonce->id,
            'expire'=>$annonce->expire,
            'updatedexpire_by'=>$annonce->updatedexpire_by,
        ]);
    }



    public function annoncedelete($id){
        $annonce = Annonce::findOrFail($id);
        return view('layouts.backend.annonce.confirmannoncedelete',compact('annonce'));
    }

    public function confirmannoncedelete($id){
        $destinationPath='uploads/photos/';
        $annonce = Annonce::findOrFail($id);
        if($annonce->status===1){
            return redirect(route('layouts.backend.annonce.index',compact('annonce')))->with('statusshowannonce',' Impossible de supprimer une annonce est publie');
        }
        $photoOfannonces=Photo::where('annonce_id',$annonce->id)->get();
        foreach ( $photoOfannonces as $photoOfannonce) {
            $filename=$photoOfannonce->name;
            unlink(public_path($destinationPath.$filename));
            $photoOfannonce->delete();
        }
        $annonce->delete();
        return redirect(route('annonce.index',compact('annonce')))->with('statusshowannonce','L\'annonce n°'. $annonce->id.' a bien été supprimée');
    }













//////////////////////////////////////::private function//////////////////////////////////////////////////////

    private function validateNombrepieceOrSuperficie($value ,Request $r){
        if($value==='2'){
            $this->validate($r,[
                'nombrepiece' => 'required'
            ]);
        }
        if($value==='1'){
            $this->validate($r,[
                'superficie' => 'required'
            ]);
        }

    }

}




