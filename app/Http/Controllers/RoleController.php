<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleCreateRequest;
use App\Permission;
use App\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    protected $isrolepermissiondone;
    public function __Construct(){
    }

    public function index(){
        $roles=Role::orderBy('created_at', 'desc')->paginate(6);
        $link=$roles->links();
        return view('layouts.backend.role.index',compact('roles','link'));
    }
    public function create(){
        return view('layouts.backend.role.create');
    }

    public function store(RoleCreateRequest $request){
        $role = new Role();
        $role->name  = strtolower($request['name']);
        $role->display_name =strtolower($request['display_name']); // optional
        $role->description  = $request['description']; // optional
        $role->save();
        return redirect(route('role.index'));
    }

    public function edit(Request $request){
        $this->validate($request,[
            'name' => 'required|max:255|unique:roles,name,' . $request['id'],
            'display_name' => 'required|max:255|unique:roles,display_name,' .$request['id'],
            'description' => 'max:255'
        ]);
        $role =Role::findOrFail($request['id']);
        $role->name=strtolower($request['name']);
        $role->display_name=strtolower($request['display_name']);
        $role->description=$request['description'];
        $role->update();
        return response()->json([
            'message'=>'Modification effectuée avec succès',
            'id'=> $role->id,
            'name'=> $role->name,
            'displayname'=>$role->display_name,
            'description'=>$role->description],201);
    }


    public function rolepermissionindex($id){
        $allpermissons=Permission::orderBy('name', 'asc')->get();
        $rolename=$this->getSIngleELement($id);
        $rpermissions=$this->getRolePermissions($id);
        $link=$rpermissions->links();
        return view('layouts.backend.role.permissionRole',compact('rpermissions','rolename','allpermissons','link'));
    }

    public function addpermissiontorole(Request $request){
        $req=$request->only('role','permission');
        $permissionParm=$req['permission'];
        $roleParm=$req['role'];
        $permission=Permission::where('id',$permissionParm)->first();
        $role=Role::where('id',$roleParm)->first();
        if( !$role->hasPermission($permission->name)){
            $role->attachPermission($permission);
            $this->isrolepermissiondone=true;
            return response()->json([
                'message'=>$permission->name.' à été attribuée à '.$role->name,
                'permissionid'=>$permission->id,
                'permissionName'=>$permission->name,
                'isdone'=>$this->isrolepermissiondone
            ]);
        }else{
            $this->isrolepermissiondone=false;
            return response()->json([
                'message'=>$role->name.' à déjà cette permission '.$permission->name,
                'isdone'=>$this->isrolepermissiondone
            ]);
        }
    }


    public function roleaddfromregisteruser(RoleCreateRequest $request){
        $req=$request->only('name','display_name','description');
        $role = new Role();
        $role->name  = strtolower($req['name']);
        $role->display_name =strtolower($req['display_name']); // optional
        $role->description  = $req['description']; // optional
        $role->save();
        return response()->json([
            'id'=>$role->id,
            'name'=>$role->name,
            'message'=>$req['name'].' enrégistré avec succès',
        ]);
    }


  public function getRolePermissions($id){
        $rp = DB::table('roles')
            ->join('permission_role', 'roles.id', '=', 'permission_role.role_id')
            ->join('permissions', 'permissions.id', '=', 'permission_role.permission_id')
            ->where('roles.id', '=',$id)
            ->select('roles.name as role', 'permissions.name as permissions','permissions.id as id')
            ->paginate(10);
        $rpermissions =(object)$rp;
        return $rpermissions;
    }

    public function getSIngleELement($id){
        $name =$user = DB::table('roles')->where('id',$id)->first();
        return $name;
    }

    public function detachpermissionfromrole(Request $request){
        $req=$request->only('roleId','permissionId','permissionName');
        $r=$req['roleId'];
        $p=$req['permissionId'];
        $result=$this->deleteRolePermission($r,$p);
        return response()->json([
            'res'=>$result,
            'message'=>$req['permissionName'].' supprimée avec succès',
            'perm_id'=>$p,
        ]);
    }


    public function deleteRolePermission($role,$permission){
        $result=DB::table('permission_role')->where('role_id',$role)
            ->where('permission_id',$permission)
            ->delete();
        return $result;
    }




}
