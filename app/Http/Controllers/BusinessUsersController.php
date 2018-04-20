<?php

namespace App\Http\Controllers;

use App\Business;
use App\BusinessCategory;
use App\Businessuser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BusinessUsersController extends Controller
{
    public function index(Request $request)
    {
        $name=$request->keywords;
        $businessusers=Businessuser::where('name','like',"%$name%")->paginate(3);
        return view('business.index',compact('name','businessusers'));
    }

    public function create()
    {
        $categories= BusinessCategory::all()->pluck('id','name');
        return view('business.create',compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|min:2|max:20',
            'password'=>'required|min:6|max:18|confirmed',
            'cover'=>'image',
            'phone'=>'required|max:11|min:11',
        ],[
            'name.required'=>'姓名不能为空',
            'name.min'=>'姓名长度至少2位',
            'name.max'=>'姓名长度不能超过20位',
            'password.required'=>'密码不能为空',
            'password.min'=>'密码长度不能少于6位',
            'password.max'=>'密码长度不能大于18位',
            'password.confirmed'=>'确认密码与密码不一致',
            'phone.required'=>'手机不能为空',
            'phone.max'=>'手机号格式错误',
            'phone.min'=>'手机号格式错误',
        ]);
        Businessuser::create([
            'name'=>$request->name,
            'password'=>$request->password,
            'phone'=>$request->phone,
            'category_id'=>$request->category_id,
            'status'=>1,
        ]);
        session()->flash('success','添加成功');
        return redirect()->route('businessuers.index');
    }

    public function edit(Businessuser $businessuser)
    {

//        dd($businessuser->id);
//        dd($businessuser);
     $categories= BusinessCategory::all()->pluck('id','name');
//     dd($categories);
        return view('business.edit',compact('businessuser','categories'));
    }

    public function destroy(Businessuser $businessuser)
    {
        $businessuser->delete();
    }
}
