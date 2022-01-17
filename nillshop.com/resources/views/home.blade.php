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
    <label for="name">商品名稱：</label>
    <input type="text"  name="name" id="name" style="width: 200px;">
    <input type="button" style="width: 60px;margin-bottom:8px;" id="search" onclick="search()" value="搜尋">
    @guest
        <a href="{{route('regist')}}">註冊</a>
        <a href="{{route('log')}}">登入</a>
    @else
        <a href="{{route('logout')}}">登出</a>
        <a href="{{route('member')}}">會員中心</a>
        <a href="{{route('member')}}">購物車</a>
    @endguest

    <div class="content" id="content" style="display: flex;width:1200px;margin:0 auto;justify-content:space-around;background-color:#f1e7c7">
        <div class="menu" style="margin-right: 20px">
        <ul style="width: 100px">
            <li>電子</li>
            <li>食品</li>
            <li>生活</li>
        </ul>
        </div>
        <div class="show" id="show" style='margin-top:20px;display:flex;max-width:1012px;flex-wrap:wrap'>
            @if (count($datas) > 0)
                @foreach ($datas as $key => $data )
                    <div id="{{ $data->id }}" style="border: 1px black solid;margin-right:1px;margin-bottom:1px;background-color:white;">
                        <div style="display: flex;">
                            <a href=""> <img style="height: 120px;width:100px" src="{{ $data->url }}" alt=""> </a> 
                            <div style="width: 150px;height:120px">
                                <p>名稱：<br>{{ $data->name }}</p>
                                <p>價格：{{ $data->money }}</p>
                            </div>
                        </div>
                        <div style="display:flex;justify-content:space-around;">
                            <input type="button" name="" id="" value="直接購買">
                            <input type="button" name="" id="" value="加入購物車" onclick='car({{ $data->id }})'>
                        </div>
                    </div>    
                @endforeach
            @else
                    <P>找不到商品</P>
            @endif
        </div>
    </div>
    
</body>
<script>
    function search() 
    {
        let name = document.getElementById('name').value;
        let jsn = JSON.stringify({'name':name});
        xhr = new XMLHttpRequest();
        xhr.open('post','{{ route('Pnamesearch') }}');
        xhr.setRequestHeader('X-CSRF-TOKEN', '<?PHP echo csrf_token() ?>');
        xhr.setRequestHeader("Content-type","application/json; charset=utf-8");
        xhr.send(jsn);
        xhr.onload = function() {
            let showString = ""
            obj = JSON.parse(this.responseText);
            obj.forEach(element => {
                if (showString == "") {
                    showString = 
                        "<div id='" + element.id + `' class='box' style="border: 1px black solid;margin-right:1px;margin-bottom:1px;background-color:white;">` +
                            "<div style='display:flex;width:200px'>" + 
                                "<a href=``> <img height='120px;width:100px'src='" + element.url + "' alt=''> </a>" +
                                "<div style=`width: 150px;height:120px`>" +
                                    "<p>" + element.name + "<p>" +
                                    "<p> 價格：" + element.money + "<p>" +
                                "</div>" +
                            "</div>" +
                            `<div style="display:flex;justify-content:space-around;">`+
                                "<input type='button' value='直接購買'>" +
                                "<input type='button' name='' id='' value='加入購物車'>" +
                            `</div>`+
                        "</div>";
                } else {
                    showString += 
                        "<div id='" + element.id + `' class='box' style="border: 1px black solid;margin-right:1px;margin-bottom:1px;background-color:white;">` +
                            "<div style='display:flex;width:200px'>" + 
                                "<a href=``> <img height='120px;width:100px'src='" + element.url + "' alt=''> </a>" +
                                "<div style=`width: 150px;height:120px`>" +
                                    "<p>" + element.name + "<p>" +
                                    "<p> 價格：" + element.money + "<p>" +
                                "</div>" +
                            "</div>" +
                            `<div style="display:flex;justify-content:space-around;">`+
                                "<input type='button' value='直接購買'>" +
                                "<input type='button' name='' id='' value='加入購物車'>" +
                            `</div>`+
                        "</div>";
                };  
            });
            let id = document.getElementById('show');
            id.innerHTML = showString;
        };
        
    }

    function car(id)
    {
        let jsn = JSON.stringify({'pid':id});
        xhr = new XMLHttpRequest();
        xhr.open('post','{{ route('carset') }}');
        xhr.setRequestHeader('X-CSRF-TOKEN', '<?PHP echo csrf_token() ?>');
        xhr.setRequestHeader("Content-type","application/json; charset=utf-8");
        xhr.send(jsn);
        xhr.onload = function() {
            console.log(id);
            console.log(this.responseText);
        }
    }

    //商品頁面
    // function who(id) 
    // {
    //     let showString = "";
    //     xhr = new XMLHttpRequest();
    //     xhr.open('post','{{ route('productstore') }}');
    //     xhr.setRequestHeader('X-CSRF-TOKEN', '<?PHP echo csrf_token() ?>');
    //     xhr.setRequestHeader("Content-type","application/json; charset=utf-8");
    //     xhr.send(JSON.stringify({"id":id}));
    //     xhr.onload = function() {
    //         obj = JSON.parse(this.responseText)[0];
    //         showString = 
    //             "<div id='" + obj.id + "' class='box' >" +
    //                 "<div style='display:flex;max-width:100%'>" +
    //                     "<div style='text-align:center'>" +
    //                         "<img height='200px'src='" + obj.url + "' alt='' " +
    //                         "<p>" + obj.name + "<p>" +
    //                     "</div>" +
    //                     "<div>" +
    //                         "<p> 內容：" + obj.introduce + "<p>" +
    //                         "<p> 價格：" + obj.money + "<p>" +
    //                     "</div>" +
    //                 "</div>" +
    //                 "<input type='button' value='加入購物車'>" +
    //                 "<input type='button' name='' id='' value='結帳'>" +
    //             "</div>" ;
    //         document.getElementById('content').innerHTML = showString;
    //     }
        
    // }
    
</script>
</html>
