<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PermissionsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth',[
        ]);
    }
    //权限首页
    public function index(Request $request)
    {
        //得到所有数据
        $name=$request->keywords;
        $permissions= Permission::where('name','like',"%$name%")->paginate(3);
        return view('permission.index',compact('permissions','name'));
    }

    public function create()
    {
        //返回视图
        return view('permission.create');
    }

    public function store(Request $request)
    {//过滤
        $this->validate($request,[
            'name'=>'required|unique:permissions',
            'display_name'=>'required|unique:permissions',
            'description'=>'required'
        ],[
    'name.required'=>'权限名称必填',
    'name.unique'=>'权限名称已存在',
    'display_name.unique'=>'展示名称已存在',
    'display_name.required'=>'展示名称必填',
    'description.required'=>'权限描述必填',
        ]);
    Permission::create(
        [
            'name'=>$request->name,
            'display_name'=>$request->display_name,
            'description'=>$request->description,
        ]
    );
    //跳转
    return redirect()->route('permission.index')->with('success','添加成功');
    }

    public function edit(Permission $permission)
    {
        return view('permission.edit',compact('permission'));
    }

    public function update(Request $request,Permission $permission)
    {
        $this->validate($request,[
            'name' => [
                'required',
                Rule::unique('permissions')->ignore($permission->id),
            ],
            'display_name' => [
                'required',
                Rule::unique('permissions')->ignore($permission->id),
            ],
            'description'=>'required'
        ],[
            'name.required'=>'权限名称必填',
            'name.unique'=>'权限名称已存在',
            'display_name.unique'=>'展示名称已存在',
            'display_name.required'=>'展示名称必填',
            'description.required'=>'权限描述必填',
        ]);
        //修改
        $permission->update([
            'name'=>$request->name,
            'display_name'=>$request->display_name,
            'description'=>$request->description,
        ]);

        return redirect()->route('permission.index')->with('success','修改成功');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
    }

}
