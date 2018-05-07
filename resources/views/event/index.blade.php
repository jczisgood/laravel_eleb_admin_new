@extends('layout.default')
@section('title','活动列表')
@section('content')
    <form class="form-inline" action="{{route('event.index')}}" method="get">
        <div class="form-group">
            <a href="{{route('event.create')}}" class="btn btn-danger">添加</a>
            <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
            <div class="input-group">
                <div class="input-group-addon"><span class="glyphicon glyphicon-search"></span></div>
                <input type="text" class="form-control" id="exampleInputAmount" name="keywords">
            </div>
        </div>
        <button type="submit" class="btn btn-success">搜索</button>
    </form>
    <table class="table table-bordered table-responsive" id="mytable">
        <tr>
            <th>ID</th>
            <th>标题</th>
            <th>开始时间</th>
            <th>结束时间</th>
            <th>开奖日期</th>
            <th>报名人数限制</th>
            <th>是否开奖</th>
            <th>操作</th>
        </tr>
        @foreach($events as $event)
            <tr data-id="{{$event->id}}">
                <td>{{$event->id}}</td>
                <td>{{$event->title}}</td>
                <td>{{$event->signup_start}}</td>
                <td>{{$event->signup_end}}</td>
                <td>{{$event->prize_date}}</td>
                <td>{{$event->signup_num}}</td>
                <td>{{$event->is_prize==0?'未开奖':'已开奖'}}</td>
                <td>
                    <a href="{{route('event.show',$event->id)}}" class="btn btn-info">查看</a>
                    <a href="{{route('event.edit',$event->id)}}" class="btn btn-danger">修改</a>
                    <a href="{{route('event.take',$event->id)}}" class="btn btn-success">抽奖</a>
                    <a href="{{route('event.showgoods',$event->id)}}" class="btn btn-info">查看奖品</a>
                    <a href="{{route('event.see',$event->id)}}" class="btn btn-info">查看中奖名单</a>
                    <button class="btn btn-primary">删除</button>
                </td>
            </tr>
        @endforeach
    </table>
    {{$events->appends($title)->links()}}
@stop
@section('js')
    <script>
        $('#mytable .btn-primary').click(function () {
            var tr=$(this).closest('tr')
            var id=tr.data('id')
//            console.log(id)
            $.ajax({
                url:'event/'+id,
                data:'_token={{csrf_token()}}',
                type:'DELETE',
                success:function (msg) {
//                    console.log(msg)
                    tr.remove();
                }
            })
        })
    </script>
@stop