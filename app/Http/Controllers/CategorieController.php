<?php

namespace App\Http\Controllers;

use App\Categorie;
use App\Http\Requests\CategorieCreateRequest;
use App\Http\Requests\CategorieUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CategorieController extends Controller
{
    public function index(){
        $categories = DB::table('categories')->paginate(10);
        $link=$categories->links();
        return view('layouts.backend.categorie.index',compact('categories','link'));
    }

    public function create(){
        return view('layouts.backend.categorie.create');
    }

    public function store(CategorieCreateRequest $request){
        Categorie::create([
            'name' =>strtoupper ( $request['name'])
        ]);
        return redirect(route('categorie.index'));
    }

    public function edit($id){
        $categorie=Categorie::find($id);
        //$notebook=Notebook::where('id',$id)->first();
        return view('layouts.backend.categorie.edit',compact('categorie'));
    }

    public function update(CategorieUpdateRequest $request,$id){
        $categorie = Categorie::findOrFail($id);
        $categorie->name=strtoupper ($request->get('name'));
        $categorie->update();
        return redirect(route('categorie.index'));

    }


    public function categorieaddajax(CategorieCreateRequest $request){
        $req=$request->only('name');
        $categorie = new Categorie();
        $categorie->name  = strtoupper($req['name']);
        $categorie->save();
        return response()->json([
            'id'=>$categorie->id,
            'name'=>$categorie->name,
            'message'=>$req['name'].' enrégistré avec succès',
        ]);
    }


    public function categoriedelete($id){
        $categorie = Categorie::findOrFail($id);
        return view('layouts.backend.categorie.confirmcategoriedelete',compact('categorie'));
    }


    public function confirmcategoriedelete($id){
        $categorie = Categorie::findOrFail($id);
        if($categorie->checkIfHasAnnonce()===true){
            return redirect(route('categorie.index',compact('categorie')))->with('statusshowcategorie','Suppression impossible car ' .$categorie->name. ' possède au mois une annonnce');
        }
        $categorie->delete();
        return redirect(route('categorie.index',compact('categorie')))->with('statusshowcategorie', $categorie->name.' a bien été supprimé');
    }

}
