@extends('layout.default')
@section('title','分类添加')
@section('content')
    <form action="{{route('businesscategory.store')}}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputEmail1">名称</label>
            <input type="text" class="form-control" name="name" value="{{old('name')}}">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">图片</label>
            <input type="file" class="form-control" name="cover">
        </div>
        {{csrf_field()}}
        <button type="submit" class="btn btn-default">提交</button>
    </form>
@stop