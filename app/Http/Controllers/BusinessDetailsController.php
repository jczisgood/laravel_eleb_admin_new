<?php

namespace App\Http\Controllers;

use App\BusinessCategory;
use App\BusinessDetail;
use App\Businessuser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BusinessDetailsController extends Controller
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

//        dd($businessdetail->id);
//        $name=$request->keywords;
//        $businessdetails= BusinessDetail::where('shop_name','like',"%$name%")->paginate(3);
//        return view('businessdetails.index',compact('businessdetail'));
    }
    public function create()
    {
        if(!Auth::user()->can('businessd.create')){
            return 'sorry,you can\'t visited this web';
        }
        $categories=BusinessCategory::all()->pluck('name','id');
        return view('businessdetails.create',compact('categories'));
    }

    public function store(Request $request)
    {

    }

    public function show(BusinessDetail $businessd)
    {
        if(!Auth::user()->can('businessd.show')){
            return 'sorry,you can\'t visited this web';
        }
//        dd(BusinessDetail::all());
//        dd($businessd);
        return view('businessdetails.show',compact('businessd'));
    }

    public function edit(BusinessDetail $businessd)
    {
        if(!Auth::user()->can(' businessd.edit')){
            return 'sorry,you can\'t visited this web';
        }

        return view('businessdetails.edit',compact('businessd'));
    }

    public function update(Request $request,BusinessDetail $businessd)
    {
        if(!Auth::user()->can(' businessd.edit')){
            return 'sorry,you can\'t visited this web';
        }
        $this->validate($request,[
            'start_send'=>'required|numeric',
            'send_cost'=>'required|numeric',
            'estimate_time'=>'required|numeric',
        ],[
            'start_send.required'=>'起送金额必填!',
            'start_send.numeric'=>'起送金额必须为数字!',
            'send_cost.numeric'=>'配送费用必须是数字!',
            'send_cost.required'=>'配送费用必填!',
            'estimate_time.required'=>'最迟配送时间必填!',
            'estimate_time.numeric'=>'最迟配送时间必需是数字!',
        ]);
        $cover=$businessd->shop_img;
        if ($request->shop_img!=null){
            $cover=$request->shop_img;
        }

        $businessd->update([
            'shop_img'=>$cover,
            'brand'=>$request->brand??0,
            'bao'=>$request->bao??0,
            'on_time'=>$request->on_time??0,
            'fengniao'=>$request->fengniao??0,
            'piao'=>$request->piao??0,
            'zhun'=>$request->zhun??0,
            'start_send'=>$request->start_send,
            'send_cost'=>$request->send_cost,
            'estimate_time'=>$request->estimate_time,
            'notice'=>$request->notice??'',
            'discount'=>$request->discount??'',
        ]);
        session()->flash('success','修改成功');
        return redirect()->route('businessd.show',$businessd->id);
    }
}
