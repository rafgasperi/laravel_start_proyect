<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $fillable = ['user_id','role_id'];

    public function usuario(){
        return $this->belongsTo('\App\User','user_id');
    }

    public function rol(){
        return $this->belongsTo('\App\Role','role_id');
    }
}
