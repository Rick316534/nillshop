<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>帳號管理</title>
</head>
<body>
    <div class="header">
        <label for="search">搜尋：</label>
        <input type="text" id="search" name="search" value="請輸入使用者ID(email)">
        <input type="button" name="begin" id="begin" value="搜尋">
    </div>
    <div class="show">
        <h2 class="userid">Userid</h2>
        <label for="name">姓名：</label>
        <input type="text" name="name" id="name">
        <label for="phone">電話：</label>
        <input type="text" name="phone" id="phone">
        <label for="address">地址：</label>
        <input type="text" name="address" id="address">
        <label for="lv">等級：</label>
        <input type="text" name="lv" id="lv">
        
    </div>
</body>
<script>
    document.getElementById('begin').addEventListener('click',function(){
    let jsn = JSON.stringify({"id": document.getElementById('search').value});
    let xhr = new XMLHttpRequest();
    xhr.open('post','{{route('member.store')}}');
    xhr.setRequestHeader('X-CSRF-TOKEN', '<?PHP echo csrf_token() ?>');
    xhr.setRequestHeader("Content-type","application/json; charset=utf-8");
    xhr.send(jsn);
    xhr.onload = function() {

    }
    
    })
    
</script>
</html>