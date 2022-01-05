<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <title>Home</title>
</head>
<body>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
            選單<span class="caret"></span>
        </a>

        <ul class="dropdown-menu">
            <li>
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                    Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
        </ul>
    </li>
    <div>
        <div class="menu" style="display: flex;margin: 0 auto">
            <div>
                <ul id="user" style="margin: 50px">
                    帳號管理
                    <li style="">檢視帳號</li>
                </ul>
            </div>
            <div>
                <ul style="margin: 50px">
                    訂單管理
                </ul>
            </div>
            <div>
                <ul style="margin: 50px;text-align: center;border: black 1px solid ">
                    庫存管理
                    <li id='editProduct' style="padding: 9px; list-style-type:none">
                        <a href="storehouse">
                            編輯商品
                        </a>
                        
                    </li>
                    <li id='newProduct' style="padding: 9px; list-style-type:none">
                        <a href="{{ route('house.jump',['rout' => 'n']) }}">
                            新增商品
                        </a>
                    </li>
                </ul>
            </div>
            
            <div>
                <ul style="margin: 50px">退貨管理
                
                </ul>
            </div>
            
            
        </div>
    </div>
    <div class="show">

    </div>
</body>

</html>