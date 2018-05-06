@extends('layout.default')
@section('title','菜单添加')
@section('content')
    <form action="{{route('menu.update',$menu->id)}}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputEmail1">标题</label>
            <input type="text" class="form-control" name="title" value="{{$menu->title}}">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">上级标签</label>
            <select name="parent_id" class="form-control">
                <option value="0">无</option>
                @foreach($menus as $rows)
                <option value="{{$rows->id}}"{{$menu->parent_id==$rows->id?'selected':''}}>{{$rows->title}}</option>
                    @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">路由</label>
            <input type="text" name="url" class="form-control" value="{{$menu->url}}">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">排序</label>
            <input type="number" name="sort" class="form-control" value="{{$menu->sort}}">
        </div>
        {{csrf_field()}}
        {{method_field('PUT')}}
        <button type="submit" class="btn btn-default">修改</button>
    </form>
@stop