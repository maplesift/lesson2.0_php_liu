<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>萬年曆</title>
    <link rel="stylesheet" href="./style.css">

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
    <div class="div_button">
        <button>
            <a href="">去年</a>
        </button>
        <button >
            <a href="calendar_work.php ?year=<?= $prevYear; ?>&month=<?= $prevMonth; ?>">上一個月</a>
        </button>
        <button>
            <a href="calendar_work.php ?year=<?= $nextYear; ?>&month=<?= $nextMonth; ?>">下一個月</a>
        </button>
        <button>
            <a href="">明年</a>
        </button>
    </div>
    <div class="div_date">
        <h3><?php echo date("{$year}年{$month}月"); ?></h3>

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
            // echo "<tr>";
            // echo "<td>";
            // echo $i + 1;
            // echo "</td>";
            for ($j = 0; $j < 7; $j++) {
                $cell = $i * 7 + $j - $firstDayWeek; // 取得需要打印日曆的日期
                $theDayTime = strtotime("$cell days" . $firstDay);

                $theMonth = (date("m", $theDayTime) == date("m")) ? '' : 'grey-text'; //


                $isToday = (date("Y-m-d", $theDayTime) == date("Y-m-d")) ? 'today' : '';
                $w = date("w", $theDayTime);
                $isHoliday = ($w == 0 || $w == 6) ? 'holiday' : '';

                echo "<td class='$isHoliday $theMonth $isToday'>"; //css樣式
                echo date("d", $theDayTime);
                echo "</td>";
            }
            echo "</tr>";
        }
        ?>
    </table>

</body>

</html>