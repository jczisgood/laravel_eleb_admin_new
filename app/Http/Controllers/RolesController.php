<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth',[
        ]);
    }
    //
    public function index(Request $request)
    {
        $name=$request->keywords;
        $roles=Role::where('display_name','like',"%$name%")->paginate(2);
        return view('role.index',compact('roles','name'));
    }

    public function create()
    {
        $permissions=Permission::all();
        return view('role.create',compact('permissions'));
    }

    public function store(Request $request)
    {
        $owner = Role::create($request->except('_token','role'));
        $owner->attachPermissions($request->role);
        return redirect()->route('role.index')->with('success','添加成功');
    }

    public function edit(Role $role)
    {
        //得到所有权限
        $permissions=Permission::all();
//        dd($ids);
        //返回一个视图
        return view('role.edit',compact('role','permissions'));
    }

    public function update(Request $request,Role $role)
    {
        $role->update($request->except('_token','role','_method'));
//        dd($request->except('_token','role','_method'));
        $role->syncPermissions($request->role);
        return redirect()->route('role.index')->with('success','修改成功');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        $role->syncPermissions([]);
    }
}
