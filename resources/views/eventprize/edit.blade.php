@extends('layout.default')
@section('title','奖品添加')
@section('content')
    <form action="{{route('eventprize.store')}}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputEmail1">名称</label>
        <input type="text" class="form-control" name="name" value="{{$eventprize->name}}">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">活动名称</label>
            <select name="events_id" class="form-control">
                @foreach($events as $event)
                <option value="{{$event->id}}" {{$eventprize->events_id==$event->id?'selected':''}}>{{$event->title}}</option>
                    @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">奖品详情</label>
            <textarea name="description" class="form-control" cols="30" rows="10">{{$eventprize->description}}</textarea>
        </div>
        {{csrf_field()}}
        <button type="submit" class="btn btn-default">修改</button>
    </form>
@stop