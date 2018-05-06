@extends('layout.default')
@section('title','分类列表')
@section('content')
    <form class="form-inline" action="{{route('businessusers.index')}}" method="get">
        <div class="form-group">
            <a href="{{route('businessusers.create')}}" class="btn btn-danger">添加</a>
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
            <th>邮箱</th>
            <th>用户名</th>
            <th>分类</th>
            <th>审核</th>
            <th>操作</th>
        </tr>
        @foreach($businessusers as $businessuser)
            <tr data-id="{{$businessuser->id}}" id="article">
                <td>{{$businessuser->id}}</td>
                <td>{{$businessuser->email}}</td>
                <td>{{$businessuser->name}}</td>
                <td>{{$businessuser->category->name}}</td>
                <td>{{$businessuser->status==0?'未通过':'通过'}}</td>
                <td>
                    @if(\Illuminate\Support\Facades\Auth::user()->can('businessusers.edit'))
                    <a href="{{route('businessusers.edit',$businessuser->id)}}" class="btn btn-danger">编辑</a>
                    @endif
                    @if(\Illuminate\Support\Facades\Auth::user()->can('status.check'))
                    <a href="{{route('status.check',$businessuser->id)}}" class="btn btn-danger">{{$businessuser->status==0?'同意':'拒绝'}}</a>
                    @endif
                        @if(\Illuminate\Support\Facades\Auth::user()->can('businessusers.destroy'))
                            <a href="" class="btn btn-default">删除</a>
                        @endif
                    {{--@endif--}}
                </td>
            </tr>
        @endforeach
    </table>
    {{$businessusers->appends($name)->links()}}
@stop
@section('js')
    <script>
        $('#mytable .btn-default').click(function () {
            var tr=$(this).closest('tr');
            var id=tr.data('id');
            $.ajax({
                url:'businessusers/'+id,
                data:'_token={{csrf_token()}}',
                type:'DELETE',
                success:function (msg) {
                    tr.remove();
                }
            })
        })
        //
    </script>
@stop