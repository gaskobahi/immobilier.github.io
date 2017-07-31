<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class permission_role extends Model
{
    protected $fillable = [
        'role_id',
        'permission_id',
    ];
    public function permission(){
        return $this->belongsTo(Permission::class);
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }
}
