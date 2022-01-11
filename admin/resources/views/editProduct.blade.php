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
            <label for="selectProduct">請輸入完整的商品編號：</label>
            <input type="text" id="selectProduct" name="selectProduct">
            <input type="button" id="go" value="搜尋">
            <script src=""></script>
        </div>
        <div class="show" id="show">
            <div style="display: flex;flex-wrap: wrap; width: 200px;">
                <label for="img_input">圖片:</label>
                <div style="height: 200px;width:300px"> 
                    <img src="" id="demo" style="max-height: 200px">
                </div>
                
                {{-- <input type="file" id="file" name="file" accept="image/*">  --}}
                <label for="name" style="margin: 5px auto">商品名稱</label>
                <input type="text" id="name" name="name" required>
                <label for="project" style="margin: 5px auto">種類</label>
                <select name="project" id="project" required style="margin: 5px auto">
                    <option value="1">電子</option>
                    <option value="2">食品</option>
                    <option value="3">生活</option>
                </select>
                <label for="introduce" style="margin: 5px auto">商品介紹(最多50字)</label>
                <textarea name="introduce" id="introduce" cols="20" rows="10" maxlength="50" ></textarea>
                <label for="money" style="margin: 5px auto">商品價格</label>
                <input type="text" id="money" name="money" required>
                <label for="Q" style="margin: 5px auto">商品數量</label>
                <input type="text" id="Q" name="Q" required>
                <label for="listed" style="margin: 5px auto">上市</label>
                <select name="listed" id="listed" required style="margin: 5px auto">
                    <option value="1">ON</option>
                    <option value="0">OFF</option>
                </select>
                <input type="button" value="存檔" id="check" style="margin: 10px auto">
                <input type="button" value="取消" id="reset" style="margin: 10px auto">
            </div>
        </div>
        <div>
            <a href="/">回到首頁</a><br>
        </div>
    </div>
    
</body>
<script>
    let demo = document.getElementById('demo');
    let name = document.getElementById('name');
    let money = document.getElementById('money');
    let introduce = document.getElementById('introduce');
    let q = document.getElementById('Q');
    let project = document.getElementById('project');
    let listed = document.getElementById('listed');
    document.getElementById("go").addEventListener("click", function() {
    let jsn = JSON.stringify({"id": document.getElementById("selectProduct").value});
    let xhr = new XMLHttpRequest();
    xhr.open('post','{{route('house.select')}}');
    xhr.setRequestHeader('X-CSRF-TOKEN', '<?PHP echo csrf_token() ?>');
    xhr.setRequestHeader("Content-type","application/json; charset=utf-8");
    xhr.send(jsn);
    xhr.onload = function() {
        try {
            let result = JSON.parse(this.responseText);
            demo.src = result["url"];
            name.value = result["name"];
            money.value= result["money"];
            introduce.value = result["introduce"];
            Q.value= result["quantity"];
            project.value = result["project_id"];
            listed.value = result["listed"];
        } catch (e) {
            window.alert(this.responseText);
            demo.src = "";
            name.value = "";
            money.value = "";
            introduce = "";
            Q.value= "";
            project.value = "";
            listed.value = "";
            selectProduct.value = "";
        }
        //console.log(document.getElementById('file').files);
     }
    })
    document.getElementById("check").addEventListener("click", function() {
        let id = document.getElementById('selectProduct').value;
        let jsn = JSON.stringify({"id":id, "name":name.value, 'money':money.value, 'introduce':introduce.value, 'quantity':Q.value, 'project_id':project.value, 'listed':listed.value});
        xhr = new XMLHttpRequest();
        xhr.open('post','{{route('house.up')}}');
        xhr.setRequestHeader('X-CSRF-TOKEN', '<?PHP echo csrf_token() ?>');
        xhr.setRequestHeader("Content-type","application/json; charset=utf-8");
        xhr.send(jsn);
        xhr.onload = function() {
            window.alert(this.responseText);
        }
        
    })
    document.getElementById("reset").addEventListener("click", function() {
    let jsn = JSON.stringify({"id": document.getElementById("selectProduct").value});
    let xhr = new XMLHttpRequest();
    xhr.open('post','{{route('house.select')}}');
    xhr.setRequestHeader('X-CSRF-TOKEN', '<?PHP echo csrf_token() ?>');
    xhr.setRequestHeader("Content-type","application/json; charset=utf-8");
    let data = (document.getElementById("selectProduct").value);
    xhr.send(jsn);
    xhr.onload = function() {
        try {
            let result = JSON.parse(this.responseText);
            demo.src = result["url"];
            name.value = result["name"];
            money.value = result["money"];
            introduce.value = result["introduce"];
            Q.value = result["quantity"];
            project.value = result["project_id"];
            listed.value = result["listed"];
        } catch (e) {
            window.alert(this.responseText);
            demo.src = "";
            name.value = "";
            money.value = "";
            introduce.value = "";
            Q.value = "";
            project.value = "";
            listed.value = "";
            selectProduct.value = "";
        }
        //console.log(document.getElementById('file').files);
     }
    })
</script>
</html>