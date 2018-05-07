<?php

namespace App\Http\Controllers;

use App\Event;
use App\EventPrize;
use Illuminate\Http\Request;

class EventPrizeController extends Controller
{
    //
    public function index(Request $request)
    {
        $name=$request->keywords;
        $eventprizes=EventPrize::where('name','like',"%$name%")->paginate(3);
        return view('eventprize.index',compact('name','eventprizes'));
    }

    public function create()
    {
        $events=Event::all();
    return view('eventprize.create',compact('events'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
           'name'=>'required',
           'events_id'=>'required',
           'description'=>'required',
        ],[
            'name.required'=>'名称必填',
            'events_id.required'=>'奖品属于哪个活动必填',
            'description.required'=>'奖品描述必填',
        ]);
        EventPrize::create([
            'name'=>$request->name,
            'events_id'=>$request->events_id,
            'description'=>$request->description,
        ]);
        return redirect()->route('event.index')->with('success','添加成功');
    }

    public function edit(EventPrize $eventprize)
    {
        $events=Event::all();
        return view('eventprize.edit',compact('eventprize','events'));
    }

    public function show(EventPrize $eventprize)
    {
            return view('eventprize.show',compact('eventprize'));
    }
    public function destroy(EventPrize $eventprize)
    {
        $eventprize->delete();
    }
}
