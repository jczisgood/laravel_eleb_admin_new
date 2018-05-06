<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FoodCountController extends Controller
{
    //统计
    public function index()
    {
        $count1 = DB::table('orders')->where('order_status','<>','2')->count();
//        echo $count1;
        $start = date('Y-m-01');
        $end = date('Y-m-t 23:59:59');
        $count2 = DB::table('orders')->where([
            ['order_status','<>','2'],
            ['created_at','>=',$start],
            ['created_at','<=',$end],
            //['shop_id',$shop_id] //根据商家ID进行统计
        ])->count();
        $start = date('Y-m-d');
        $end = date('Y-m-d 23:59:59');
        $count3 = DB::table('orders')->where([
            ['order_status','<>','2'],
            ['created_at','>=',$start],
            ['created_at','<=',$end]
        ])->count();
        $rows = DB::table('order_goods')
            ->join('orders','order_goods.order_id','=','orders.id')
            ->join('business_details','orders.shop_id','=','business_details.id')
            ->select('business_details.shop_name','orders.shop_id','order_goods.goods_name','order_goods.goods_id',DB::raw('sum(order_goods.amount) as amounts'))
            ->groupBy('business_details.shop_name','orders.shop_id','order_goods.goods_id','order_goods.goods_name')
            ->orderBy('amounts','desc')
            //根据订单时间和商家id统计
            /*->where([
                ['orders.created_at','>=',$start],
                ['orders.created_at','<=',$end],
                ['orders.shop_id',$shop_id]
            ])*/
            ->get();
//        foreach ($rows as $row){
//            echo '<br>'.$row->shop_name.':'.$row->goods_name.':'.$row->amounts;
//        }
        $arr=[];
        array_push($arr,$count1);
        array_push($arr,$count2);
        array_push($arr,$count3);
//        dd($arr);
        return view('foodcount.index',compact('arr','rows'));
    }
}
