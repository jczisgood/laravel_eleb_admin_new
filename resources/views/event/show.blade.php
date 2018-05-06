@extends('layout.default')
@section('title','活动详情')
    @section('content')
    <h1>{{$event->title}}</h1>
     <p>活动状态:{{$event->is_prize==1?'已开奖':'未开奖'}}</p>
        <p>活动时间:{{$event->signup_start}}-------{{$event->signup_end}}</p>
    <div style="color: red">开奖时间{{$event->signup_end}}</div>
        人数限制<strong style="color: red">{{$event->signup_num}}</strong><br>
        <h3>活动详情</h3>
        <div>{!!$event->content!!}</div>
    @stop