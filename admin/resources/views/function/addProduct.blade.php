<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3個meta標籤*必須*放在最前面，任何其他內容都*必須*跟隨其後！ -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>新增商品</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="http://v3.bootcss.com/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="http://v3.bootcss.com/examples/signin/signin.css" rel="stylesheet">
</head>
<body style="max-width: 1200px;display: flex;justify-content: center;">
    <div>
        <form action="{{ route('addproduct') }}" method="post" style="display:flex;justify-content: space-around;flex-wrap: wrap; " enctype="multipart/form-data" required>
            {{ csrf_field() }}
            <div style="width: 200px;margin-right:50px">
                <label for="img_input">上傳圖片:</label>
                <input type="file" id="imginp" name="file" accept="image/*">
                <img src="" id="demo" height="200" style="margin-top: 10px">
            </div>
            <div style="width: 200px;">
                <label for="name" style="margin: 5px auto">請輸入商品名稱</label>
                <input type="text" id="name" name="name" class="form-control" required>
                <label for="project_id" style="margin: 5px auto">請選擇種類</label>
                <select name="project_id" id="project_id" class="form-control" required style="margin: 5px auto">
                    <option value="1">電子</option>
                    <option value="2">食品</option>
                    <option value="3">生活</option>
                </select>
                <label for="introduce" style="margin: 5px auto" >請輸入商品介紹(最多50字)</label>
                <textarea class="form-control" name="introduce" id="introduce" cols="20" rows="10" maxlength="50" ></textarea>
                <label for="money" style="margin: 5px auto">請輸入商品價格</label>
                <input  class="form-control" type="text" id="money" name="money" required>
                <label for="quantity" style="margin: 5px auto">請輸入商品數量</label>
                <input class="form-control" type="text" id="quantity" name="quantity" required>    
                <input class="btn btn-lg btn-primary btn-block" type="submit" value="新增" id="add" style="margin: 10px auto;width:100px">
                <input class="btn btn-lg btn-primary btn-block" type="reset" value="取消" style="margin: 10px auto;width:100px">
            </div>

        </form>
        @include('layouts.errors')
        <div>
            <a href="{{ route('home') }}">回到首頁</a><br>
        </div>
    </div>
    
</body>
<script>
    document.getElementById("imginp").addEventListener('change',function(e){
        let file = e.target.files[0]; 
         console.log(e.target.files[0]);
        var reader = new FileReader();
        reader.readAsDataURL(file); // 读取文件
        // 渲染文件
        reader.onload = function(arg) {
            document.getElementById("demo").src = arg.target.result;
        }
    })
</script>
</html>