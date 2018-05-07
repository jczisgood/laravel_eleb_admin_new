@extends('layout.default')
@section('title','活动详情')
@section('content')
    <h1>{{$eventprize->name}}</h1>
    属于<strong style="color: red">{{$eventprize->even->title}}</strong>活动<br>
    <h4>活动详情</h4>
    <div>{!!$eventprize->description!!}</div>
@stop