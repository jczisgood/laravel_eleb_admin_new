@extends('layout.default')
@section('title','管理员添加')
@section('content')
    <form action="{{route('admin.store')}}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputEmail1">用户名</label>
            <input type="text" class="form-control" name="username" value="{{old('name')}}">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">密码</label>
            <input type="password" class="form-control" name="password">
        </div>    <div class="form-group">
            <label for="exampleInputPassword1">邮箱</label>
            <input type="email" class="form-control" name="email">
        </div>
        {{csrf_field()}}
        <button type="submit" class="btn btn-default">提交</button>
    </form>
@stop