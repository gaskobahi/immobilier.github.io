<?php

namespace App;


use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    protected $fillable = [
        'name',
        'display_name',
        'description'
    ];


    public function permission()
    {
        return $this->belongsToMany(Permission::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function getRolePermission()
    {
        $permission=DB::table('permission')
            ->join('permission_role', 'permission_role.permission_id', '=', 'permission.id')
            ->join('roles', $this->id, '=', 'permission_role.role_id')
            ->select('permission.*')
            ->get();
        return $permission;
    }

   /* public function hasPermissions($val)
    {
        if($this->getRolePermission()->name==$val){
            return true;
        }
        return false;
    }*/

}