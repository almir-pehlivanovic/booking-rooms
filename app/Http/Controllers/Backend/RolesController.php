<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Role;
use App\Permission;
use DB;

class RolesController extends Controller
{
    protected $paginateNum = 7;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::paginate($this->paginateNum);

        return view('booking-rooms.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Role $roles)
    {
        $permissions    = Permission::all();
        $permissionCheck= FALSE;
        return view('booking-rooms.roles.create', compact('roles', 'permissions', 'permissionCheck'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $storeData = $request->validate([
            'name'       => 'required',
            'permission' => 'required'
            ]);

        
        $data = $request->all();
        $data = $request->except('permission');   

        $roles = Role::create($data);

        //attach roles permissions
        $roleName   = Role::whereName($data['name'])->first();
        foreach($request['permission'] as $permission)
        {
            $roleName->attachPermission($permission);
        }

        return redirect('/backend/roles')->with('message', 'Role added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role               = Role::where('id', $id)->firstOrFail();
        $permissions_role   = DB::table('permission_role')->where('role_id', $id)->get();
    
        $permissionsA = [];
        foreach($permissions_role as $permission)
        {
            $permissionsA[] = $permission->permission_id;
        }
        $permissions = Permission::whereIn('id', $permissionsA)->get();
       
        return view('booking-rooms.roles.show', compact('role', 'permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles          = Role::where('id', $id)->firstOrFail();
        $permissions    = Permission::all();
        $permissionCheck = FALSE;
        return view('booking-rooms.roles.edit', compact('roles', 'permissions', 'permissionCheck'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $data = $request->all();

        if(isset($data['permission']))
        {
            $roleName       = Role::whereName($data['name'])->first();
            $permissionAll  = Permission::all();
    
            foreach($permissionAll as $permissionAll)
            {
                $roleName->detachPermission($permissionAll);
            }
    
            foreach($data['permission'] as $permission)
            {
                $roleName->attachPermission($permission);
            }
        }

        $data = $request->except('permission');

        $role->update($data);

        //attach roles permissions
       
        return redirect('/backend/roles')->with('message', 'Role updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role       = Role::findOrFail($id);
        $roleName   = Role::whereName($role['name'])->first();
 
        $permissions_role   = DB::table('permission_role')->where('role_id', $id)->get();
        $permissionsA       = [];
        foreach($permissions_role as $permission)
        {
            $permissionsA[] = $permission->permission_id;
        }
        $permissions = Permission::whereIn('id', $permissionsA)->get();
       
        foreach($permissions as $permission)
        {
            $roleName->detachPermission($permission);
        }

        $role->delete();

        return redirect('/backend/roles')->with('message', 'Your role has been deleted successfully!');
    }
}
