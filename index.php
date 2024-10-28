<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>計算bmi</title>
<link rel="stylesheet" href="./style.css">
</head>
<body>
    <h1>計算bmi</h1>
    <ul>
        <li>建立一個可以輸入身高和體重的表單畫面</li>
        <li>按下"計算BMI"按鈕後，在另一個頁面顯示BMI值</li>
    </ul>
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


</body>
</html>