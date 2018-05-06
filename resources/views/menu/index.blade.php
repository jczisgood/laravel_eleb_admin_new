@extends('layout.default')
@section('title','菜单列表')
@section('content')
            <a href="{{route('menu.create')}}" class="btn btn-danger">添加</a>
    <table class="table table-hover" id="mytable">
        <tr>
            <th>ID</th>
            <th>标题</th>
            <th>路径</th>
            <th>排序</th>
            <th>操作</th>
        </tr>
        @foreach($menus as $menu)
            <tr data-id="{{$menu->id}}" id="article">
                <td>{{$menu->id}}</td>
                <td>{{$menu->title}}</td>
                <td>{{$menu->url}}</td>
                <td>{{$menu->sort}}</td>
                <td>
                        <a href="{{route('menu.edit',$menu->id)}}" class="btn btn-danger">编辑</a>
                        <button class="btn btn-default">删除</button>
                    {{--@endif--}}
                </td>
            </tr>
        @endforeach
    </table>
@stop
@section('js')
    <script>

        $('#mytable .btn-default').click(function () {
            var tr=$(this).closest('tr');
            var id=tr.data('id');
            $.ajax({
                url:'menu/'+id,
                data:'_token={{csrf_token()}}',
                type:'DELETE',
                success:function (msg) {
                    tr.remove()
                }
            })
        })
        //
    </script>
@stop