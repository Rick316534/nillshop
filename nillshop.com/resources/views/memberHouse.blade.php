<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2>今天天氣好</h2>
    <a href="{{route('home')}}">首頁</a>
    @guest
    @else
    <h2>{{ Auth::user()->name }}</h2>
    <h2>查看：{{Auth::user()}}</h2>
    @endguest
</body>
</html>