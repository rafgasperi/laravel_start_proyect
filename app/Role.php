<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends BaseModel
{
    protected $fillable = ['slug','name','permissions'];

    public function usuarios(){
        return $this->belongsToMany('\App\User','role_users');
    }
}
