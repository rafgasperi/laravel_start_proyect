<?php

namespace App\Http\Controllers;

use Mockery\CountValidator\Exception;

use Illuminate\Http\Request;
use App\Role;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Sentinel;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * GET /usuarios
     *
     * @return Response
     */
    public function index()
    {
        $user = User::all();
        return view('sentinel.users.index')->with('users',$user);
    }

    /**
     * Show the form for creating a new resource.
     * GET /usuarios/create
     *
     * @return Response
     */
    public function create()
    {
        $roles = Role::pluck('slug','id');
        return view('sentinel.users.create')->with('roles',$roles);
    }

    /**
     * Store a newly created resource in storage.
     * POST /usuarios
     *
     * @return Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'role_id'    => 'required',
            'first_name' => 'required|max:255',
            'last_name'  => 'required|max:255',
            'username'   => 'required|unique:users|min:5',
            'email'      => 'required|email|max:255|unique:users',
            'dependencia_id'=>'required',
            'password'         => 'required',
            'password_confirm' => 'required|same:password'
        ]);

        $user = Sentinel::registerAndActivate(array(
            'username' => $request->get('username'),
            'email' => $request->get('email'),
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'password' => $request->get('password'),
        ));

        $role = Sentinel::findRoleById($request->get('role_id'));

        $role->users()->attach($user);

        $user->dependencia_id = $request->get('dependencia_id');
        $user->save();
        //$user->notify(new NewUser($user));

        session()->flash('message.success', 'Su cuenta ha sido creada con éxito. Para ingresar, debe usar su correo electrónico y celular.');
        return redirect('user/'.$user->id);



    }


    /**
     * Display the specified resource.
     * GET /usuario/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $data = User::find($id);
        return view('sentinel.users.show')->with('user' , $data);
    }

    /**
     * Show the form for editing the specified resource.
     * GET /usuarios/{id}/edit
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
        $data = User::find($id);
        $user = Sentinel::findUserById($id);

        return view('sentinel.users.edit')
            ->with("user", $data)
            ->with("roles",getListRoles());
    }

    /**
     * Update the specified resource in storage.
     * PUT /usuarios/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'first_name'=> 'required',
            'last_name' => 'required',
            'email'     => 'required',
            'dependencia_id'     => 'required',
        ]);

        $model = User::findOrFail($id);

        DB::transaction(function() use($request,$model){
            // store

            $model->fill($request->except('redirect_to','roles'));

            $rol = $request->input("roles");

            if(isset($rol))
            {
                $model->roles()->sync($request->input("roles"));
            }

            if($model->save())
            {
                $request->session()->flash('message.success', 'Actualizado con exito!');
            }
            else
            {
                throw new Exception('Hubo un error al actualizar el usuario');

            }

        });

        $request->session()->flash('message.success', 'Actualizado con exito!');

        if ($request->input('redirect_to')  <> "")
            return redirect($request->input('redirect_to'));

        return redirect(route('user.edit',array($id)));

    }

    /**
     * Remove the specified resource from storage.
     * DELETE /usuarios/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request,$id)
    {
        //
        $user = Sentinel::findUserById($id);
        // Delete the user
        $user->activated= false;

        $acti = \App\Activation::whereUserId($user->id)->first();
        $acti->completed = false;

        if($acti->save())
        {
            $request->session()->flash('message.success', 'Eliminado con exito!');
        }
        else
        {
            $request->session()->flash('message.error', 'Hubo un problema y no se elimino el registro!');
        }

        return redirect('user');
    }

    /**
     * Show profile of autenticate user.
     * POST /usuarios/{id}/perfil
     *
     * @return Response
     */
    public function perfil($id)
    {
        //

        if(Sentinel::getUser()->id == $id)
        {
            $usuario = User::find($id);

            return view('sentinel.users.profile')->with("usuario",$usuario);
        }
        else
        {
            return abort(403, 'Acceso Denegado!');
        }

    }


    /**
     * Update the specified resource in storage.
     * PUT /usuarios/{id}/change_password
     *
     * @param  int  $id
     * @return Response
     */
    public function updatePassword(Request $request,$id)
    {
        $this->validate($request, [
            'password' => 'required|min:4|confirmed',
            'password_confirmation' => 'required|min:4'
        ]);

        $user = Sentinel::getUserProvider()->findById($id);
        $user->password = $request->input('password');


        if($user->save())
        {
            $request->session()->flash('message.success', 'Password actualizado con exito!');

            return redirect($request->input('redirect_to'));
        }
        else
        {
            ession::flash('message.error', 'Hubo un error y no se pudo actualizar el password.');

            return redirect($request->input('redirect_to'));
        }

    }

    /**
     * Update the specified resource in storage.
     * PUT /usuarios/{id}/end_contract
     *
     * @param  int  $id
     * @return Response
     */
    public function end_contract(Request $request,$id){

        $this->validate($request, [
            'fecha_final_contrato' => 'required',
            'redirect_to' => 'required',
        ]);


        $user = User::find($id);
        $user->fecha_final_contrato = $request->input('fecha_final_contrato');
        $user->activated = false;
        $user->save();
        if($user->save())
        {
            $request->session()->flash('message.success', 'Usuario dado de baja exitosamente');

            return redirect($request->input('redirect_to'));
        }
        else
        {
            $request->session()->flash('message.error', 'Hubo un error y no se pudo dar de baja al usuario.');

            return redirect($request->input('redirect_to'));
        }

    }

    /**
     * Update the specified resource in storage.
     * PUT /usuarios/{id}/subir_foto
     *
     * @param  int  $id
     * @return Response
     */
    public function subirFotoPerfil(Request $request,$id){

        $this->validate($request, [
            'file' => 'required|image|max:200px',
            'path' => 'required',
            'redirect_to' => 'required',
        ]);


        $ext =  $request->file('file')->getClientOriginalExtension();
        $filename = 'user_'.$id.".".$ext;
        $upload = Storage::disk('public')->putFileAs('profile_picture',$request->file('file'),$filename);
        if($upload)
        {
            $user = User::find($id);
            $user->foto = url('storage/'.$upload);

            if($user->save()){
                $request->session()->flash('message.success', 'Foto de pefil subida exitosamente');

                return redirect($request->input('redirect_to'));
            }
        }
        else
        {
            //$request->session()->flash('message.error', 'Hubo un error y no se pudo subir la foro de perfil del usuario (Error : '.$subirArchivo['message'].').');

            return redirect($request->input('redirect_to'));
        }
    }

    /**
     * Update the specified resource in storage.
     * PUT /usuarios/{id}/actualizar_permisos
     *
     * @param  int  $id
     * @return Response
     */
    public function actualizarPermisos(Request $request,$id)
    {
        $user = User::find($id);

        $sentry_user = Sentinel::find($id);
        $sentry_group = Sentinel::findGroupById($user->grupos()->first()->id);

        $permisoss =array();
        // BUSCAR TODOS LOS PERMISOS
        foreach(config('permisos.permissions') as $key => $permisos)
        {
            foreach($permisos as $key2 => $value)
            {

                if($request->get(str_replace(".","_",$key2)))
                {
                    if(!$sentry_group->hasAccess($key2) && !$sentry_user->hasAccess($key2))
                        $permisoss[$key2] = 1;
                }
                else
                {
                    if($sentry_user->hasAccess($key2))
                        $permisoss[$key2] = 0;
                }
            }
        }

        // buscar los permisos que ya tenia seteado este usuario especifico y concatenarlo a sus nuevos permisos
        if(count(json_decode($user->permissions)) > 0)
        {
            foreach (json_decode($user->permissions) as $key3 => $value3)
            {

                if(!isset($permisoss[$key3]))
                {
                    $permisoss[$key3] =$value3;
                }
            }
        }

        $user->permissions = json_encode($permisoss);


        if($user->save())
        {
            $request->session()->flash('message.success', 'Actualizado con exito!');
            return redirect(route('users.edit',array($id)));
        }
        else
        {
            $request->session()->flash('message.error', 'Hubo un problema y no se actualizo el registro!');
            return redirect(route('users.edit',array($id)));
        }

    }


}
