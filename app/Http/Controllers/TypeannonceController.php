<?php

namespace App\Http\Controllers;

use App\Http\Requests\TypeannonceCreateRequest;
use App\Http\Requests\TypeannonceUpdateRequest;
use App\Typeannonce;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TypeannonceController extends Controller
{

    public function __construct(Typeannonce $tpa){
      //  $this->tpa =$tpa;
    }

    public function index(){
        $typeannonces = Typeannonce::paginate(10);
        $link=$typeannonces->links();
        return view('layouts.backend.typeannonce.index',compact('typeannonces','link'));
    }

    public function create(){
        return view('layouts.backend.typeannonce.create');
    }

    public function store(TypeannonceCreateRequest $request){
        Typeannonce::create([
            'name' =>strtoupper( $request['name'])
        ]);
        return redirect(route('typeannonce.index'));
    }


    public function edit($id){
        $typeannonce=Typeannonce::find($id);
        //$notebook=Notebook::where('id',$id)->first();
        return view('layouts.backend.typeannonce.edit',compact('typeannonce'));
    }

    public function update(TypeannonceUpdateRequest $request,$id){
        //$user = DB::table('users')->where('id',$id)->get();
        $typeannonce = Typeannonce::findOrFail($id);
        $typeannonce->name=strtoupper($request->get('name'));
        $typeannonce->update();
        return redirect(route('typeannonce.index'));
    }


    public function destroy(Request $request){
        $typeannonce = Typeannonce::findOrFail($request['id']);
        if($typeannonce->checkIfHasAnnonce()===true){
            return response()->json([
                'message'=>$request['name'].' n\'a pas été suprimé car il possède au moins une annonce',
                'name' => $request['name'],
                'id' => $request['id'],
                'statut' => false,
            ], 201);
        }
        $typeannonce->delete();
        return response()->json([
            'message'=>$request['name'].' a été suprimer avec succès',
            'name' => $request['name'],'id' => $request['id']],
            200);

        /*if($this->remove($request['id'])){
            return response()->json([
                'message'=>$request['name'].' n\'a pas été suprimé ,il contient au moins une annonce',201]);
        }else{
            return response()->json([
                'message'=>$request['name'].' a été suprimer avec succès', 'name' => $request['name'],'id' => $request['id']],
                200);
        }*/

    }

    public function typeannonceaddajax(TypeannonceCreateRequest $request){
        $req=$request->only('name');
        $typeannonce = new Typeannonce();
        $typeannonce->name  = strtoupper($req['name']);
        $typeannonce->save();
        return response()->json([
            'id'=>$typeannonce->id,
            'name'=>$typeannonce->name,
            'message'=>$req['name'].' enrégistré avec succès',
        ]);
    }

   /* public function typeannoncedelete($id){
        $typeannonce = Typeannonce::findOrFail($id);
        return view('layouts.backend.typeannonce.confirmtypeannoncedelete',compact('typeannonce'));
    }


    public function confirmcategoriedelete($id){
        $categorie = Categorie::findOrFail($id);
        if($categorie->checkIfHasCategorie()===true){
            return redirect(route('categorie.index',compact('categorie')))->with('statusshowcategorie','Suppression impossible car ' .$categorie->name. ' possède au mois une annonnce');
        }
        $categorie->delete();
        return redirect(route('categorie.index',compact('categorie')))->with('statusshowcategorie', $categorie->name.' a bien été supprimé');
    }*/

























/////////////////////////////////////////////////////////////////////////////////////////

    private function remove($id)
    {
        $typeannonce = $this->getById($id);
        $typeannonce->delete();
    }

    private function getById($id)
    {
        return Typeannonce::find($id);
    }
}
