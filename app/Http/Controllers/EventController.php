<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
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
}
