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

    <title>編輯商品</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="http://v3.bootcss.com/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="http://v3.bootcss.com/examples/signin/signin.css" rel="stylesheet">
</head>
<body style="max-width: 1200px;display: flex;justify-content: center;">
    <div>
        <div style="margin-bottom: 20px">
            <input type="hidden"  name="id" id="id" style="width: 100px">
        </div>
        
        <form action="{{ route('editproduct') }}" method="post" style="display:flex;justify-content: space-around;flex-wrap: wrap; " enctype="multipart/form-data" required>
            {{ csrf_field() }}
            <div style="width: 200px;margin-right:300px">
                <label for="img_input">圖片:</label>
                <img src="" id="demo" height="200" style="margin-top: 10px">
            </div>
            <div style="width: 200px;">
                <label for="name" style="margin: 5px auto">商品名稱</label>
                <input type="text" id="name" name="name" class="form-control" required>
                <label for="project_id" style="margin: 5px auto">種類</label>
                <select name="project_id" id="project_id" class="form-control" required style="margin: 5px auto">
                    <option value="1">電子</option>
                    <option value="2">食品</option>
                    <option value="3">生活</option>
                </select>
                <label for="introduce" style="margin: 5px auto" >商品介紹(最多50字)</label>
                <textarea class="form-control" name="introduce" id="introduce" cols="20" rows="10" maxlength="50" ></textarea>
                <label for="money" style="margin: 5px auto">商品價格</label>
                <input  class="form-control" type="text" id="money" name="money" required>
                <label for="quantity" style="margin: 5px auto">商品數量</label>
                <input class="form-control" type="text" id="quantity" name="quantity" required>    
                <label for="listed" style="margin: 5px auto">上市</label>
                <select name="listed" id="listed" class="form-control" required style="margin: 5px auto">
                    <option value="1">ON</option>
                    <option value="0">OFF</option>
                </select>
                <input class="btn btn-lg btn-primary btn-block" type="button" value="存檔" id="save" style="margin: 10px auto;width:100px">
            </div>

        </form>
        @include('layouts.errors')
    </div>
    
</body>
<script>
    let id = document.getElementById('id');
    let demo = document.getElementById('demo');
    let name = document.getElementById('name');
    let money = document.getElementById('money');
    let introduce = document.getElementById('introduce');
    let quantity = document.getElementById('quantity');
    let project_id = document.getElementById('project_id');
    let listed = document.getElementById('listed');
    xhr = new XMLHttpRequest();
    xhr.open('post','{{ route('findproduct') }}');
    xhr.setRequestHeader('X-CSRF-TOKEN', '<?PHP echo csrf_token() ?>');
    xhr.setRequestHeader("Content-type","application/json; charset=utf-8");
    xhr.send();
    xhr.onload = function() {
        try {
            let result = JSON.parse(this.responseText);
            id.value = result['id'];
            demo.src = result["url"];
            name.value = result["name"];
            money.value = result["money"];
            introduce.value = result["introduce"];
            quantity.value = result["quantity"];
            project_id.value = result["project_id"];
            listed.value = result["listed"];
        } catch (e) {
            window.alert(this.responseText);
            id.value = "";
        }
    }

    document.getElementById('save').addEventListener(
    "click", 
    function() 
    {
        let jsn = JSON.stringify({"id":id.value, "name":name.value, 'money':money.value, 'introduce':introduce.value, 'quantity':quantity.value, 'project_id':project_id.value, 'listed':listed.value});
        xhr = new XMLHttpRequest();
        xhr.open('post','{{ route('editproduct') }}');
        xhr.setRequestHeader('X-CSRF-TOKEN', '<?PHP echo csrf_token() ?>');
        xhr.setRequestHeader("Content-type","application/json; charset=utf-8");
        xhr.send(jsn);
        xhr.onload = function() {
            try {
                let result = JSON.parse(this.responseText);
                demo.src = result["url"];
                name.value = result["name"];
                money.value = result["money"];
                introduce.value = result["introduce"];
                quantity.value = result["quantity"];
                project_id.value = result["project_id"];
                listed.value = result["listed"];
            } catch (e) {
                window.alert(this.responseText);

            }
            window.close();
        }
    });

</script>
</html>