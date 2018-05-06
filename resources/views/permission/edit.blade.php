@extends('layout.default')
@section('title','权限修改')
@section('content')
    <form action="{{route('permission.update',$permission->id)}}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputEmail1">权限名称</label>
            <input type="text" class="form-control" name="name" value="{{$permission->name}}">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">展示名称</label>
            <input type="text" class="form-control" name="display_name" value="{{$permission->display_name}}">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">权限描述</label>
            <input type="text" class="form-control" name="description" value="{{$permission->description}}">
        </div>
        {{csrf_field()}}
        {{method_field('PUT')}}
        <button type="submit" class="btn btn-default">提交</button>
    </form>
@stop