{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @guest
        <a href="{{route('regist')}}">註冊</a>
        <a href="{{route('log')}}">登入</a>
    @else
        <a href="{{route('logout')}}">登出</a>
        <a href="{{route('member')}}">會員中心</a>
        <h2>你好：<span>{{ Auth::user()->name }}</span></h2>
        <h2>驗證：<span>{{ Auth::user() }}</span></h2>
        
    @endguest
    
    
    
</body>
</html>
