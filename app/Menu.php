<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Menu extends Model
{
    //
protected $guarded=[];

   static public function nav()
    {
        $html='';
        $menus=self::where('parent_id',0)->get();
    foreach ($menus as $menu){
        $html.= '<li class="dropdown">
    <a href="" class="" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'.$menu->title.'<span class="caret"></span>';
        $html.=      '   <ul class="dropdown-menu">';
        $chirdren_html='';
                            $chirdren=self::where('parent_id',$menu->id)->get();
                            foreach ($chirdren as $chird) {
                                if(Auth::user()){
                                    if (Auth::user()->can($chird->url)) {
                                        $chirdren_html.= '<li><a href="' . route($chird->url) . '">' . $chird->title . '</a></li>';
                                    }
                                }
                            }
                            $html.=$chirdren_html;
                    $html.= '</ul>';
                            if ($chirdren_html==''){
                                $html='';
                            }


}
        return $html;
    }
    public static function greate_nav()
    {
        $html = '';
        $navs = [];
        //getmenus 方法 得到所有 的 一级菜单
        $menus = self::getMenus();
        foreach($menus as $menu){

            $items = [];
            foreach ($menu->children as $child){
                $items[] = $child;
            }
            if ($items){
                $navs[] = [
                    'name'=>$menu->name,
                    'items'=>$items
                ];
            }
        }
        foreach ($navs as $nav){
            $html .= '<li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'.$nav['name'].' <span class="caret"></span></a>
                    <ul class="dropdown-menu">';
            foreach ($nav['items'] as $item){
                $html .= '<li><a href="'.$item->route.'">'.$item->name.'</a></li>';
            }
            $html .= '</ul></li>';
        }
        return $html;
    }

}
