<?php

namespace App\Http\Controllers;

use App\admin;
use Illuminate\Http\Request;

class AdminsController extends Controller
{
    //
    public function index(Request $request)
    {
        $name=$request->keywords;
        $admins=admin::where('username','like',"%$name%")->paginate(3);
        return view('admin.index',compact('name','admins'));
    }

    public function create(admin $admin)
    {
        return view('admin.create',compact('admin'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'username'=>'required|min:6|max:18',
            'password'=>'required|min:6|max:18',
            'email'=>'required|email',
        ],[
            'username.required'=>'用户名必填',
            'username.min'=>'用户名最小为六位',
            'username.max'=>'用户名最长为十八位',
            'password.max'=>'密码最长为十八位',
            'password.min'=>'密码最短为六位',
            'password.required'=>'密码必填',
        ]);
        admin::create([
           'username'=>$request->username,
           'password'=>bcrypt($request->password),
           'email'=>$request->email,
        ]);
        session()->flash('success','添加成功');
        return redirect()->route('admin.index');
    }

    public function edit(admin $admin)
    {
        return view('admin.edit',compact('admin'));
    }
}
