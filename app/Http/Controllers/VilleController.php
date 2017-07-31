<?php

namespace App\Http\Controllers;

use App\Http\Requests\VilleCreateRequest;
use App\Http\Requests\VilleUpdateRequest;
use App\Ville;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VilleController extends Controller
{
    public function index(){
        $communes=Ville::paginate(6);
        $link=$communes->links();
        return view('layouts.backend.ville.index',compact('communes','link'));
    }

    public function create(){
        $villes = Ville::doesntHave('ville')->get();
        return view('layouts.backend.ville.create',compact('villes'));
    }

    public function store(VilleCreateRequest $request){
        Ville::create([
            'name' =>strtoupper ($request['name']),
            'ville_id' => $request['ville_id'],
            'longitude' =>$request['longitude'],
            'latitude' => $request['latitude'],
        ]);
        return redirect(route('ville.index'));
    }

    public function edit($id){
        $villes = Ville::doesntHave('ville')->get();
        $ville=Ville::find($id);
        return view('layouts.backend.ville.edit',compact('ville','villes'));
    }

    public function update(VilleUpdateRequest $request,$id){
        $ville = Ville::findOrFail($id);
       //dd($request->all());
        $ville->name=strtoupper($request->get('name'));
        $ville->ville_id=$request->get('ville_id');
        $ville->longitude=$request->get('longitude');
        $ville->latitude=$request->get('latitude');
        $ville->save();
        return redirect(route('ville.index'));
    }
}
