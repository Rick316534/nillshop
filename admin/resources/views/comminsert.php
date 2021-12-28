<?php
    include_once("config.php");
    if($link){
        echo "成功";
    }else{
        echo "連線錯誤！";
    }
    mysqli_close($link);