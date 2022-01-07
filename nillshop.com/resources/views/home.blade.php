@extends('layouts.app')

@section('content')
<div class="container" style="display: flex;justify-content: space-between;padding: 0;">
    <div class="row" style="width: 20%">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">類別</div>
                <div class="panel-body project_menu">
                    {{-- @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif --}}
                        <ul>
                            <li>電子</li>
                            <li>食品</li>
                            <li>生活</li>
                        </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="margin: 0 auto; width:80%">
        <div class="" style="">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align: center">商品欄</div>
                <div class="panel-body project_menu" >
                    {{-- @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif --}}
                    <ul style="display: flex;margin: 0 auto;justify-content: space-between;list-style-type: none;padding: 0 10px;">
                        <li>
                            <img style="height: 120px" src="http://admin.com/image/2022-01-06%2010:35:44demp4.png" alt="">
                            <div style="display: flex;justify-content: space-between; ">
                                <a href="">點我詳情</a>
                                <a href="">加入</a>
                            </div>
                        </li>
                        <li><img style="height: 120px" src="http://admin.com/image/2022-01-06%2010:35:44demp4.png" alt=""></li>
                        <li><img style="height: 120px" src="http://admin.com/image/2022-01-06%2010:35:44demp4.png" alt=""></li>
                        <li><img style="height: 120px" src="http://admin.com/image/2022-01-06%2010:35:44demp4.png" alt=""></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
