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
        <input type="button" name="begin" id="begin" value="搜尋" onclick="search()">
        <div class="tool" id="tool" style="opacity: 0">
            <input type="button" value="存檔" id="save" style="margin: 10px auto;" onclick="save()">
            <input type="button" value="取消" id="reset" style="margin: 10px auto;" onclick="search()">
            <input type="button" value="更改密碼" id="resetpassword" style="margin: 10px auto;" onclick="changeStatus()">
            <input type="button" value="刪除該帳號" id="delete" style="margin: 10px auto;" onclick="deleteUser()">
            <input type="button" value="返回" id="previous" style="margin: 10px auto;opacity:0" onclick="changeStatus()" >
        </div>
    </div>
    <div class="show" id="show">
        <div id="generally" style="opacity: 1">
            <h2 class="userid">Userid</h2>
            <label for="name">姓名：</label>
            <input type="text" name="name" id="name">
            <label for="phone">電話：</label>
            <input type="text" name="phone" id="phone">
            <label for="address">地址：</label>
            <input type="text" name="address" id="address">
            {{-- <label for="lv">等級：</label>
            <input type="text" name="lv" id="lv"> --}}
        </div>
        <div id="forPsw" style="opacity: 0">
            <label for="old">請輸入舊密碼：</label> 
            <input type="text" id="old">
            <label for="new">請輸入新密碼：</label> 
            <input type="text" id="new">
            <label for="check">再次輸入新密碼：</label> 
            <input type="text" id="check">
        </div>

    </div>
    <div>
        <a href="/">回到首頁</a><br>
    </div>
</body>
<script>
    let status = false;
    let name = document.getElementById('name');
    let phone = document.getElementById('phone');
    let address = document.getElementById('address');

    function search()
    {
    let jsn = JSON.stringify({"id": document.getElementById('search').value});
    let xhr = new XMLHttpRequest();
    xhr.open('post','{{route('member.store')}}');
    xhr.setRequestHeader('X-CSRF-TOKEN', '<?PHP echo csrf_token() ?>');
    xhr.setRequestHeader("Content-type","application/json; charset=utf-8");
    xhr.send(jsn);
    xhr.onload = function() {
        try {
            let result = JSON.parse(this.responseText);
            name.value = result["name"];
            phone.value = result['phone'];
            address.value = result['address'];
            document.getElementById('tool').style.opacity = 1;
        } catch (e) {
            window.alert(this.responseText);
        }
    }
    };

    function save()
    {
        let jsn = JSON.stringify({"id": document.getElementById('search').value, "name":name.value, "phone":phone.value, "address":address.value});
        let xhr = new XMLHttpRequest();
        xhr.open('post','{{route('member.up')}}');
        xhr.setRequestHeader('X-CSRF-TOKEN', '<?PHP echo csrf_token() ?>');
        xhr.setRequestHeader("Content-type","application/json; charset=utf-8");
        xhr.send(jsn);
        xhr.onload = function() {
            try {
                let result = JSON.parse(this.responseText);
                console.log(result);

            } catch (e) {
                window.alert(this.responseText);
            }
        }       
    }
    

    function deleteUser()
    {
    let jsn = JSON.stringify({"id": document.getElementById('search').value});
    let xhr = new XMLHttpRequest();
    xhr.open('post','{{route('member.delete')}}');
    xhr.setRequestHeader('X-CSRF-TOKEN', '<?PHP echo csrf_token() ?>');
    xhr.setRequestHeader("Content-type","application/json; charset=utf-8");
    xhr.send(jsn);
    xhr.onload = function() {
        window.location.reload();
        window.alert(this.responseText);        
    }
    };
    
    function changeStatus()
    {
        
        switch (status) {
            case false :
                status = true;
                console.log("123");
                document.getElementById('generally').style.opacity = 0;
                document.getElementById('forPsw').style.opacity = 1;
                document.getElementById('previous').style.opacity = 1;
                document.getElementById('reset').style.opacity = 0;
                document.getElementById('resetpassword').style.opacity = 0;
                document.getElementById('delete').style.opacity = 0;
                break;
            case true :
                status = false;
                document.getElementById('generally').style.opacity = 1;
                document.getElementById('forPsw').style.opacity = 0;
                document.getElementById('previous').style.opacity = 0;
                document.getElementById('reset').style.opacity = 1;
                document.getElementById('resetpassword').style.opacity = 1;
                document.getElementById('delete').style.opacity = 1;
        }
        
    }
    
</script>
</html>