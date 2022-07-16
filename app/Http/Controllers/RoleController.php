<?php

namespace App\Http\Controllers;
use App\RolesPermission\Model\Role;
use App\RolesPermission\Model\Permission;
use Illuminate\Support\Facades\Gate;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('haveaccess', 'role.index');

        $roles = Role::orderBy('id', 'Desc')->paginate(3);

        return view('role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('haveaccess', 'role.create');
        $permissions = Permission::get();                   //Modulo de permisos y con get se obtine todos los permisos que hay y van haber
        return view('role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('haveaccess', 'role.create');

        $request->validate([
            'name'           => 'required|max:50|unique:roles,name',
            'slug'           => 'required|max:50|unique:roles,name',
            'full-access'    => 'required|in:yes,no'
        ]);

        $role = Role::create($request->all());

        //if($request->get('permission')){
            //return $request->all();
            $role ->permissions()->sync($request->get('permission'));
        //}

        return redirect()->route('role.index')
                ->with('status_success','Rol guardado con exito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        Gate::authorize('haveaccess', 'role.show');

        $permission_role = [];

        foreach($role->permissions as $permission){
            $permission_role[] = $permission->id;
        }

        $permissions = Permission::get();

        return view('role.view', compact('permissions', 'role', 'permission_role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        Gate::authorize('haveaccess', 'role.edit');

        $permission_role = [];

        foreach($role->permissions as $permission){
            $permission_role[] = $permission->id;
        }

        $permissions = Permission::get();

        return view('role.edit', compact('permissions', 'role', 'permission_role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        Gate::authorize('haveaccess', 'role.edit');

        $request->validate([
            'name'           => 'required|max:50|unique:roles,name,'.$role->id,
            'slug'           => 'required|max:50|unique:roles,slug,'.$role->id,
            'full-access'    => 'required|in:si,no'
        ]);

        $role->update($request->all());

        //Verifica si por lo menos existe un permiso
        //if($request->get('permission')){
            $role ->permissions()->sync($request->get('permission'));
        //}
        return redirect()->route('role.index')
                ->with('status_success','Rol actualizado exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        Gate::authorize('haveaccess', 'role.destroy');

        $role->delete();
        return redirect()->route('role.index')
                ->with('status_success','Rol eliminado exitosamente!');
    }
}
