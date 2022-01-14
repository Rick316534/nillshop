<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div style="margin-left:-80px">
        <label for="email">會員Email：</label>
        <input type="email"  name="email" id="email" style="width: 200px;">
        <input type="button" style="width: 60px;margin-bottom:8px;" id="search" value="搜尋">
        
        <a href="{{ route('home') }}" style="text-align: center;display: block;margin-bottom:-5px;" >回到首頁</a><br>
    </div>
    <div id="show">
        <table id="tableshow">

        </table>
    </div>
</body>
<script>

</script>
</html>