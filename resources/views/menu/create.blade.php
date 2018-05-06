@extends('layout.default')
@section('title','菜单添加')
@section('content')
    <form action="{{route('menu.store')}}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputEmail1">标题</label>
            <input type="text" class="form-control" name="title" value="{{old('title')}}">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">上级标签</label>
            <select name="parent_id" class="form-control">
                <option value="0">无</option>
                @foreach($menus as $menu)
                <option value="{{$menu->id}}"{{old('parent_id')==$menu->id?'selected':''}}>{{$menu->title}}</option>
                    @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">路由</label>
            <input type="text" name="url" class="form-control" value="{{old('url')}}">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">排序</label>
            <input type="number" name="sort" class="form-control" value="{{old('sort')}}">
        </div>
        {{csrf_field()}}
        <button type="submit" class="btn btn-default">提交</button>
    </form>
@stop