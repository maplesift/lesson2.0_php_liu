<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>計算bmi</title>
<link rel="stylesheet" href="../style.css">
</head>
<body>
    <div>
        <a href="../index.html">回首頁</a>
    </div>
        <?php 
        if(isset($_GET['bmi'])){
            echo "你上一次量測的BMI為{$_GET['bmi']}";
        }
        ?>
    
    <h1>計算bmi-get</h1>


    <form action="result.php" method="get">
        <div>
            <label for="height">身高</label>
            <input type="number" name="height" id="height">/cm
        </div>
        <div>
            <label for="weight">體重</label>
            <input type="number" name="weight" id="weight">/kg
        </div>
        <div>
            <input type="submit" value="送出">
        </div>
        <div>
            <input type="reset" value="清空/重置">
        </div>
    </form>

    <h1>計算bmi-post</h1>
    
    <form action="result.php" method="post">
        <div>
            <label for="height">身高</label>
            <input type="number" name="height" id="height">/cm
        </div>
        <div>
            <label for="weight">體重</label>
            <input type="number" name="weight" id="weight">/kg
        </div>
        <div>
            <input type="submit" value="送出">
        </div>
        <div>
            <input type="reset" value="清空/重置">
        </div>
    </form>

</body>
</html>