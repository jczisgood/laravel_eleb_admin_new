<?php

namespace App\Http\Controllers;

use App\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth',[
        ]);
    }
    protected function getChildren($list,$parent_id=0,$deep=0){
        static $children = [];
        foreach ($list as $child){
            if ($child['parent_id'] == $parent_id){
                $child->deep = $deep;
                $child->title = str_repeat('---',$deep).$child->title;
                $children[] = $child;
                $this->getChildren($list,$child->id,$deep+1);
            }
        }
        return $children;
    }
    //首页
    public function index()
    {
        $menus= Menu::all();
        $menus=self::getChildren($menus);
        return view('menu.index',compact('menus'));
    }

    public function create()
    {
        //查询所有菜单
        $menus=Menu::where('parent_id','0')->get();

        return view('menu.create',compact('menus'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
           'title'=>'required|min:2|max:10',
           'parent_id'=>'required',
        ],[
            'title.required'=>'标题必填',
            'title.min'=>'标题最小为两位',
            'title.max'=>'标题最大为十位',
            'parent_id'=>'上级标题必选',
            'url'=>'路径标题必填',
        ]);
        Menu::create([
            'title'=>$request->title,
            'parent_id'=>$request->parent_id,
            'url'=>$request->url??'',
            'sort'=>$request->sort??1,
        ]);
        return redirect()->route('menu.index')->with('success','添加成功');
    }

    public function edit(Menu $menu)
    {
        $menus=Menu::where('parent_id','0')->get();
        return view('menu.edit',compact('menu','menus'));
    }

    public function update(Request $request,Menu $menu)
    {
//        dd(1);
        $this->validate($request,[
            'title'=>'required|min:2|max:10',
            'parent_id'=>'required',
        ],[
            'title.required'=>'标题必填',
            'title.min'=>'标题最小为两位',
            'title.max'=>'标题最大为十位',
            'parent_id'=>'上级标题必选',
            'url'=>'路径标题必填',
        ]);
        //修改
        $menu->update([
            'title'=>$request->title,
            'parent_id'=>$request->parent_id,
            'url'=>$request->url??'',
            'sort'=>$request->sort??1,
        ]);
        return redirect()->route('menu.index')->with('success','修改成功');
    }

    public function destroy(Menu $menu)
    {
        //删除
        $menu->delete();
    }
}
