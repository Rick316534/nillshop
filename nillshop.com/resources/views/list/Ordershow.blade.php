<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>歷史訂單</title>
    <style type="text/css">
        tr:hover {
          color: rgb(8, 8, 8);
          background-color: #c58627 }
    </style>
</head>

<body>
    <div style="">
        <label for="day" >起始日期：</label>
        <input type="text"  name="day" id="beginday" style="width: 200px;" placeholder="YY-MM-DD">
        <label for="day" >結尾日期：</label>
        <input type="text"  name="day" id="endday" style="width: 200px;" placeholder="YY-MM-DD">
        <input type="button" style="width: 60px;margin-bottom:8px;" id="search" value="搜尋" onclick="search()">
        <div>
            <a href="{{ route('home') }}" style="margin-bottom:-5px;" >回到首頁</a>
            <a href="javascript:history.back(-1)"> 上一頁 </a>
        </div>
        
    </div>
    <table style="text-align: center;" rules="rows" id="tableshow">
        <tr>
            <td>訂單編號</td> <td>收件人</td> <td>收件地址</td> <td>收件電話</td> <td>商品</td> <td>價格</td> <td style="padding-left:20px">數量</td> <td>總價格</td> <td>狀態</td>
            <td>下單日期</td> <td>操作</td>
        </tr> 
        @foreach ( $datas as $key => $data )       
            <tr class="taline">
                <td>
                    {{ $data->id }}
                </td>
                <td style="width: 100px">
                    {{ $data->name }}
                </td>
                <td style="width: 250px">
                    {{ $data->address }}
                </td>
                <td style="width: 150px">
                    {{ $data->phone }}
                </td>
                <td style="width: 250px">
                    {{ $data->content }}
                </td>
                <td>
                    {{ $data->money }}
                </td>
                <td style="width: 100px;padding-left:20px"> 
                    {{ $data->listed }}
                </td>
                <td style="width: 200px">
                    {{ $data->sum }}
                </td>
                <td >
                    {{ $data->status }}
                </td>
                <td style="width: 350px">
                    {{ $data->created_at }}
                </td>
                <td>
                    <input type="button" value="退貨" onclick="back({{ $data->id }})">
                </td>
            </tr>
            
        @endforeach
    </table>
</body>
<script>

    function search ()
    {
        let beginday = document.getElementById('beginday');
        let endday = document.getElementById('endday');
        let jsn = JSON.stringify({"beginday":beginday.value, "endday":endday.value});
        xhr = new XMLHttpRequest();
        xhr.open('post','{{ route('searcho')}}');
        xhr.setRequestHeader('X-CSRF-TOKEN', '<?PHP echo csrf_token() ?>');
        xhr.setRequestHeader("Content-type","application/json; charset=utf-8");
        xhr.send(jsn);
        xhr.onload = function() {
            let content = '<tr> <td>訂單編號</td> <td>收件人</td> <td>收件地址</td> <td>收件電話</td> <td>商品</td> <td>價格</td> <td style="padding-left:20px">數量</td> <td>總價格</td> <td>狀態</td><td>下單日期</td> <td>操作</td> </tr>';
            try {
                JSON.parse(this.responseText).forEach(element => {
                    content += '<tr> <td>' + element.id + '</td> <td style="width: 100px">' + element.name + '</td> ' +
                        '<td style="width: 250px">' + element.address + '</td> <td style="width: 150px">' + element.phone + '</td> ' +
                        '<td style="width: 250px">' + element.content + '</td> <td>' + element.money + '</td> ' +
                        '<td style="width: 100px;padding-left:20px">' + element.listed + '</td> <td style="width: 200px">' + element.sum + '</td> ' +
                        '<td>' + element.status + '</td> <td style="width: 350px">' + element.created_at + '</td> ' +
                    '<td><input type="button"  value="退貨" onclick="back(' + element.id + ')" </td> </tr>';
                });
                document.getElementById('tableshow').innerHTML = content;
            } catch (e) {
                window.alert(this.responseText);
            }
        }
    }

    function back(id) 
    {
        let jsn = JSON.stringify({"id":id});
        xhr = new XMLHttpRequest();
        xhr.open('post','{{ route('back')}}');
        xhr.setRequestHeader('X-CSRF-TOKEN', '<?PHP echo csrf_token() ?>');
        xhr.setRequestHeader("Content-type","application/json; charset=utf-8");
        xhr.send(jsn);
        xhr.onload = function() {
            window.alert(this.responseText);
        }
        location.reload();
    }

</script>
</html>