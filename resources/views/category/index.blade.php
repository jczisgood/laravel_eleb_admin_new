@extends('layout.default')
@section('title','分类列表')
@section('content')
    <form class="form-inline" action="{{route('businesscategory.index')}}" method="get">
        <div class="form-group">
            <a href="{{route('businesscategory.create')}}" class="btn btn-danger">添加</a>
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
        @foreach($BusinessCategorys as $BusinessCategory)
            <tr data-id="{{$BusinessCategory->id}}" id="article">
                <td>{{$BusinessCategory->id}}</td>
                <td>{{$BusinessCategory->name}}</td>
                <td><img src="{{$BusinessCategory->cover}}" alt="" class="img-rounded"></td>
                <td>
                        <a href="{{route('businesscategory.edit',$BusinessCategory->id)}}" class="btn btn-danger">编辑</a>
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
    {{$BusinessCategorys->appends($name)->links()}}
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

        })
        //
    </script>
@stop