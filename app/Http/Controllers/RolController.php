<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use Sentinel;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     * GET /grupo
     *
     * @return Response
     */
    public function index()
    {
        $data = Role::all();

        return view('sentinel.groups.index')->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     * GET /grupo/create
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('sentinel.groups.create');
    }

    /**
     * Store a newly created resource in storage.
     * POST /grupo
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'name'    => 'required|unique:roles',
            'slug'    => 'required|unique:roles',
        ]);

        // store
        $permisos =array();

        foreach($request->except("_token","name") as $key => $value)
        {
            $permisos[str_replace("_",".",$key)] = true;
        }

        $rol = (array(
            'name'        => $request->get('name'),
            'slug'        => $request->get('slug'),
            'permissions' => $permisos,
        ));

        $role = Sentinel::getRoleRepository()->createModel()->fill($rol)->save();

        if($role)
        {
            $request->session()->flash('message.success', 'Creado con exito!');
            return redirect(route('role.index'));
        }
        else
        {
            $request->session()->flash('message.error', 'Hubo un problema y no se creo el registro!');
            return redirect(route('role.create'));
        }

    }

    /**
     * Display the specified resource.
     * GET /grupo/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
        $data = Role::findOrFail($id);

        return view('sentinel.groups.show')->with('data' , $data);
    }

    /**
     * Show the form for editing the specified resource.
     * GET /grupo/{id}/edit
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
        $data = Role::find($id);

        return view('sentinel.groups.edit')->with('data' , $data);
    }

    /**
     * Update the specified resource in storage.
     * PUT /grupo/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request,$id)
    {

        $this->validate($request, [
            'name'        => 'required',
            'slug'        => 'required',
        ]);
        // store
        $group = Sentinel::findRoleById($id);
        $group->name = $request->get('name');
        $group->slug = $request->get('slug');
        $permisos =array();

        // BUSCAR TODOS LOS PERMISOS

        $permisoss =array();
        // BUSCAR TODOS LOS PERMISOS
        foreach(config('permisos.permissions') as $key => $permisos)
        {

            foreach($permisos as $key2 => $value)
            {

                if($request->get(str_replace(".","_",$key2)))
                {
                    $permisoss[$key2] = true;
                }
                else
                {
                    $permisoss[$key2] = false;
                }
            }

        }

        $group->permissions = ($permisoss);


        if($group->save())
        {
            $request->session()->flash('message.success', 'Actualizado con exito!');
            return redirect(route('role.edit',array($id)));
        }
        else
        {
            $request->session()->flash('message.error', 'Hubo un problema y no se actualizo el registro!');
            return redirect(route('role.edit',array($id)));
        }

    }

    /**
     * Remove the specified resource from storage.
     * DELETE /grupo/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request,$id)
    {
        $request->session()->flash('message.error', 'Funcion no disponible');
        return redirect(route('role.index'));
    }
}
