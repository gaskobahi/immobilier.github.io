<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionCreateRequest;
use App\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{

    public function index(){
        $permissions=Permission::orderBy('created_at', 'desc')->paginate(10);
        $link=$permissions->links();
        return view('layouts.backend.permission.index',compact('permissions','link'));
    }
    public function create(){
        return view('layouts.backend.permission.create');
    }

    public function store(PermissionCreateRequest $request){
        $permission = new Permission();
        $permission->name  = strtolower($request['name']);
        $permission->display_name =strtolower($request['display_name']); // optional
        $permission->description  = $request['description']; // optional
        $permission->save();
        return redirect(route('permission.index'));
    }

    public function edit(Request $request){
        $this->validate($request,[
            'name' => 'required|max:255|unique:permissions,name,' . $request['id'],
            'display_name' => 'required|max:255|unique:permissions,display_name,' .$request['id'],
            'description' => 'max:255'
        ]);
        $permission =Permission::findOrFail($request['id']);
        $permission->name=strtolower($request['name']);
        $permission->display_name=strtolower($request['display_name']);
        $permission->description=$request['description'];
        $permission->update();
        return response()->json([
            'message'=>'Modification effectuée avec succès',
            'id'=> $permission->id,
            'name'=> $permission->name,
            'displayname'=>$permission->display_name,
            'description'=>$permission->description],201);
    }


}
