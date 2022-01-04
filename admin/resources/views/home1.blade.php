@extends('layouts.app')

@section('content')
<div class="container">
    <div>
        <ul class="menu">
            <li id="user">帳號管理</li>
            <li><a href="">訂單管理</a></li>
            <li><a href="">庫存管理</a></li>
            <li><a href="">退貨管理</a></li>
        </ul>
    </div>
    @if (session('status'))
        
    @endif
</div>
<script >
    document.getElementById("user").addEventListener('click',function(){
    this.style.color='red';
    console.log("123");
    });
    console.log(document.getElementById("user"));
</script>
@endsection

