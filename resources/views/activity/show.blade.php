@extends('layout.default')
@section('title','活动详情')
    @section('content')
    <h1>{{$activity->title}}</h1>
    <div>结束时间{{date('Y-m-d',$activity->end_time)}}</div>
    {!! $activity->contents !!}
    @stop