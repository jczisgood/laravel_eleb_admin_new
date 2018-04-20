@extends('layout.default')
@section('title','分类修改')
@section('content')
    <form action="{{route('businesscategory.update',$businesscategory->id)}}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputEmail1">名称</label>
            <input type="text" class="form-control" name="name" value="{{$businesscategory->name}}">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">原图片</label>
            <img src="{{$businesscategory->cover}}" class="img-rounded" width="40" height="40">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">图片</label>
            <input type="file" class="form-control" name="cover">
        </div>
        {{csrf_field()}}
        {{method_field('PUT')}}
        <button type="submit" class="btn btn-default">修改</button>
    </form>
@stop