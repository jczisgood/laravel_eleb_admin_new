@extends('layout.default')
@section('title','权限添加')
@section('content')
    <form action="{{route('permission.store')}}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputEmail1">权限名称</label>
            <input type="text" class="form-control" name="name" value="{{old('name')}}">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">展示名称</label>
            <input type="text" class="form-control" name="display_name" value="{{old('display_name')}}">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">权限描述</label>
            <input type="text" class="form-control" name="description" value="{{old('description')}}">
        </div>
        <input type="hidden" name="cover" value="" id="hidden">
        {{csrf_field()}}
        <button type="submit" class="btn btn-default">提交</button>
    </form>
@stop