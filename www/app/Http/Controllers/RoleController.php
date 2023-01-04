<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\RoleUpdateRequest;
use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('MachineInfo');
        $this->middleware('FullyPaid');
    }
    public function index()
    {
        $roles = Role::all();
        $permission = Permission::pluck('name','id');
        return view('roles.index',compact('roles','permission'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRoleRequest $request)
    {
        $role = new Role();
        $role->name = $request->name;
        $role->display_name = $request->display_name;
        $role->description = $request->description;

        $role->save();

        foreach ($request->permission as $key) {

            $role->attachPermission($key);
        }
        return response()->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
       // $permission = DB::table('roles')->join('permission_role','permission_role.role_id' ,'=',$id)->get();
       $selectedPermission = DB::table('permission_role')->where('permission_role.role_id', $id)->pluck('permission_id')->toArray();
       $real = [];
       foreach($selectedPermission as $permission) {

        $reals = Permission::where('id',$permission)->get();
        array_push($real,$reals);
       }

        return response()->json(['role' => $role,'permission' => $real]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleUpdateRequest $request, $id)
    {

        $role = Role::find($id);
        $role->name = $request->name;
        $role->display_name = $request->display_name;
        $role->description = $request->description;

        $role->update();

        DB::table('permission_role')->where('role_id', $id)->delete();

        foreach ($request->permission as $key) {

            $role->attachPermission($key);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Role::where('id', $id)->delete();

        return response()->json(['success'=> true]);
    }
}
