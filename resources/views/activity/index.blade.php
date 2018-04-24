@extends('layout.default')
@section('title','活动列表')
    @section('content')
        <form class="form-inline" action="{{route('activity.index')}}" method="get">
            <div class="form-group">
                <a href="{{route('activity.create')}}" class="btn btn-danger">添加</a>
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
            <th>操作</th>
        </tr>
        @foreach($activities as $activity)
        <tr data-id="{{$activity->id}}">
            <td>{{$activity->id}}</td>
            <td>{{$activity->title}}</td>
            <td>{{date('Y-m-d',$activity->start_time)}}</td>
            <td>{{date('Y-m-d',$activity->end_time)}}</td>
            <td>
                <a href="{{route('activity.show',$activity->id)}}" class="btn btn-info">查看</a>
                <a href="{{route('activity.edit',$activity->id)}}" class="btn btn-danger">修改</a>
                <button class="btn btn-primary">删除</button>
            </td>
        </tr>
            @endforeach
    </table>
        {{$activities->appends($name)->links()}}
    @stop
@section('js')
    <script>
        $('#mytable .btn-primary').click(function () {
            var tr=$(this).closest('tr')
            var id=tr.data('id')
//            console.log(id)
            $.ajax({
                url:'activity/'+id,
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