@extends('layout.default')
@section('title','活动中奖名单')
@section('content')
    <table class="table table-bordered table-responsive" id="mytable">
        <tr>
            <th>ID</th>
            <th>中奖人</th>
            <th>中奖奖品奖品</th>
        </tr>
        @foreach($eventprizes as $eventprize)
            <tr data-id="{{$eventprize->id}}">
                <td>{{$eventprize->id}}</td>
                <td>{{$eventprize->member->name}}</td>
                <td>{{$eventprize->name}}</td>
            </tr>
        @endforeach
    </table>
@stop