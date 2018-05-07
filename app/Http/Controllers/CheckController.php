<?php

namespace App\Http\Controllers;

use App\admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class CheckController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth',[
        ]);
    }
    //
    public function show(admin $admin)
    {
        return view('check.index',compact('admin'));
    }

    public function edit(admin $admin)
    {
        return view('check.edit',compact('admin'));
    }

    public function update(Request $request,admin $admin)
    {
           if (Hash::check($request->oldpassword, $admin->password)){
               return back()->with('danger','修改失败旧密码错误');
           }
        $this->validate($request,[
            'password'=>'required|min:6|max:18|confirmed',
        ],[
            'password.max'=>'密码最长为十八位',
            'password.min'=>'密码最短为六位',
            'password.required'=>'密码必填',
        ]);
           $admin->update([
               'password'=>bcrypt($request->password),
           ]);
           session()->flash('success','修改成功');
            return redirect()->route('logout')->with('success','修改密码成功,你需要重新登录');
    }

    public function update2(Request $request,admin $admin)
    {
        $this->validate($request,[
            'username'=>'required|min:5',
            'email' => [
                'required',
                Rule::unique('admins')->ignore($admin->id),
            ],
        ],[
            'username.required'=>'用户名必填',
            'username.min'=>'用户名不能少于五位',
            'email.required'=>'邮箱必填',
            'email.unique'=>'邮箱已经存在',
        ]);
        $admin->update([
            'username'=>$request->username,
            'email'=>$request->email,
        ]);
    return redirect()->route('admin.index')->with('success','修改成功');
    }

}
