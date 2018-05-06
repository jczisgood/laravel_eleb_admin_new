@extends('layout.default')
@section('title','排行列表')
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
    <h2>订单详情</h2>
    <table class="table table-hover" id="mytable">
        <tr>
            <th>累计</th>
            <th>当月</th>
            <th>当天</th>
        </tr>
        <tr>
            <td>{{$arr[0]}}</td>
            <td>{{$arr[1]}}</td>
            <td>{{$arr[2]}}</td>
        </tr>
    </table>

    <h2>食品销量排行</h2>
    <table class="table table-hover" id="mytable">
        <tr>
            <th>店铺名</th>
            <th>食品名称</th>
            <th>食品销量</th>
        </tr>
        @foreach($rows as $row)
            <tr>
                <td>{{$row->shop_name}}</td>
                <td>{{$row->goods_name}}</td>
                <td>{{$row->amounts}}</td>
            </tr>
        @endforeach
    </table>
@stop