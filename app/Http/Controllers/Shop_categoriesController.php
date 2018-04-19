<?php

namespace App\Http\Controllers;

use App\shop_category;
use App\shop_user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Shop_categoriesController extends Controller
{
    //
    public function index(Request $request)
    {
        $name=$request->keywords;
        $shop_categoriess= shop_category::where('name','like',"%$name%")->paginate(3);
        return view('category.index',compact('shop_categoriess','name'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:2',
            'cover' => 'image',
        ], [
            'name,required' => '分类名称不能为空',
            'name,min' => '分类名称不能少于两位',
            'cover.image' => '请选择其他头像',
        ]);
        $cover = '';
//        dd($request->file('cover'));die;
        if ($request->file('cover') != null) {
//            die;
           $res= $request->file('cover')->store('public/storage');
       $cover=Storage::url($res);
        }
        shop_category::create([
            'name'=>$request->name,
            'cover'=>$cover,
            ]);
        session()->flash('success','添加分类成功');
        return redirect()->route('shop_categories.index');
    }

    public function edit(shop_category $shop_category)
    {
        $shop_categories=$shop_category;
        return view('category.edit',compact('shop_categories'));
    }

    public function update(Request $request,shop_category $shop_category)
    {
        $this->validate($request, [
            'name' => 'required|min:2',
            'cover' => 'image',
        ], [
            'name,required' => '分类名称不能为空',
            'name,min' => '分类名称不能少于两位',
            'cover.image' => '请选择其他头像',
        ]);
        $cover = $shop_category->cover;
//        dd($request->file('cover'));die;
        if ($request->file('cover') != null) {
//            die;
            $res= $request->file('cover')->store('public/storage');
            $cover=Storage::url($res);
        }
        $shop_category->update([
            'name'=>$request->name,
            'cover'=>$cover,
        ]);
        session()->flash('success','修改成功');
        return redirect()->route('shop_categories.index');
    }

    public function destroy(shop_category $shop_category)
    {
        $shop_category->delete();
    }
}
