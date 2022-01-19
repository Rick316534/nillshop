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

    <title>帳號列表</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="http://v3.bootcss.com/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="http://v3.bootcss.com/examples/signin/signin.css" rel="stylesheet">
</head>
<body style="display: flex;justify-content: center;">
    <div>
        <div style="margin-left:-80px">
            <input type="hidden"  name="email" id="email" style="width: 200px;">
        </div>
        <form action="{{ route('editproduct') }}" method="post" style="display:flex;justify-content: space-around;flex-wrap: wrap;width:200px " enctype="multipart/form-data" required>
            {{ csrf_field() }}
            <label for="name" style="margin: 5px auto">帳號名稱</label>
            <input type="text" id="name" name="name" class="form-control" required>
            <label for="lv" style="margin: 5px auto">帳號等級</label>
            <select name="lv" id="lv" disabled='true' class="form-control" required style="margin: 5px auto">
                <option value="1">等級一</option>
                <option value="2">等級二</option>
            </select>
            <label for="address" style="margin: 5px auto" >帳號住址</label>
            <textarea class="form-control" name="address" id="address" cols="20" rows="10" maxlength="50" ></textarea>
            <label for="phone" style="margin: 5px auto">帳號電話</label>
            <input  class="form-control" type="text" id="phone" name="phone" required>
            <label for="money" style="margin: 5px auto">帳號餘額</label>
            <input class="form-control" type="text" id="money" name="money" required> 
            <label for="sum" style="margin: 5px auto" >帳號消費金額</label>
            <input class="form-control" type="text" id="sum" name="sum" disabled='true' required>    
            <label for="status" style="margin: 5px auto">帳號狀態</label>
            <select name="status" id="status" class="form-control" required style="margin: 5px auto">
                <option value="1">啟用</option>
                <option value="0">停權</option>
            </select>
            <input class="btn btn-lg btn-primary btn-block" type="button" value="存檔" id="save" style="margin: 10px auto;width:100px">
            <input class="btn btn-lg btn-primary btn-block" type="button" value="更改密碼" id="psw" style="margin: 10px auto;width:125px;display:none">
        </form>
        @include('layouts.errors')
    </div>
    <div class="pswshow" id="pswshow" style="position: fixed;width:100%;height:150%;justify-content: center; margin-top:-20px;display:none">
        <form action="" method="post" style="display:flex;justify-content: space-around;flex-wrap: wrap;width:200px;align-content: center;margin-top:-300px;" enctype="multipart/form-data" required>
            {{ csrf_field() }}
            <input type="password" name="password" id="password" class="form-control"  placeholder="輸入密碼" required style="border-radius: 20px;margin-bottom:10px">
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="重複輸入密碼" required style="border-radius: 20px;">
            <input class="btn btn-lg btn-primary btn-block" type="button" value="送出" id="newpsw" style="margin: 10px auto;width:100px">
            <input class="btn btn-lg btn-primary btn-block" type="button" value="取消" id="reset" style="margin: 10px auto;width:100px">
        </form>
        <div style="opacity: 0.85;position: absolute;width:100%;height:100%;margin-top:-20px;background-color:black;z-index:-1">
        </div>
    </div>
</body>
<script>
    let email = document.getElementById('email');
    let name = document.getElementById('name');
    let money = document.getElementById('money');
    let lv = document.getElementById('lv');
    let status = document.getElementById('status');
    let address = document.getElementById('address');
    let phone = document.getElementById('phone');
    let sum = document.getElementById('sum');

    xhr = new XMLHttpRequest();
    xhr.open('post','{{ route('findmember') }}');
    xhr.setRequestHeader('X-CSRF-TOKEN', '<?PHP echo csrf_token() ?>');
    xhr.setRequestHeader("Content-type","application/json; charset=utf-8");
    xhr.send();
    xhr.onload = function() {
        try {
            let result = JSON.parse(this.responseText);
            email.value = result['email'];
            name.value = result['name'];
            money.value = result['money'];
            lv.value = result['lv'];
            status.value = result['status'];
            phone.value = result['phone'];
            address.value = result['address'];
            sum.value = result['sum'];
            document.getElementById('psw').style.display = "block" ;
            console.log(result);
        } catch (e) {
            window.alert(this.responseText);
            email.value = "";
            document.getElementById('psw').style.display = "none" ;
        }
    }

    document.getElementById('save').addEventListener(
        "click", 
        function() 
        {
            let jsn = JSON.stringify({"email":email.value, "phone":phone.value, "address":address.value, "name":name.value, "status":status.value, "money":money.value});
            xhr = new XMLHttpRequest();
            xhr.open('post','{{ route('editmember') }}');
            xhr.setRequestHeader('X-CSRF-TOKEN', '<?PHP echo csrf_token() ?>');
            xhr.setRequestHeader("Content-type","application/json; charset=utf-8");
            xhr.send(jsn);
            xhr.onload = function() {
                try {
                    let result = JSON.parse(this.responseText);
                    name.value = result['name'];
                    money.value = result['money'];
                    lv.value = result['lv'];
                    status.value = result['status'];
                    phone.value = result['phone'];
                    address.value = result['address'];
                } catch (e) {
                    window.alert(this.responseText);
                }
                window.close();
            }
            
        }
    );

    document.getElementById('psw').addEventListener(
        "click", 
        function() 
        {
            document.getElementById('pswshow').style.display = 'flex';
        }
    );

    document.getElementById('reset').addEventListener(
        "click", 
        function() 
        {
            document.getElementById('password').value = "";
            document.getElementById('password_confirmation').value = "";
            document.getElementById('pswshow').style.display = "none" ;
        }
    );

    document.getElementById('newpsw').addEventListener(
        "click", 
        function() 
        {
            console.log(document.getElementById('email').value);
            let jsn = JSON.stringify({"email":document.getElementById('email').value, "password":document.getElementById('password').value, "password_confirmation":document.getElementById('password_confirmation').value});
            xhr = new XMLHttpRequest();
            xhr.open('post','{{ route('editpsw') }}');
            xhr.setRequestHeader('X-CSRF-TOKEN', '<?PHP echo csrf_token() ?>');
            xhr.setRequestHeader("Content-type","application/json; charset=utf-8");
            xhr.send(jsn);
            xhr.onload = function() {
                window.alert(this.responseText);
                document.getElementById('password').value = "";
                document.getElementById('password_confirmation').value = "";
                document.getElementById('pswshow').style.display = "none" ;  

            }
        }
    );

</script>
</html>