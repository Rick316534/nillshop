<?php
    include_once("config.php");
    if (isset($_FILES["file"]["name"])) {
        $file = $_FILES["file"];
        $fileName = "../public/image/01.jpg";
        move_uploaded_file($file["tmp_name"],$fileName);
        
        echo "<img src = '".asset('image/01.jpg')."'>";
    } else {
        
    }