<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProprietaireCreateRequest;
use App\Http\Requests\ProprietaireUpdateRequest;
use App\Permission;
use App\Proprietaire;
use App\Ville;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProprietaireController extends Controller
{
    function __construct( Request $request)
    {
//        dd($request->all());
    }

    public function index(){
        //$proprietaires = DB::table('proprietaires')->paginate(10);
        $proprietaires=Proprietaire::paginate(2);
        $link=$proprietaires->links();
        return view('layouts.backend.proprietaire.index',compact('proprietaires','link'));
    }

    public function create(){
        $villes = Ville::all();
        return view('layouts.backend.proprietaire.create',compact('villes'));
    }

    public function store(ProprietaireCreateRequest $request){
        Proprietaire::create([
            'name' =>strtoupper( $request['name']),
            'surname' =>$request['surname'],
            'sexe' => $request['sexe'],
            'phone1' =>$request['phone1'],
            'phone2' =>$request['phone2'],
            'ville_id' =>$request['ville_id'],
        ]);
        return redirect(route('proprietaire.index'));
    }

    public function proprietaireaddajax(ProprietaireCreateRequest $request){

        $req=$request->only('name', 'surname','sexe','phone1','phone2','ville_id');
        $proprietaire = new Proprietaire();
        $proprietaire->name  = strtoupper($req['name']);
        $proprietaire->surname  = $req['surname'];
        $proprietaire->sexe  = $req['sexe'];
        $proprietaire->phone1  = $req['phone1'];
        $proprietaire->phone2  = $req['phone2'];
        $proprietaire->ville_id  = $req['ville_id'];
        $proprietaire->save();
        return response()->json([
            'id'=>$proprietaire->id,
            'name'=>$proprietaire->name,
            'surname'=>$proprietaire->surname,
            'phone1'=>$proprietaire->phone1,
            'message'=>$req['name'].' enrégistré avec succès',
        ]);
    }

    public function edit($id){
        $proprietaire=Proprietaire::find($id);
        $villes=Ville::all();
        return view('layouts.backend.proprietaire.edit',compact('proprietaire','villes'));
    }

    public function update(ProprietaireUpdateRequest $request,$id){
        //$user = DB::table('users')->where('id',$id)->get();
        $proprietaire = Proprietaire::findOrFail($id);
        $proprietaire->name=strtoupper($request->get('name'));
        $proprietaire->name=strtoupper($request->get('surname'));
        $proprietaire->sexe=$request->get('sexe');
        $proprietaire->phone1=$request->get('phone1');
        $proprietaire->phone2=$request->get('phone2');
        $proprietaire->ville_id=$request->get('ville_id');
        $proprietaire->update();
        return redirect(route('proprietaire.index'));
    }
}
