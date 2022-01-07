@extends('layouts.app')

@section('content')
<div class="container" style="display: flex;justify-content: space-between;padding: 0;">
    <ul style="list-style-type: none;padding: 0 5px;margin:0 auto ;text-align: center"> 
        <li type="button" id="edit" style="padding:10px;">編輯資料</li>
        <li type="button" id="更改密碼" style="padding:10px;"></li>
        <li type="button" id="訂單查詢" style="padding:10px;"></li>
        <li type="button" id="退貨紀錄" style="padding:10px;"></li>
    </ul>
    <div class="row show" style="width: 70%">
        123
    </div>
</div>
<script>
    window.onload = () => {
        let edit = document.getElementById("edit");
        edit.addEventListener('click', function(){
        console.log(this);
    });
    }
    
    
</script>
@endsection
