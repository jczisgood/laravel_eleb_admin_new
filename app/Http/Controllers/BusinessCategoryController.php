<?php

namespace App\Http\Controllers;

use App\BusinessCategory;
//use App\Businessuser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BusinessCategoryController extends Controller
{
    //
    public function index(Request $request)
    {
        $name=$request->keywords;
        $BusinessCategorys= BusinessCategory::where('name','like',"%$name%")->paginate(3);
        return view('category.index',compact('BusinessCategorys','name'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:2',
        ], [
            'name,required' => '分类名称不能为空',
            'name,min' => '分类名称不能少于两位',
        ]);
        $cover = '';
//        dd($request->file('cover'));die;
        if ($request->cover!= null) {
//            die;
//            $res= $request->file('cover')->store('public/storage');
//            $cover=Storage::url($res);
            $cover=$request->cover;
        }
        $businesscategory=new BusinessCategory();


        $businesscategory->name=$request->name;
            $businesscategory->cover=$cover;
        $businesscategory->save();
        session()->flash('success','添加分类成功');
        return redirect()->route('businesscategory.index');
    }

    public function edit(BusinessCategory $businesscategory)
    {
//        die;
//        dd($businesscategory->id);
//        $shop_categories=$businessCategory;
        return view('category.edit',compact('businesscategory'));
    }

    public function update(Request $request,BusinessCategory $businesscategory)
    {
//        echo 1;die;
        $this->validate($request, [
            'name' => 'required|min:2',
//            'cover' => 'image',
        ], [
            'name,required' => '分类名称不能为空',
            'name,min' => '分类名称不能少于两位',
//            'cover.image' => '请选择其他头像',
        ]);
        $cover = $businesscategory->cover;
//        dd($request->cover);die;
        if ($request->cover != null) {
//            die;
            $cover= $request->cover;
        }
        $businesscategory->update([
            'name'=>$request->name,
            'cover'=>$cover,
        ]);
        session()->flash('success','修改成功');
        return redirect()->route('businesscategory.index');
    }

    public function destroy(BusinessCategory $businesscategory)
    {
        $businesscategory->delete();
    }
}

