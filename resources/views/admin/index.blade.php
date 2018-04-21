@extends('layout.default')
@section('title','管理员列表')
@section('content')
    <form class="form-inline" action="{{route('admin.index')}}" method="get">
        <div class="form-group">
            <a href="{{route('admin.create')}}" class="btn btn-danger">添加</a>
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
            <th>用户名</th>
            <th>邮箱</th>
            <th>操作</th>
        </tr>
        @foreach($admins as $admin)
            <tr data-id="{{$admin->id}}" id="article">
                <td>{{$admin->id}}</td>
                <td>{{$admin->username}}</td>
                <td>{{$admin->email}}</td>
                <td>
                        <a href="{{route('admin.edit',$admin->id)}}" class="btn btn-danger">编辑</a>
                        <a href="" class="btn btn-default">删除</a>
                    {{--@endif--}}
                </td>
            </tr>
        @endforeach
        <tr>
            <td colspan="4">
                <a href="{{route('businesscategory.create')}}">添加</a>
            </td>
        </tr>
    </table>
    {{$admins->appends($name)->links()}}
@stop
@section('js')
    <script>

        $('#mytable .btn-default').click(function () {
//            confirm('nihao');
            var tr=$(this).closest('tr');
            var id=tr.data('id');
//            confirm(id);
            $.ajax({
                url:'businesscategory/'+id,
                data:'_token={{csrf_token()}}',
                type:'DELETE',
                session:function (msg) {
                    tr.remove();
                }
            })
            return false;
        })
        //
    </script>
@stop