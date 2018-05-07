<?php

namespace App\Http\Controllers;

use App\Business;
use App\BusinessCategory;
use App\Businessuser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class BusinessUsersController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth',[
        ]);
    }
    public function index(Request $request)
    {
        if(!Auth::user()->can('businessusers.index')){
        return 'sorry,you can\'t visited this web';
    }
        if(!Auth::user()->can('businessusers.index')){
            return 'sorry,you can\'t visited this web';
        }

        $name=$request->keywords;
        $businessusers=Businessuser::where('name','like',"%$name%")->paginate(3);
        return view('business.index',compact('name','businessusers'));
    }

    public function create()
    {
        if(!Auth::user()->can('businessusers.create')){
            return 'sorry,you can\'t visited this web';
        }
        if(!Auth::user()->can('businessusers.index')){
            return 'sorry,you can\'t visited this web';
        }
        $categories= BusinessCategory::all()->pluck('id','name');
        return view('business.create',compact('categories'));
    }

    public function store(Request $request)
    {
        if(!Auth::user()->can('businessusers.create')){
            return 'sorry,you can\'t visited this web';
        }
        $this->validate($request,[
            'name'=>'required|min:2|max:20',
            'password'=>'required|min:6|max:18|confirmed',
            'email'=>'required|email|unique:businessusers',
        ],[
            'name.required'=>'姓名不能为空',
            'name.min'=>'姓名长度至少2位',
            'name.max'=>'姓名长度不能超过20位',
            'password.required'=>'密码不能为空',
            'password.min'=>'密码长度不能少于6位',
            'password.max'=>'密码长度不能大于18位',
            'password.confirmed'=>'确认密码与密码不一致',
            'email.required'=>'邮箱不能为空',
            'email.email'=>'邮箱格式错误',
            'email.unique'=>'邮箱已存在',
        ]);
        DB::transaction(function ()use($request){
            DB::table('business_details')->insert([
                'shop_name'=>$request->name,
            ]);
            $bd=DB::getPdo()->lastInsertId();
            Businessuser::create([
                'name'=>$request->name,
                'password'=>bcrypt($request->password),
                'email'=>$request->email,
                'category_id'=>$request->category_id,
                'status'=>1,
                'user_id'=>$bd
            ]);
        });
        session()->flash('success','添加成功');
        return redirect()->route('businessusers.index');
    }

    public function edit(Businessuser $businessuser)
    {
        if(!Auth::user()->can('businessusers.edit')){
            return 'sorry,you can\'t visited this web';
        }
        if(!Auth::user()->can('businessusers.edit')){
            return 'sorry,you can\'t visited this web';
        }

//        dd($businessuser->id);
//        dd($businessuser);
     $categories= BusinessCategory::all()->pluck('id','name');
//     dd($categories);
        return view('business.edit',compact('businessuser','categories'));
    }

    public function update(Request $request,Businessuser $businessuser)
    {
        if(!Auth::user()->can('businessusers.index')){
            return 'sorry,you can\'t visited this web';
        }
        $this->validate($request,[
            'name'=>'required|min:2|max:20',
            'email' => [
                'required',
                'email',
                Rule::unique('businessusers')->ignore($businessuser->id)],
        ],[
            'name.required'=>'姓名不能为空',
            'name.min'=>'姓名长度至少2位',
            'name.max'=>'姓名长度不能超过20位',
            'email.required'=>'邮箱必须填写',
            'email.email'=>'邮箱格式错误',
            'email.unique'=>'邮箱已经存在',
        ]);
        $businessuser->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'category_id'=>$request->category_id,
            'status'=>$request->status,
        ]);
        session()->flash('success','修改成功');
        return redirect()->route('businessusers.index');
    }
    public function destroy(Businessuser $businessuser)
    {
        if(!Auth::user()->can('businessusers.destroy')){
            return 'sorry,you can\'t visited this web';
        }
        $businessuser->delete();
    }

    public function check(Businessuser $businessuser)
    {
//dd(1);
//        dd($businessuser->status);
        $res=$businessuser->status==0?1:0;
    $businessuser->update([
        'status'=>$res
        ]);
    $message=$res==1?'审核通过':'审核拒绝';
        $email=$businessuser->email;
        Mail::send(
            'business.email',//邮件视图模板
            ['name'=>$businessuser->name,
                'status'=>$things=$res?'完成通过':'拒绝通过',
                'messagea'=>$things=$res?'祝你生意兴隆,大吉大利':'希望你加以改进'],
            function ($message)use($email){
                $message->to($email)->subject('订单确认');
//                dd($email);
            }
        );
        session()->flash('success',$message);
        return redirect()->route('businessusers.index');
    }
}
