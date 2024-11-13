<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>萬年曆</title>
    <!-- <link rel="stylesheet" href="./style.css"> -->
    <link rel="icon" href="./test.ico" sizes="32x32" type="image/png">

</head>

<body>
    <?php
    if (isset($_GET['month'])) {
        $month = $_GET['month'];
    } else {
        $month = date("m"); //預設為今月
    }
    if (isset($_GET['year'])) {
        $year = $_GET['year'];
    } else {
        $year = date("Y"); //預設為今年
    }
    // 使用三元運算符 (? :) 判斷當月份是否為邊界值（即 1 或 12）。
    // 若 month 為 1，prevMonth 設為 12 並將 prevYear 減少一年；否則，prevMonth 直接減 1，prevYear 保持不變。
    // 同理，若 month 為 12，nextMonth 設為 1 並將 nextYear 增加一年；否則，nextMonth 增加 1，nextYear 保持不變。
    $prevMonth = ($month == 1) ? 12 : $month - 1;
    $prevYear = ($month == 1) ? $year - 1 : $year;
    $nextMonth = ($month == 12) ? 1 : $month + 1;
    $nextYear = ($month == 12) ? $year + 1 : $year;
    ?>
<div >
    <?php
    // DateTime::createFromFormat('Y-m', "{$year}-{$month}")：從指定的年份和月份字串中創建一個 DateTime 物件。
    // Y年n月：顯示年和月的數字格式，例如「2024年11月」。
    // F：DateTime 物件中的 F 參數會顯示月份的英文全名，例如「November」。
        $date = DateTime::createFromFormat('Y-m', "{$year}-{$month}");
        echo "<h1>{$date->format('Y年n月')} <br>{$date->format('F')}</h1>";
    ?>
</div>
    <?php
// 建立一個包含月份縮寫的陣列
$months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
?>
<div class="month-buttons">
    <?php 
    // 使用 foreach 迴圈遍歷每一個月份
    foreach ($months as $index => $monthName): 
        // 設定 $monthNum 為該月份的數字（因為 $index 從 0 開始，所以要加 1）
        $monthNum = $index + 1; 
    ?>
        <!-- 
            建立一個連結元素作為月份按鈕 
            若 $monthNum 等於當前顯示的月份 ($month)，則加入 'current-month' class 來上色 
        -->
        <a class="month-button <?php if ($monthNum == $month) echo 'current-month'; ?>" 
           href="calendar_coursework.php?year=<?= $year ?>&month=<?= $monthNum ?>">
           <!-- 顯示月份名稱，例如 'Jan', 'Feb' 等 -->
           <?= $monthName ?>
        </a>
    <?php endforeach; ?>
</div>


    <table>
        <tr>
            <!-- <td></td> -->
            <td>日</td>
            <td>一</td>
            <td>二</td>
            <td>三</td>
            <td>四</td>
            <td>五</td>
            <td>六</td>
        </tr>
        <?php

$firstDay = "{$year}-{$month}-1"; //顯示第一天
$firstDayTime = strtotime($firstDay);
$firstDayWeek = date("w", $firstDayTime);

        for ($i = 0; $i < 6; $i++) {
            echo "<tr>";
            // echo "<td>";
            // echo $i + 1;
            // echo "</td>";
            for ($j = 0; $j < 7; $j++) {
                $cell = $i * 7 + $j - $firstDayWeek; // 取得需要打印日曆的日期
                $theDayTime = strtotime("$cell days" . $firstDay);

                $theMonth=(date("m",$theDayTime)==date("m",$firstDayTime))?'thisMonth':'grey-text'; 
                $isToday = (date("Y-m-d", $theDayTime)==date("Y-m-d"))?'today':'';
                $w = date("w", $theDayTime);
                $isHoliday = ($w == 0 || $w == 6) ? 'holiday' : '';

                echo "<td class=' $theMonth $isToday $isHoliday'>"; //css樣式
                echo date("d", $theDayTime);
                echo "</td>";
            }
            echo "</tr>";
        }
        ?>

</table>
<div class="div_center div_a">
    <!-- 去年到明年按鈕*5 -->
