<?php

namespace App\Http\Controllers;

use App\Http\Requests\TitreproprieteCreateRequest;
use App\Http\Requests\TitreproprieteUpdateRequest;
use App\Proprietaire;
use App\Titrepropriete;
use App\Ville;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;
use Symfony\Component\Finder\SplFileInfo;

class TitreproprieteController extends Controller
{
    public function index(){
       $titreproprietes = Titrepropriete::paginate(10);
        $link=$titreproprietes->links();
        return view('layouts.backend.titrepropriete.index',compact('titreproprietes','link'));

    }

    public function create(){
        $proprietaires = Proprietaire::all();
        $villes = Ville::all();
        return view('layouts.backend.titrepropriete.create',compact('proprietaires','villes'));
    }

    public function store(TitreproprieteCreateRequest $request){

        $destinationPath='uploads/piecetitrepropriete/';
        $filename='';
        if($request->hasFile('piece')){
            $piece= $request->file('piece');
            $filename=$request['name'].'.'.$piece->getClientOriginalExtension();
            if(file_exists(public_path($destinationPath.$filename))){
                unlink(public_path($destinationPath.$filename));
            }
            $temp = explode(".", $filename);
            $extension = end($temp);
            $filename = $temp[0].$extension;
            $piece->move($destinationPath,$filename);
            //$piece->store('piecetitrepropriete');
           // Storage::disk('public')->put($filename,);
        }
        Titrepropriete::create([
            'name' =>strtoupper($request['name']),
            'piece' =>$filename,
            'proprietaire_id' =>$request['proprietaire_id']
             ]);
        //dd($request->all());
        return redirect(route('titrepropriete.index'));
    }
    public function edit($id){
        $proprietaires = Proprietaire::all();
        $titrepropriete=Titrepropriete::find($id);
        return view('layouts.backend.titrepropriete.edit',compact('proprietaires','titrepropriete'));
    }

    public function update(TitreproprieteUpdateRequest $request,$id){
        $destinationPath='uploads/piecetitrepropriete/';
        $filename='';
        $titrepropriete = Titrepropriete::findOrFail($id);
        //dd($request->all());
        if($request->hasFile('piece')){
            $piece= $request->file('piece');
            $filename=$request['name'].'.'.$piece->getClientOriginalExtension();
            if(file_exists(public_path($destinationPath.$filename))){
                unlink(public_path($destinationPath.$filename));
            }
            $temp = explode(".", $filename);
            $extension = end($temp);
            $filename = $temp[0].$extension;
            $piece->move($destinationPath,$filename);
        }else
        {
            $filename=$titrepropriete->piece;
        }
       // dd($filename);
        $titrepropriete->name=strtoupper($request->get('name'));
        $titrepropriete->proprietaire_id=$request->get('proprietaire_id');
        $titrepropriete->piece=$filename;
        //dd( $filename);
        $titrepropriete->update();
        return redirect(route('titrepropriete.index'));
    }

    public function getpdf($id){
        $destinationPath='uploads/piecetitrepropriete/';
        $titrepropriete = Titrepropriete::findOrFail($id);
        $piece=$titrepropriete->piece;
        $array = explode('.', $piece);
        $filePath = $destinationPath.''.$array[0]; //array[1] contain a number
       // dd($filePath);
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/pdf");
        header("Content-Disposition: attachment; filename=" . urlencode($filePath));
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Description: File Transfer");
        header("Content-Length: " . filesize($filePath));
        flush(); // this doesn't really matter.
        $fp = fopen($filePath, "r");
        while (!feof($fp))
        {
            echo fread($fp, 65536);
            flush(); // this is essential for large downloads
        }
        fclose($fp);
        return Response::download($filePath, $piece);
    }

    public function titreproprieteaddajax(TitreproprieteCreateRequest $request)
    {
        $destinationPath='uploads/piecetitrepropriete/';
        $filename='';
        if ($request->hasFile('piece')) {
            $piece = $request->file('piece');
            $filename = $request['name'] . '.' . $piece->getClientOriginalExtension();
            if (file_exists(public_path($destinationPath . $filename))) {
                unlink(public_path($destinationPath . $filename));
            }
            $temp = explode(".", $filename);
            $extension = end($temp);
            $filename = $temp[0] . $extension;
            $piece->move($destinationPath, $filename);

            $titrepropriete = new Titrepropriete();
            $titrepropriete->name = strtoupper($request['name']);
            $titrepropriete->proprietaire_id = $request['proprietaire_id'];
            $titrepropriete->piece = $filename;
            $titrepropriete->save();
            $proprietaire=Proprietaire::find($titrepropriete->proprietaire_id );

            return response()->json([
                'id' => $titrepropriete->id,
                'name' => $titrepropriete->name,
                'proprietairename' => $proprietaire->name,
                'proprietairesurname' => $proprietaire->surname,
                'proprietairephone1' => $proprietaire->phone1,
                'message' => $request['name'] . ' enrégistré avec succès',
            ]);
        }
    }
}
