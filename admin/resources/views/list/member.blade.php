<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body onload="load()">
    <div style="">
        <label for="email">會員Email：</label>
        <input type="text"  name="email" id="email" style="width: 200px;">
        <input type="button" style="width: 60px;margin-bottom:8px;" id="search" value="搜尋">
        <div>
            <a href="{{ route('home') }}" style="margin-bottom:-5px;" >回到首頁</a>
        </div>
        
    </div>
    <div id="show">
        <table id="tableshow" style="width: 500px">
        </table>
    </div>
</body>
<script>
    function load()
    {
        xhr = new XMLHttpRequest();
        xhr.open('post','{{ route('all') }}');
        xhr.setRequestHeader('X-CSRF-TOKEN', '<?PHP echo csrf_token() ?>');
        xhr.setRequestHeader("Content-type","application/json; charset=utf-8");
        xhr.send();
        xhr.onload = function() {
            let content = '<tr"> <td>帳號</td> <td>名稱</td> <td>操作</td> </tr>';
            try {
                JSON.parse(this.responseText).forEach(element => {
                    content += '<tr> <td>' + element.email + '</td> <td>' + element.name + '</td> ' +
                    '<td> <input type="button" id="edit" style="margin-right:4px" value="編輯" style="margin-right:4px" onclick="edit(`' + element.email +'`)"> ' + 
                    '<input type="button" id="delete" value="刪除" onclick="del(`' + element.email +'`)"> </td> </tr>';
                });
                document.getElementById('tableshow').innerHTML = content;
            } catch (e) {
                window.alert(this.responseText);
            }
        }
    }

    function edit (email)
    {
        let jsn = JSON.stringify({"email":email});
        xhr = new XMLHttpRequest();
        xhr.open('post','{{ route('emailset') }}');
        xhr.setRequestHeader('X-CSRF-TOKEN', '<?PHP echo csrf_token() ?>');
        xhr.setRequestHeader("Content-type","application/json; charset=utf-8");
        xhr.send(jsn);
        window.open("{{ route('onloadm') }}");
    }

    function del (email)
    {
        let check = confirm('是否刪除：' + email);
        if (check) {
            let jsn = JSON.stringify({"email":email});
            xhr.open('post','{{ route('delete') }}');
            xhr.setRequestHeader('X-CSRF-TOKEN', '<?PHP echo csrf_token() ?>');
            xhr.setRequestHeader("Content-type","application/json; charset=utf-8");
            xhr.send(jsn);
            xhr.onload = function() {
                window.alert(this.responseText);
            }
            location.reload();
        } else {
            window.alert('未刪除');
        }
        
    }

    document.getElementById('search').addEventListener(
        "click", 
        function() 
        {
            let jsn = JSON.stringify({"email":email.value});
            xhr = new XMLHttpRequest();
            xhr.open('post','{{ route('search') }}');
            xhr.setRequestHeader('X-CSRF-TOKEN', '<?PHP echo csrf_token() ?>');
            xhr.setRequestHeader("Content-type","application/json; charset=utf-8");
            xhr.send(jsn);
            xhr.onload = function() {
                let content = '<tr"> <td>帳號</td> <td>名稱</td> <td>操作</td> </tr>';
                try {
                    JSON.parse(this.responseText).forEach(element => {
                        content += '<tr> <td>' + element.email + '</td> <td>' + element.name + '</td> ' +
                        '<td> <input type="button" id="edit" style="margin-right:4px" value="編輯" style="margin-right:4px" onclick="edit(`' + element.email +'`)"> ' + 
                        '<input type="button" id="delete" value="刪除" onclick="del(`' + element.email +'`)"> </td> </tr>';
                    });
                    document.getElementById('tableshow').innerHTML = content;
                } catch (e) {
                    window.alert(this.responseText);
                }
            }
        }
    );

</script>
</html>