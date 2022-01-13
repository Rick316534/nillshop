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
        
         
    @endguest
    <div class="content" style="display: flex">
        <div class="menu" style="margin-right: 20px">
        <ul>
            <li>電子</li>
            <li>食品</li>
            <li>生活</li>
        </ul>
        </div>
        <div class="show" style="margin-top:20px ">
            <div id="" >
                <div style="display: flex">
                    <img height="100px" src="http://admin.com/image/2022-01-13 08:11:09茶壺.jpeg" alt="">
                <div>
                    <p>今天天氣真好<p>
                    <p>價格：200<p>
                    
                </div>
                </div>
                
                <input type="button" value="加入購物車">
                <input type="button" name="" id="" value="結帳">
            </div>
        </div>
    </div>
    
    
</body>
<script>
    xhr = new XMLHttpRequest();
    xhr.open('post','{{ route('show') }}');
    xhr.setRequestHeader('X-CSRF-TOKEN', '<?PHP echo csrf_token() ?>');
    xhr.setRequestHeader("Content-type","application/json; charset=utf-8");
    xhr.send();
    xhr.onload = function() {
        obj = JSON.parse(this.responseText);
        //console.log(obj);
        obj.forEach(element => {
            document.getElementById('show'),innerHTML = "" 
        });
    }
    
</script>
</html>
