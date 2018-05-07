@extends('layout.default')
@section('title','活动列表')
@section('content')
    <form class="form-inline" action="{{route('eventprize.index')}}" method="get">
        <div class="form-group">
            <a href="{{route('eventprize.create')}}" class="btn btn-danger">添加</a>
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
            <th>属于哪个活动</th>
            <th>活动奖品</th>
            <th>操作</th>
        </tr>
        @foreach($eventprizes as $eventprize)
            <tr data-id="{{$eventprize->id}}">
                <td>{{$eventprize->id}}</td>
                <td>{{$eventprize->even->title}}</td>
                <td>{{$eventprize->name}}</td>
                <td>
                    <a href="{{route('eventprize.show',$eventprize->id)}}" class="btn btn-info">查看</a>
                    <a href="{{route('eventprize.edit',$eventprize->id)}}" class="btn btn-danger">修改</a>
                    <button class="btn btn-primary">删除</button>
                </td>
            </tr>
        @endforeach
    </table>
    {{$eventprizes->appends($name)->links()}}
@stop
@section('js')
    <script>
        $('#mytable .btn-primary').click(function () {
            var tr=$(this).closest('tr')
            var id=tr.data('id')
//            console.log(id)
            $.ajax({
                url:'eventprize/'+id,
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