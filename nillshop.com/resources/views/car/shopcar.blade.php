<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="content">

        <a href="home">回首頁</a>
        <h1>購物車</h1>
        @if (count($content)>0)
            <table style="text-align: center;border:3px #cccccc solid;" cellpadding="10" RULES="all">
                <tr>
                    <td>商品圖片</td>
                    <td>商品名稱</td>
                    <td>商品價格</td>
                    <td>數量</td>
                    <td>庫存</td>
                    <td>操作</td>
                </tr>   
                @foreach ( $content as $key => $data)
                    <tr>
                        <td><img width="100px" height="100px" src="{{ $data->product->url }}" alt=""></td>
                        <td> {{ $data->product->name }} </td>
                        <td> {{ $data->product->money }} </td>
                        @php
                        @endphp
                        <td> <input style="width: 50px" type="number" min="0" id="much{{ $data ->Pid }}" value="{{ $data->much }}"> </td>
                        <td> {{ $data->product->quantity }} </td>
                        <td>
                            <input type="button" name="" id="" value="刪除" onclick="del({{ $data->Pid }})">
                            <input type="button" name="" id="" value="結帳" onclick="checkout( {{ $data->Pid }}, {{ Auth::id() }}, )">
                        </td>
                    </tr>
                    
                @endforeach
                
            </table>
                
        @else
                <h1>購物車中尚未加入商品</h1>
        @endif
        
    </div>
</body>
<script>
    function del(Pid) 
    {
        let jsn = JSON.stringify({'pid':Pid});
        xhr = new XMLHttpRequest();
        xhr.open('post','{{ route('cardel') }}');
        xhr.setRequestHeader('X-CSRF-TOKEN', '<?PHP echo csrf_token() ?>');
        xhr.setRequestHeader("Content-type","application/json; charset=utf-8");
        xhr.send(jsn);
        xhr.onload = function() {
            window.alert(this.responseText);
            location.reload();
        }
        
    }

    //紀錄並跳轉
    function checkout(Pid, id)
    {
        let jsn = JSON.stringify({'pid':Pid, 'id':id, 'much':document.getElementById('much' + Pid).value});
        xhr = new XMLHttpRequest();
        xhr.open('post','{{ route('carpay') }}');
        xhr.setRequestHeader('X-CSRF-TOKEN', '<?PHP echo csrf_token() ?>');
        xhr.setRequestHeader("Content-type","application/json; charset=utf-8");
        xhr.send(jsn);
        window.location.href="{{ route('payshow') }}";  ////跳轉結帳畫面
    }
</script>
</html>