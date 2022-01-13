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
        <a href="{{ route('home') }}">首頁</a>
    @else
        <a href="{{ route('home') }}">首頁</a>
        <a href="{{ route('memberstore',['rout' => 'e']) }}">查看帳號資訊</a>
        <a href="{{ route('memberstore',['rout' => 'o']) }}">查看歷史訂單</a>
        <a href="{{ route('memberstore',['rout' => 'r']) }}">查看退貨紀錄</a>
    @endguest
</body>
</html>