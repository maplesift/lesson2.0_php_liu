<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bmi結果</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <?php
    if(isset($_GET['height'])){
        $height=$_GET['height'];
    }elseif (isset($_POST['height'])) {
        $height=$_POST['height'];
        
    }else {
        echo "請使用正確管道";
        exit();
    }
    if(isset($_GET['weight'])){
        $weight=$_GET['weight'];
    }elseif (isset($_POST['weight'])) {
        $weight=$_POST['weight'];
        
    }else {
        echo "請使用正確管道";
        exit();
    }
    

    ?>
    <h1>bmi結果</h1>
    <div>您的身高:<?=$height;?>公分</div>
    <div>您的體重:<?=$weight;?>公斤</div>

    <?php
    $h=$height /100;

    $bmi=round($weight/($h * $h),2);

    if ($bmi<18.5) {
            $level= "過輕";
        }elseif ($bmi<24) {
            $level="正常範圍";
        }elseif ($bmi<27) {
            $level="過重";
        }elseif ($bmi<30) {
            $level="輕度肥胖" ;
        }elseif ($bmi<35) {
            $level="中度肥胖" ;
        }elseif ($bmi>=35) {
            $level="重度肥胖";
        }
    ?>
    <div>你的bmi為:<?=$bmi; ?></div>
    <div>體位判定為:<?=$level; ?></div>
    <div>
        <a href="bmi.php?bmi=<?=$bmi?>">重新量測</a>
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
<!-- 自己寫
 <?php 
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
?> -->
</body>
</html>