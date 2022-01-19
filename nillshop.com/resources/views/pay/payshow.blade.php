<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <a href="home">回首頁</a>
    <a href="javascript:history.back(-1)"> 上一頁 </a>
    <div class="content" style="display: flex">
        <div style="margin-right: 10px">
            @if (count($people)>0)
                @php
                    foreach ( $people as $key => $data ){
                        $name = $data->name;
                        $address = $data->address;
                        $phone = $data->phone;
                    }
                    echo ' <label for="name">收件人：</label><br><input type="text" name="name" id="name" value="'. $name. 
                        '"><br><label for="phone">電話</label><br><input type="text" name="phone" id="phone" value="'. $phone. 
                        '"><br><label for="address">地址</label><br><input type="text" name="address" id="address" value="'. $address. '"><br>'
                @endphp
                
            @else
        @endif
        </div>
        
        @if (count($content)>0)
            <table style="text-align: center;border:3px #cccccc solid;" cellpadding="10" RULES="all">
                <tr>
                    <td>商品圖片</td>
                    <td>商品名稱</td>
                    <td>商品數量</td>
                    <td>商品價格</td>
                </tr>   
                @foreach ( $content as $key => $data)
                    <tr>
                        <td><img width="100px" height="100px" src="{{ $data->url }}" alt=""></td>
                        <td>{{ $data->name }} </td>
                        @php
                            $i = 0;
                            echo '<td>'. $much[$i]['much']. '</td>';
                        @endphp
                        <td>{{ $data->money }} </td>
                          
                    </tr>
                @endforeach
                <tr>
                    <td colspan='2'>總額</td>
                    @php
                        $moneys = 0 ;
                        foreach ( $content as $key => $data ){
                            $i = 0;
                            $sum = $data->money * $much[$i]['much'];
                            $moneys += $sum;
                        }
                        
                        echo "<td colspan='2'><input type='text' id='sum' outline='none' disabled='true' style='text-align: center' value='". $moneys. "'></td>";
                    @endphp
                </tr>
            </table>
        @else
            <h1>尚未選擇商品</h1>
        @endif
    </div>
   <div style="margin-top: 16px">
        <label for="">是否送出</label>
        <input type="button" name="send" id="send" value="送出" onclick="send()" style="">
        <input type="button" value="返回" onclick="history.back()">
   </div>
    
    
</body>
<script>
    function del() 
    {
        
        
    }

    function send() 
    {
        let name = document.getElementById('name').value;
        let phone = document.getElementById('phone').value;
        let address = document.getElementById('address').value;
        let sum = document.getElementById('sum').value;
        let jsn = JSON.stringify({'name':name, 'phone':phone, 'address':address, 'sum':sum});
        xhr = new XMLHttpRequest();
        xhr.open('post','{{ route('send') }}');
        xhr.setRequestHeader('X-CSRF-TOKEN', '<?PHP echo csrf_token() ?>');
        xhr.setRequestHeader("Content-type","application/json; charset=utf-8");
        xhr.send(jsn);
        xhr.onload = function() {
            window.alert(this.responseText);
            window.location.href="{{ route('car') }}";  ////跳轉結帳畫面
        } 
    }

    function checkout()
    {
       
    }
</script>
</html>