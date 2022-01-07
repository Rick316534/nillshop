<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style="max-width: 1200px;display: flex;justify-content: center;">
    <div>
        <form action="{{ route('house.store') }}" method="post" style="display: flex;flex-wrap: wrap; width: 200px;" enctype="multipart/form-data" required>
            {{ csrf_field() }}
             <label for="img_input">上傳圖片:</label>
            <img src="" id="demo" height="200">
            <input type="file" id="imginp" name="file" accept="image/*"> 
            <label for="name" style="margin: 5px auto">請輸入商品名稱</label>
            <input type="text" id="name" name="name" required>
            <label for="project" style="margin: 5px auto">請選擇種類</label>
            <select name="project" id="project" required style="margin: 5px auto">
                <option value="1">電子</option>
                <option value="2">食品</option>
                <option value="3">生活</option>
            </select>
            <label for="introduce" style="margin: 5px auto">請輸入商品介紹(最多50字)</label>
            <textarea name="introduce" id="introduce" cols="20" rows="10" maxlength="50" ></textarea>
            <label for="money" style="margin: 5px auto">請輸入商品價格</label>
            <input type="text" id="money" name="money" required>
            <label for="Q" style="margin: 5px auto">請輸入商品數量</label>
            <input type="text" id="Q" name="Q" required>
            <input type="submit" value="GO" style="margin: 10px auto">
        </form>
        <div>
            <a href="/">回到首頁</a><br>
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