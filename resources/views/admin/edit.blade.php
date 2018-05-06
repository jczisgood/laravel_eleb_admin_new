@extends('layout.default')
@section('title','管理员修改')
@section('content')
    <form action="{{route('admin.update',$admin->id)}}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputEmail1">用户名</label>
            <input type="text" class="form-control" name="username" value="{{$admin->username}}">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">邮箱</label>
            <input type="email" class="form-control" name="email" value="{{$admin->email}}">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">权限</label>
            @foreach($roles as $row)
                <label><input type="checkbox" name="role_id[]" value="{{$row->id}}"  {{$admin->hasRole($row->name)?'checked':''}} class="form-control-static">{{$row->display_name}}&emsp;</label>
            @endforeach
        </div>
        {{method_field('PUT')}}
        {{csrf_field()}}
        <button type="submit" class="btn btn-default">提交</button>
    </form>
@stop