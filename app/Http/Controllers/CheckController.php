<?php

namespace App\Http\Controllers;

use App\admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CheckController extends Controller
{
    //
    public function show(admin $admin)
    {
        return view('check.index',compact('admin'));
    }

    public function update(Request $request,admin $admin)
    {
           if (Hash::check($request->oldpassword, $admin->password)){
               return back()->with('danger','修改失败旧密码错误');
           }
        $this->validate($request,[
            'username'=>'required|min:6|max:18',
            'password'=>'required|min:6|max:18|confirmed',
            'email'=>'required|email',
        ],[
            'username.required'=>'用户名必填',
            'username.min'=>'用户名最小为六位',
            'username.max'=>'用户名最长为十八位',
            'password.max'=>'密码最长为十八位',
            'password.min'=>'密码最短为六位',
            'password.required'=>'密码必填',
        ]);
           $admin->update([
               'username'=>$request->username,
               'password'=>bcrypt($request->password),
               'email'=>$request->email,
           ]);
           session()->flash('success','修改成功');
            return redirect()->route('logout');
    }
}