<a  href="calendar_coursework.php?year=<?= $year - 1 ?>&month=<?= $month; ?>"><img src="./img/04.png" alt="" class="resized-image"></a>
<a  href="calendar_coursework.php?year=<?= $prevYear; ?>&month=<?= $prevMonth; ?>"><img src="./img/03.png" alt="" class="resized-image"></a>
<a  href="calendar_coursework.php?year=<?=date("Y"); ?>&month=<?=date("m"); ?>"><img src="./img/05.png" alt="" class="resized-image"></a>
<a  href="calendar_coursework.php?year=<?= $nextYear; ?>&month=<?= $nextMonth; ?>"><img src="./img/01.png" alt="" class="resized-image"></a>
<a  href="calendar_coursework.php?year=<?= $year + 1; ?>&month=<?= $month; ?>"><img src="./img/02.png" alt="" class="resized-image"></a>
</div>
    <form action="calendar_coursework.php" class="div_form div_center">
    <div>
        <div>
            <label for="year"></label>
            <input type="number" name="year" id="year" placeholder="YYYY" pattern="\d{4}" title="請輸入年份（YYYY）">年
            <label for="month"></label>
            <input type="number" name="month" id="month" placeholder="MM" pattern="\d{2}" title="請輸入月份（MM）">月
            <input type="submit" value="送出">
        </div>
    </div>
    </form>
<style>
    table {
    width: 50%;
    height: 50vh;
    border-collapse: collapse;
    margin: auto;

}

td {
    padding: 5px 10px;
    text-align: center;
    border: 1px solid #999;
}

.thisMonth {
    font-weight: bold;
}

.holiday {
    /* background: pink; */
    color: #ff0000;
    font-weight: bold;

}

.grey-text {
    color: #999;
    font-weight: lighter;
}

.today {
    background: blue;
    color: white;
    font-weight: bolder;
}

.outside {
    width: 100%;
    height: 80vh;
    font-size: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.date_font {
    font-size: 48px;
}

.div_center {
    margin: auto;
    text-align: center;
    /* background-color: skyblue; */
}

.resized-image {
    width: 50px;
    /* 固定寬度 */
    height: auto;
    /* 高度自動調整，保持比例 */
    position: relative;
}


.div_date {
    margin: auto;
    text-align: center;
}

.month-buttons {
    display: flex;
    justify-content: center;
    gap: 10px;
    color: #ff0000;
    margin-bottom: 10px;
}

.month-button {
    padding: 5px 10px;
    text-decoration: none;
    color: black;
}

.current-month {
    background-color: #FFD700;
    /* Gold color for current month */
    font-weight: bold;
    color: white;
}


* {
    box-sizing: border-box;
}

.boxspece {
    width: 98vw;
    height: 5vh;
}

.box {
    display: flex;
    justify-content: center;
    width: 100vw;
    height: 10vh;
    font-size: 32px;
}

.box1 {
    width: 50vw;
    height: 10vh;
    background-color: #ff3434;
    font-size: 32px;

}

.boxMonth {
    display: flex;
    justify-content: start;
    width: 100vw;
    height: 1vh;
    font-size: 32px;
}


.box2 {
    width: 20vw;
    height: 74vh;
    background-color: #aeff00;
    font-size: 32px;
    position: absolute;
    top: 10%;
}

.boxCalendar {
    display: flex;
    justify-content: center;
    width: 100vw;
    height: 50vh;
    font-size: 32px;
    margin-bottom: 10px;

}

.box3 {
    width: 48vw;
    height: 50vh;
    background-color: #799838;
    font-size: 32px;
}

.boxFunction {
    display: flex;
    justify-content: center;
    width: 100vw;
    height: 50vh;
    position: relative;
    font-size: 32px;
}

.box4 {
    width: 55vw;
    height: 18vh;
    background-color: #4fc677;
    font-size: 32px;
}

.box5 {
    width: 17vw;
    height: 10vh;
    background-color: #00ff62;
    font-size: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    position: absolute;
    right: 5%;
    bottom: 70%;
}

</style>
</body>

</html>