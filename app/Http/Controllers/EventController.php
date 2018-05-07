<?php

namespace App\Http\Controllers;

use App\Event;
use App\EventMember;
use App\EventPrize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
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
        $title=$request->keywords;
        $events=Event::where('title','like',"%$title%")->paginate(3);
    return view('event.index',compact('events','title'));
    }

    public function create()
    {
        return view('event.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'contents'=>'required',
            'signup_start'=>'required',
            'signup_end'=>'required',
            'prize_date'=>'required',
            'signup_num'=>'required|numeric',
        ],[
            'title.required'=>'标题必填',
            'contents.required'=>'内容必填',
            'signup_start.required'=>'开始时间必填',
            'signup_end.required'=>'结束时间必填',
            'prize_date.required'=>'开奖时间必填',
            'signup_num.required'=>'参与人数必填',
            'signup_num.numeric'=>'参与人数必须是数字',
        ]);
        Event::create([
            'title'=>$request->title,
            'content'=>$request->contents,
            'signup_start'=>$request->signup_start,
            'signup_end'=>$request->signup_end,
            'prize_date'=>$request->prize_date,
            'signup_num'=>$request->signup_num,
        ]);
        return redirect()->route('event.index')->with('success','添加成功');
    }

    public function show(Event $event)
    {
        return view('event.show',compact('event'));
    }

    public function edit(Event $event)
    {
        return view('event.edit',compact('event'));
    }

    public function update(Request $request,Event $event)
    {
        $this->validate($request,[
            'title'=>'required',
            'contents'=>'required',
            'signup_start'=>'required',
            'signup_end'=>'required',
            'prize_date'=>'required',
            'signup_num'=>'required|numeric',
        ],[
            'title.required'=>'标题必填',
            'contents.required'=>'内容必填',
            'signup_start.required'=>'开始时间必填',
            'signup_end.required'=>'结束时间必填',
            'prize_date.required'=>'开奖时间必填',
            'signup_num.required'=>'参与人数必填',
            'signup_num.numeric'=>'参与人数必须是数字',
        ]);

        $event->update([
            'title'=>$request->title,
            'content'=>$request->contents,
            'signup_start'=>$request->signup_start,
            'signup_end'=>$request->signup_end,
            'prize_date'=>$request->prize_date,
            'signup_num'=>$request->signup_num,
        ]);
        return redirect()->route('event.index')->with('success','修改成功');
    }

    public function destroy(Event $event)
    {
        $event->delete();
    }

    public function showgoods(Request $request,Event $event)
    {
         //得到当前活动的所有奖品
        $name=$request->keywords;
            $eventprizes=EventPrize::where('events_id',$event->id)->where('name','like',"%$name%")->paginate(3);
            return view('event.goods',compact('eventprizes','name'));
    }

    public function take(Event $event)
    {
//        //参与人
//           $join_man= EventMember::where('events_id',$event->id)->get();
//        //得到所有奖品
//        $goods=EventPrize::where('events_id',$event->id)->get();
//        //打乱
//        $goods=$goods->shuffle();
//        $join_man=$join_man->shuffle();
//
//        foreach($goods as $good){
//            $good=$join_man->pop();
//        }
        //判断
            if ($event->prize_date<date('Y-m-d')){
                return redirect()->route('event.index')->with('success','抽奖失败,因为还没有到开奖时间');
            }
        //获取所有报名人员
        $member_ids = DB::table('event_members')
            ->where('events_id',$event->id)
            ->pluck('member_id');
        if ($member_ids->count()==0){
            return redirect()->route('event.index')->with('success','抽奖失败,因为还没有人参与');
        }
        //获取所有活动奖品
        $prize_ids = DB::table('event_prizes')
            ->where('events_id',$event->id)
            ->pluck('id');

        if ($prize_ids->count()==0){
            return redirect()->route('event.index')->with('success','抽奖失败,因为你还没有奖品');
        }
//        dd($prize_ids);
        //打乱报名人员的顺序
        $members = $member_ids->shuffle();
        //打乱奖品顺序
        $prizes = $prize_ids->shuffle();
        //配对
        $result = [];
        foreach ($members as $member_id){
            $prize_id = $prizes->pop();
            //奖品抽完,结束抽奖
            if($prize_id == null) break;
            $result[$prize_id]=$member_id;
        }
        DB::transaction(function () use ($result,$event) {
            //写回数据表
            foreach ($result as $pid=>$mid){
                DB::table('event_prizes')
                    ->where('id', $pid)
                    ->update(['member_id' => $mid]);
            }
            //修改活动的状态
            $event->is_prize=1;
            $event->save();
        });
        return redirect()->route('event.index')->with('success','抽奖成功');
    }

    public function see(Event $event)
    {
        $eventprizes=EventPrize::where('events_id',$event->id)->where('member_id','<>',0)->get();
        return view('event.see',compact('eventprizes'));
    }
}
