<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3個meta標籤*必須*放在最前面，任何其他內容都*必須*跟隨其後！ -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>註冊</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="http://v3.bootcss.com/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="http://v3.bootcss.com/examples/signin/signin.css" rel="stylesheet">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<div class="container">

    <form class="form-signin" method="POST" action="{{route('register')}}">
        {{ csrf_field() }}
        
        <h2 class="form-signin-heading">註冊：</h2>
        <input type="text" name="name" id="name" class="form-control" placeholder="名字" required autofocus style="border-radius: 20px;margin-bottom:10px">
        <input type="email" name="email" id="email" class="form-control" placeholder="郵箱" required autofocus style="border-radius: 20px;margin-bottom:10px">
        <input type="text" name="phone" id="phone" class="form-control" placeholder="電話" required style="border-radius: 20px;margin-bottom:10px" maxlength="10">
        <input type="text" name="address" id="address" class="form-control" placeholder="地址" required style="border-radius: 20px;margin-bottom:10px">
        <input type="password" name="password" id="password" class="form-control" placeholder="輸入密碼" required style="border-radius: 20px;">
        <input type="password" name="password_confirmation" class="form-control" placeholder="重複輸入密碼" required style="border-radius: 20px;">
        
        @include('layouts.errors')
        <button class="btn btn-lg btn-primary " type="submit" style="border-radius: 20px;">註冊</button>
        <button class="btn btn-lg btn-primary " type="reset" style="border-radius: 20px;">重製輸入</button>
        <button class="btn btn-lg btn-primary " type="button" onclick="history.back()" style="border-radius: 20px;">取消</button>
    </form>

</div>

</body>
</html>