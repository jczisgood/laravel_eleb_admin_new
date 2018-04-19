@extends('layout.default')
@section('title','分类列表')
@section('content')
    <form class="form-inline" action="{{route('shop_categories.index')}}" method="get">
        <div class="form-group">
            <a href="{{route('shop_categories.create')}}" class="btn btn-danger">添加</a>
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
            <th>图片</th>
            <th>操作</th>
        </tr>
        @foreach($shop_categoriess as $shop_categories)
            <tr data-id="{{$shop_categories->id}}" id="article">
                <td>{{$shop_categories->id}}</td>
                <td>{{$shop_categories->name}}</td>
                <td><img src="{{$shop_categories->cover}}" alt="" class="img-rounded" width="40px" height="40px"></td>
                <td>
                        <a href="{{route('shop_categories.edit',['shop_categories'=>$shop_categories])}}" class="btn btn-danger">编辑</a>
                        <a href="" class="btn btn-primary">删除</a>
                    {{--@endif--}}
                </td>
            </tr>
        @endforeach
        <tr>
            <td colspan="4">
                <a href="{{route('shop_categories.create')}}">添加</a>
            </td>
        </tr>
    </table>
    {{$shop_categoriess->appends($name)->links()}}
@stop
@section('js')
    <script>
        $('#mytable .btn-primary').click(function () {
            var tr=$(this).closest('tr');
            var id=tr.data('id');
            $.ajax({
                url:'shop_categories/'+id,
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