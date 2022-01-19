<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>首頁</title>
</head>
<body>
    @guest
        {{-- <a href="{{route('regist')}}">註冊</a> --}}
        <a href="{{route('log')}}">登入</a>
    @else
        <a href="{{ route('logout') }}">登出</a>
        <div>
            <h2>商品管理</h2>
            <a href="{{ route('product',['rout' => 'a']) }}">新增商品</a>
            <a href="{{ route('product',['rout' => 'e']) }}">編輯商品</a>
        </div>
        <div>
            <h2>帳號功能</h2>
            <a href="{{ route('member') }}">帳號列表</a>
        </div>
        <div>
            <h2>訂單與退貨</h2>
            <a href="{{ route('order') }}">訂單管理</a>
            <a href="{{ route('backindex') }}">退貨管理</a>
        </div>
    @endguest
    
</body>
</html>