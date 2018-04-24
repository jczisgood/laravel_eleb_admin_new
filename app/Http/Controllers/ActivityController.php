<?php

namespace App\Http\Controllers;

use App\Activity;
use function GuzzleHttp\Psr7\str;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    //
    public function index(Request $request)
    {
        $name=$request->keywords;
        $activities=Activity::where('title','like',"%$name%")->paginate(2);
//        dd($activities[0]);
        return view('activity.index',compact('name','activities'));
    }
    public function create()
    {
        return view('activity.create');
    }

    public function store(Request $request)
    {
//        dd($request->contents);
        $this->validate($request,[
            'title'=>'required',
            'contents'=>'required|min:10|max:50',
            'start_time'=>'required',
            'end_time'=>'required',
            'captcha'=>'required|captcha'
        ],[
            'title.required'=>'活动标题必填',
            'contents.required'=>'活动内容必填',
            'contents.min'=>'活动内容不能少于十位',
            'contents.max'=>'活动内容不能大于50位',
            'start_time.required'=>'开始时间必填',
            'end_time.required'=>'结束时间必填',
            'captcha.required'=>'请填写验证码',
            'captcha.captcha'=>'验证码错误',
        ]);
        Activity::create([
            'title'=>$request->title,
            'contents'=>$request->contents,
            'start_time'=>strtotime($request->start_time),
            'end_time'=>strtotime($request->end_time),
        ]);
        return redirect()->route('activity.index')->with('success','添加成功');
    }

    public function show(Activity $activity)
    {
        return view('activity.show',compact('activity'));
    }

    public function edit(Activity $activity)
    {
        return view('activity.edit',compact('activity'));
    }

    public function update(Request $request,Activity $activity)
    {
        $this->validate($request,[
            'title'=>'required',
            'contents'=>'required|min:10|max:50',
            'start_time'=>'required',
            'end_time'=>'required',
        ],[
            'title.required'=>'活动标题必填',
            'contents.required'=>'活动内容必填',
            'contents.min'=>'活动内容不能少于十位',
            'contents.max'=>'活动内容不能大于50位',
            'start_time.required'=>'开始时间必填',
            'end_time.required'=>'结束时间必填',
        ]);
        $activity->update([
            'title'=>$request->title,
            'contents'=>$request->contents,
            'start_time'=>strtotime($request->start_time),
            'end_time'=>strtotime($request->end_time),
        ]);
        return redirect()->route('activity.index')->with('success','修改成功');
    }

    public function destroy(Activity $activity)
    {
//        echo '112';
        $activity->delete();
//        echo 'ok';
    }
}
