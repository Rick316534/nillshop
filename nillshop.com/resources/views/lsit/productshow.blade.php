<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <a href="{{route('home')}}">首頁</a>
    @guest
        <a href="{{route('regist')}}">註冊</a>
        <a href="{{route('log')}}">登入</a>
    @else
        
        <a href="{{route('logout')}}">登出</a>
        <a href="{{route('member')}}">會員中心</a>
    @endguest
    <div class="header">
        {{-- <form action="">
            <input type="text">
            <input type="button">
        </form> --}}
       
    </div>
    <div class="content" id="content" style="display: flex">
        <div class="show" id="show" style='margin-top:20px;display:flex;'>

        </div>
    </div>
    
</body>
<script>
    // 首頁商品欄位
    xhr = new XMLHttpRequest();
    xhr.open('get','{{ route('show') }}');
    xhr.setRequestHeader('X-CSRF-TOKEN', '<?PHP echo csrf_token() ?>');
    xhr.setRequestHeader("Content-type","application/json; charset=utf-8");
    xhr.send();
    xhr.onload = function() {
        let showString = "";
        obj = JSON.parse(this.responseText);
        obj.forEach(element => {
            let route = element.id ;
            if (showString == "") {
                showString = 
                    "<div id='" + element.id + "' class='box' >" +
                        "<div style='display:flex;width:200px'>" + 
                            "<img height='100px'src='" + element.url + "' alt='' style='cursor: pointer' onclick='who(" + element.id + ")'>" +
                        "<div>" +
                            "<p>" + element.name + "<p>" +
                            "<p> 價格：" + element.money + "<p>" +
                        "</div>" +
                        "</div>" +
                        "<input type='button' value='加入購物車'>" +
                        "<input type='button' name='' id='' value='結帳'>" +
                    "</div>";
            } else {
                showString += 
                    "<div id='" + element.id + "' class='box' >" +
                        "<div style='display:flex;width:200px''>" +
                            "<img height='100px'src=\'" + element.url + "" + "\' alt='' style='cursor: pointer' onclick='who(" + element.id + ")'>" +
                        "<div>" +
                            "<p>" + element.name + "<p>" +
                            "<p> 價格：" + element.money + "<p>" +
                        "</div>" +
                        "</div>" +
                        "<input type='button' value='加入購物車'>" +
                        "<input type='button' name='' id='' value='結帳'>" +
                    "</div>";
            };  
        });
        document.getElementById('show').innerHTML = showString;
    };

    //商品頁面
    function who(id) 
    {
        let showString = "";
        xhr = new XMLHttpRequest();
        xhr.open('post','{{ route('productstore') }}');
        xhr.setRequestHeader('X-CSRF-TOKEN', '<?PHP echo csrf_token() ?>');
        xhr.setRequestHeader("Content-type","application/json; charset=utf-8");
        xhr.send(JSON.stringify({"id":id}));
        xhr.onload = function() {
            obj = JSON.parse(this.responseText)[0];
            showString = 
                "<div id='" + obj.id + "' class='box' >" +
                    "<div style='display:flex;max-width:100%'>" +
                        "<div style='text-align:center'>" +
                            "<img height='200px'src='" + obj.url + "' alt='' " +
                            "<p>" + obj.name + "<p>" +
                        "</div>" +
                        "<div>" +
                            "<p> 內容：" + obj.introduce + "<p>" +
                            "<p> 價格：" + obj.money + "<p>" +
                        "</div>" +
                    "</div>" +
                    "<input type='button' value='加入購物車'>" +
                    "<input type='button' name='' id='' value='結帳'>" +
                "</div>" ;
            document.getElementById('content').innerHTML = showString;
        }
        
    }
    
</script>
</html>
