<?php

namespace App\Http\Controllers;

use App\admin;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AdminsController extends Controller
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
        if(!Auth::user()->can('admin.create')){
            return 'sorry,you can\'t visited this web';
        }
        $name=$request->keywords;
        $admins=admin::where('username','like',"%$name%")->paginate(3);
        return view('admin.index',compact('name','admins'));
    }

    public function create(admin $admin)
    {
        if(!Auth::user()->can('admin.create')){
            return 'sorry,you can\'t visited this web';
        }
        $roles=Role::all();
        return view('admin.create',compact('admin','roles'));
    }

    public function store(Request $request)
    {if(!Auth::user()->can('category.create')){
        return 'sorry,you can\'t visited this web';
    }
        $this->validate($request,[
            'username'=>'required|min:5|max:18',
            'password'=>'required|min:6|max:18',
            'email'=>'required|email|unique:admins',
        ],[
            'username.required'=>'用户名必填',
            'username.min'=>'用户名最小为五位',
            'username.max'=>'用户名最长为十八位',
            'password.max'=>'密码最长为十八位',
            'password.min'=>'密码最短为六位',
            'password.required'=>'密码必填',
            'email.required'=>'邮箱必填',
            'email.email'=>'邮箱格式不正确',
            'email.unique'=>'邮箱已存在',
        ]);
        $admin=admin::create([
           'username'=>$request->username,
           'password'=>bcrypt($request->password),
           'email'=>$request->email,
        ]);
        if($request->role_id) {
            $admin->attachRoles($request->role_id);
        }
            session()->flash('success','添加成功');
        return redirect()->route('admin.index');
    }

    public function edit(admin $admin)
    {if(!Auth::user()->can('admin.edit')){
        return 'sorry,you can\'t visited this web';
    }
        $roles=Role::all();
        return view('admin.edit',compact('admin','roles'));
    }

    public function update(Request $request,admin $admin)
    {
        $this->validate($request,[
            'username'=>'required|min:5|max:18',
            'email' => [
                'required',
                'email',
                Rule::unique('admins')->ignore($admin->id),
            ],
        ],[
            'username.required'=>'用户名必填',
            'username.min'=>'用户名最小为五位',
            'username.max'=>'用户名最长为十八位',
            'email.required'=>'邮箱必须填写',
            'email.email'=>'邮箱格式错误',
            'email.unique'=>'邮箱已经存在',
        ]);
        $admin->update([
            'username'=>$request->username,
            'email'=>$request->email,
        ]);
        $admin->syncRoles($request->role_id);
        return redirect()->route('admin.index')->with('success','修改成功');
    }

    public function destroy(admin $admin)
    {
        if(!Auth::user()->can('admin.destroy')){
            return 'sorry,you can\'t visited this web';
        }
        $admin->delete();
        $admin->syncRoles([]);
    }
}
