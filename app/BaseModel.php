<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaseModel extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at','created_at','updated_at'];

    public static function boot()
    {
        parent::boot();
        static::updating(function($model)
        {
            // do some logging
            // override some property like $model->something = transform($something);
            $changes = $model->isDirty() ? $model->getDirty() : false;

            if(count($changes)>0)
            {
                foreach($changes as $attr => $value)
                {
                    $accion = "Se modifico la columna ($attr) : de [{$model->getOriginal($attr)}] a [{$model->$attr}]";
                    guardarUserLog($model->getTable(),$model->id,$accion);
                }
            }

        });
        static::created(function($model)
        {
            // do some logging
            // override some property like $model->something = transform($something);
            guardarUserLog($model->getTable(),$model->id,'Registro creado');
        });
        static::deleted(function($model)
        {
            // do some logging
            // override some property like $model->something = transform($something);
            guardarUserLog($model->getTable(),$model->id,'Registro eliminado');
        });
    }


    public function getCreatedAtAttribute($attr) {
        return Carbon::parse($attr)->format('d-m-Y H:i:s'); //Change the format to whichever you desire
    }

    public function getUpdatedAtAttribute($attr) {
        return Carbon::parse($attr)->format('d-m-Y H:i:s'); //Change the format to whichever you desire
    }
}
