<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bmi結果</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <h1>bmi結果</h1>
    <div>您的身高:<?=$_GET['height'];?>公分</div>
    <div>您的體重:<?=$_GET['weight'];?>公斤</div>
    <?php
    $h=$_GET['height'] /100;

    $bmi=round($_GET['weight']/($h * $h),2);
    ?>
    <div>你的bmi為:<?=$bmi?></div>
    <div>體位判定為:<?php
if ($bmi<18.5) {
    echo '過輕';
    }elseif ($bmi<24) {
        echo '正常範圍';
    }elseif ($bmi<27) {
        echo '過重';
    }elseif ($bmi<30) {
        echo '輕度肥胖' ;
    }elseif ($bmi<35) {
        echo '中度肥胖' ;
    }elseif ($bmi>=35) {
        echo '重度肥胖';
    }

?></div>
    <div>
        <a href="index.php">重新量測</a>
    </div>
    <div></div>
    
    <!-- 
    體重過輕
BMI ＜ 18.5
-

正常範圍
18.5≦BMI＜24
-

異常範圍
　　過重：24≦BMI＜27
輕度肥胖：27≦BMI＜30
中度肥胖：30≦BMI＜35
重度肥胖：BMI≧35 -->
</body>
</html>