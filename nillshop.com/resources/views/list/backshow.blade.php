<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>退貨管理</title>
    <style type="text/css">
        tr:hover {
          color: rgb(8, 8, 8);
          background-color: #c58627 }
    </style>
</head>

<body>
    <div style="">
       
        <div>
            <a href="{{ route('home') }}" style="margin-bottom:-5px;" >回到首頁</a>
            <a href="javascript:history.back(-1)"> 上一頁 </a>
        </div>
        
    </div>
    <table style="text-align: center;" rules="rows" id="tableshow">
        <tr>
            <td>訂單編號</td> <td>收件人</td> <td>收件地址</td> <td>收件電話</td> <td>商品</td> <td>價格</td> <td style="padding-left:20px">數量</td> <td>總價格</td> <td>狀態</td>
            <td>退貨日期</td>
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
                    {{ $data->updated_at }}
                </td>
                
            </tr>
            
        @endforeach
    </table>
</body>

</html>