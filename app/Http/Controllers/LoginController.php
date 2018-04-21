<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function index()
    {

        return view('login.index');
    }

    public function store(Request $request)
    {
        $res=$this->validate($request,[
            'username'=>'required|min:2',
            'password'=>'required|max:18|min:6',
//            'captcha'=>'required|captcha'
        ],[
            'username.required'=>'请填写用户名',
            'username.min'=>'用户名不可能少于两位',
            'password.min'=>'密码不可能少于六位',
            'password.max'=>'用户名不能大于18位',
            'password.请填写密码'=>'用户名不能大于18位',
//            'captcha.required'=>'请填写验证码',
//            'captcha.captcha'=>'请填写正确的验证码',
        ]);
        if(Auth::attempt($res,$request->has('rememberME'))){
            session()->flash('success','登录成功,祝你有一段美好的旅程');
            return redirect()->route('businessusers.index');
        }else{
            session()->flash('danger','登录失败,用户名或者密码错误');
            return redirect()->route('login');
        }
    }

    public function destroy()
    {
        Auth::logout();
        session()->flash('success','退出成功');
        return redirect()->route('login');
    }

}
