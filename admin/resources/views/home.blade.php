@extends('layouts.app')

@section('content')
    <div>
        <div class="menu" style="display: flex;margin: 0 auto">
            <div>
                <ul id="user" style="margin: 50px;text-align: center;">
                    帳號管理
                    <li id='storeMember' style="padding: 9px; ">
                        <a href="{{ route('member.store') }}">
                            帳號管理
                        </a>
                        
                    </li>
                </ul>
            </div>
            <div>
                <ul style="margin: 50px">
                    訂單管理
                </ul>
            </div>
            <div>
                <ul style="margin: 50px;text-align: center;">
                    庫存管理
                    <li id='editProduct' style="padding: 9px; ">
                        <a href="{{ route('house.jump',['rout' => 'e']) }}">
                            編輯商品
                        </a>
                        
                    </li>
                    <li id='newProduct' style="padding: 9px; ">
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
@endsection