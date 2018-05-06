@extends('layout.default')
@section('title','权限列表')
@section('content')
    <form class="form-inline" action="{{route('permission.index')}}" method="get">
        <div class="form-group">
            <a href="{{route('permission.create')}}" class="btn btn-danger">添加</a>
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
            <th>分类名</th>
            <th>展示名称</th>
            <th>描述</th>
            <th>操作</th>
        </tr>
        @foreach($permissions as $permission)
            <tr data-id="{{$permission->id}}" id="article">
                <td>{{$permission->id}}</td>
                <td>{{$permission->name}}</td>
                <td>{{$permission->display_name}}</td>
                <td>{{$permission->description}}</td>
                <td>
                        <a href="{{route('permission.edit',$permission->id)}}" class="btn btn-danger">编辑</a>
                        <a href="" class="btn btn-default">删除</a>
                    {{--@endif--}}
                </td>
            </tr>
        @endforeach
    </table>
    {{$permissions->appends($name)->links()}}
@stop
@section('js')
    <script>

        $('#mytable .btn-default').click(function () {
//            confirm('nihao');
            var tr=$(this).closest('tr');
            var id=tr.data('id');
//            confirm(id);
            $.ajax({
                url:'permission/'+id,
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