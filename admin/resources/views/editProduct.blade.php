<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>編輯</title>
</head>
<body style="margin: 0 auto;max-width: 1200px">
    <div style="margin: 0 auto;width: 100%">
        <div>
            {{ csrf_field() }}
            <label for="selectProduct">請輸入要編輯的完整商品ID：</label>
            <input type="text" id="selectProduct" name="selectProduct">
            <input type="button" id="go" value="搜尋">
            <script src=""></script>
        </div>
        <div class="show" id="show">
            <img src="{{ asset('image/2022-01-06 06:22:54水瓶2號.jpeg') }}">
        </div>
        <div>
            <a href="/">回到首頁</a><br>
        </div>
    </div>
    
</body>
<script>
    document.getElementById("go").addEventListener("click", function() {
    let jsn = JSON.stringify({"id": document.getElementById("selectProduct").value});
    let xhr = new XMLHttpRequest();
    xhr.open('post','{{route('house.select')}}');
    xhr.setRequestHeader('X-CSRF-TOKEN', '<?PHP echo csrf_token() ?>');
    xhr.setRequestHeader("Content-type","application/json; charset=utf-8");
    let data = (document.getElementById("selectProduct").value);
    xhr.send(jsn);
    xhr.onload = function() {
        document.getElementById("show").innerHTML = "<img src=" + this.responseText +  ">";
        console.log(this.responseText);
    }
    })
</script>
</html>