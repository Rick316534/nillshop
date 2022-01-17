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
        <label for="name">商品名稱：</label>
        <input type="text"  name="name" id="name" style="width: 200px;">
        <input type="button" style="width: 60px;margin-bottom:8px;" id="search" value="搜尋">
        <div>
            <a href="{{ route('home') }}" style="margin-bottom:-5px;" >回到首頁</a>
        </div>
        
    </div>
    <div id="show">
        <table id="tableshow" style="width: 800px">
            
        </table>
    </div>
</body>
<script>

    function load()
    {
        xhr = new XMLHttpRequest();
        xhr.open('post','{{ route('allp') }}');
        xhr.setRequestHeader('X-CSRF-TOKEN', '<?PHP echo csrf_token() ?>');
        xhr.setRequestHeader("Content-type","application/json; charset=utf-8");
        xhr.send();
        xhr.onload = function() {
            let content = '<tr"> <td>商品ID</td> <td>商品名稱</td> <td>操作</td> </tr>';
            try {
                JSON.parse(this.responseText).forEach(element => {
                    content += '<tr> <td>' + element.id + '</td> <td>' + element.name + '</td>' +
                    '<td> <input type="button" id="edit" style="margin-right:4px" value="編輯" style="margin-right:4px" onclick="edit(`' + element.id +'`)"> ' + 
                    '<input type="button" id="delete" value="刪除" onclick="del(`' + element.id +'`, `' + element.name + '`)"> </td> </tr>';
                });
                document.getElementById('tableshow').innerHTML = content;
            } catch (e) {
                window.alert('錯誤');
            }
        }
    }

    function edit (id)
    {
        let jsn = JSON.stringify({"id":id});
        xhr = new XMLHttpRequest();
        xhr.open('post','{{ route('idset') }}');
        xhr.setRequestHeader('X-CSRF-TOKEN', '<?PHP echo csrf_token() ?>');
        xhr.setRequestHeader("Content-type","application/json; charset=utf-8");
        xhr.send(jsn);
        window.open("{{ route('onloadp') }}");
    }

    function del (id, name)
    {
        let check = confirm('是否刪除：ID為：' + id + '的' + name );
        if (check) {
            let jsn = JSON.stringify({"id":id});
            xhr.open('post','{{ route('deletep') }}');
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
            let name = document.getElementById('name');
            let jsn = JSON.stringify({"name":name.value});
            xhr = new XMLHttpRequest();
            xhr.open('post','{{ route('searchp') }}');
            xhr.setRequestHeader('X-CSRF-TOKEN', '<?PHP echo csrf_token() ?>');
            xhr.setRequestHeader("Content-type","application/json; charset=utf-8");
            xhr.send(jsn);
            xhr.onload = function() {
                let content = '<tr"> <td>商品ID</td> <td>商品名稱</td> <td>操作</td> </tr>';
                try {
                    JSON.parse(this.responseText).forEach(element => {
                        content += '<tr> <td>' + element.id + '</td> <td>' + element.name + '</td> ' +
                        '<td> <input type="button" id="edit" style="margin-right:4px" value="編輯" style="margin-right:4px" onclick="edit(`' + element.id +'`)"> ' + 
                        '<input type="button" id="delete" value="刪除" onclick="del(`' + element.id +'`)"> </td> </tr>';
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