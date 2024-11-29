<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>萬年曆</title>
    <!-- <link rel="stylesheet" href="./style.css"> -->
    <link rel="icon" href="./test.ico" sizes="32x32" type="image/png">
    <link
        href="https://fonts.googleapis.com/css2?family=Delius&family=Sixtyfour+Convergence&family=Sour+Gummy:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
        <?php
$month = filter_input(INPUT_GET, 'month', FILTER_VALIDATE_INT) ?: date('n'); // 預設為當前月份
if (in_array($month, [12, 1, 2])) {
    $seasonClass = "winter";
} elseif (in_array($month, [3, 4, 5])) {
    $seasonClass = "spring";
} elseif (in_array($month, [6, 7, 8])) {
    $seasonClass = "summer";
} else {
    $seasonClass = "autumn";
}
?>
</head>

<body class="<?php echo $seasonClass; ?>">
    <div class="space">

    </div>
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
        <a href="calendar_coursework.php?year=<?= $year - 1 ?>&month=<?= $month; ?>"><img src="./img/04.png" alt=""
                class="resized-image"></a>
        <a href="calendar_coursework.php?year=<?= $prevYear; ?>&month=<?= $prevMonth; ?>"><img src="./img/03.png" alt=""
                class="resized-image"></a>
        <a href="calendar_coursework.php?year=<?=date(" Y"); ?>&month=
            <?=date("m"); ?>"><img src="./img/05.png" alt="" class="resized-image">
        </a>
        <a href="calendar_coursework.php?year=<?= $nextYear; ?>&month=<?= $nextMonth; ?>"><img src="./img/01.png" alt=""
                class="resized-image"></a>
        <a href="calendar_coursework.php?year=<?= $year + 1; ?>&month=<?= $month; ?>"><img src="./img/02.png" alt=""
                class="resized-image"></a>
    </div>
    <form action="calendar_coursework.php" class="div_form div_center">
        <div>
            <div>
                <label for="year"></label>
                <input type="number" name="year" id="year" placeholder="YYYY" pattern="\d{4}" title="請輸入年份（YYYY）">年
                <label for="month"></label>
                <input type="number" name="month" id="month" placeholder="MM" pattern="\d{2}" title="請輸入月份（MM）">月
                <input type="submit" value="search">
            </div>
            <div>
            </div>
        </div>
    </form>
    <div class="date_font">
        <?php
    // DateTime::createFromFormat('Y-m', "{$year}-{$month}")：從指定的年份和月份字串中創建一個 DateTime 物件。
    // Y年n月：顯示年和月的數字格式，例如「2024年11月」。
    // F：DateTime 物件中的 F 參數會顯示月份的英文全名，例如「November」。
        $date = DateTime::createFromFormat('Y-m', "{$year}-{$month}");
        echo "<h1>{$date->format('Y年n月')} <br>{$date->format('F')}</h1>";
    ?>
    </div>
    <style>
        * {
            font-family: "Sour Gummy", serif;
            font-weight: bold;
            box-sizing: border-box;
        }

        body.winter {
            background-color: #f4fcffb3;
        }

        body.spring {
            background-color: #f2fff2;
        }

        body.summer {
            background-color: #fffbe4;
        }

        body.autumn {
            background-color: #fff3ee;
        }



        .date_font {

            font-size: 26px;
            float: left;
            position: absolute;
            left: 5%;
            top: 17%;
        }

        .space {
            width: 100%;
            height: 40px;
        }

        table {
            width: 50%;
            height: 50vh;
            border-collapse: collapse;
            margin: auto;
        }

        .radius {
            border-radius: 7px;
        }

        td {
            width: 60px;
            height: 60px;
            padding: 5px 10px;
            text-align: center;
            border: 1px solid #999;
            /* background-color: white; */

        }

        td:hover {
            background-color: skyblue;
            transition: 0.7s;
        }

        form {
            width: 400px;
            margin: 20px auto;
            padding: 20px;
            /* border: 1px solid #ccc; */
            border-radius: 10px;
        }

        form label {
            display: inline-block;
            width: 45px;
            text-align-last: justify;

        }

        form input[type=text],
        form input[type=password],
        form input[type=number] {
            padding: 5px;
            font-size: 20px;
            border: 0px;
            border-bottom: 1px solid #ccc;
            margin: 3px;
        }

        form input[type=submit],
        form input[type=reset] {
            padding: 5px 10px;
            font-size: 14px;
            background-color: rgb(0, 255, 17);
            border-radius: 5px;
            margin: 10px 10px;
            border: 1px solid #eee;
            cursor: pointer;

        }

        form input[type=submit]:hover {
            padding: 7px 12px;
            background-color: rgb(0, 255, 229);
            transition: 0.7s;
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
            border-radius: 13px;
        }
    </style>
</body>

</html>