@extends('layout.default')
@section('title','角色列表')
@section('content')
    <form class="form-inline" action="{{route('role.index')}}" method="get">
        <div class="form-group">
            <a href="{{route('role.create')}}" class="btn btn-danger">添加</a>
            <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
            <div class="input-group">
                <div class="input-group-addon"><span class="glyphicon glyphicon-search"></span></div>
                <input type="text" class="form-control" id="exampleInputAmount" name="keywords">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">搜索</button>
    </form>
    <table class="table table-hover" id="mytable">
        <tr>
            <th>ID</th>
            <th>名称</th>
            <th>展示名称</th>
            <th>描述</th>
            <th>操作</th>
        </tr>
        @foreach($roles as $role)
            <tr data-id="{{$role->id}}" id="article">
                <td>{{$role->id}}</td>
                <td>{{$role->name}}</td>
                <td>{{$role->display_name}}</td>
                <td>{{$role->description}}</td>
                <td>
                        <a href="{{route('role.edit',$role->id)}}" class="btn btn-danger">编辑</a>
                        <a href="" class="btn btn-default">删除</a>
                    {{--@endif--}}
                </td>
            </tr>
        @endforeach
        <tr>
            <td colspan="4">
                <a href="{{route('role.create')}}">添加</a>
            </td>
        </tr>
    </table>
    {{$roles->appends($name)->links()}}
@stop
@section('js')
    <script>

        $('#mytable .btn-default').click(function () {
//            confirm('nihao');
            var tr=$(this).closest('tr');
            var id=tr.data('id');
//            confirm(id);
            $.ajax({
                url:'role/'+id,
                data:'_token={{csrf_token()}}',
                type:'DELETE',
                session:function (msg) {
                    tr.remove();
                }
            })

        })
        //
    </script>
@stop