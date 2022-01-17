<
@if (count($datas) > 0)
    @foreach ($datas as $key => $data )
        <div id="{{ $data->id }}" style="border: 1px black solid;margin-right:1px;margin-bottom:1px;background-color:white;">
            <div style="display: flex;">
                <a href=""> <img style="height: 100px;width:100px" src="{{ $data->url }}" alt=""> </a> 
                <div style="width: 150px;height:120px">
                    <p>名稱：<br>{{ $data->name }}</p>
                    <p>價格：{{ $data->money }}</p>
                </div>
            </div>
            <div style="display:flex;justify-content:space-around;">
                <input type="button" name="" id="" value="直接購買">
                <input type="button" name="" id="" value="加入購物車">
            </div>
        </div>    
    @endforeach
@else
        <P>找不到商品</P>
@endif
        
