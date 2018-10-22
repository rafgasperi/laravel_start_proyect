<?php

function imprimir($object){
    echo "<pre>";
    print_r($object);
    echo "</pre>";
}

function sendmail($data,$subject,$to)
{
    if(!isset($data['level']))
    {
        $data['level']= "";
    }
    if(!isset($data['introLines']))
    {
        $data['outroLines'][] = "";
    }
    if(!isset($data['outroLines']))
    {
        $data['outroLines'][] = "";
    }

    \Mail::send('vendor.notifications.email',$data, function($message) use($subject,$to)
    {
        foreach($to as $key => $value)
        {
            $message->to($value, $key)->subject($subject);
        }
    });
}

function guardarUserLog($tabla='',$id=null,$accion=''){

    if(\Sentinel::check()){
        return \App\UserLog::create([
            'user_id'=>\Sentinel::getUser()->id,
            'tabla'=>$tabla,
            'registro_id'=>$id,
            'accion'=>$accion
        ]);
    }else{
        return \App\UserLog::create([
            'user_id'=>1,
            'tabla'=>$tabla,
            'registro_id'=>$id,
            'accion'=>$accion
        ]);
    }

}

function getListRoles(){

    return \App\Role::pluck('slug','id');
}

