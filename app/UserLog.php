<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserLog extends Model
{
    protected $table = 'user_logs';
    protected $fillable = ['user_id','tabla','registro_id','accion'];

    public function usuario(){
        return $this->belongsTo('\App\user');
    }

    public function registro(){

        return DB::table($this->getTable())->whereId($this->registro_id)->first();
    }

}
