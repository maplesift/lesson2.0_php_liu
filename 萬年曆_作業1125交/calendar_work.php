<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>萬年曆</title>
    <style>
    table{
        border-collapse:collapse;

    }
    td{
        padding:5px 10px;
        text-align: center;
        border:1px solid #999;
    }
    .holiday{
        background:pink;
        color:#999;
    }
    .grey-text{
        color:#999;
    }
    .today{
        background:blue;
        color:white;
        font-weight:bolder;
    }
    .dates { 
  -ms-overflow-style: none; 
  scrollbar-width: none;
  position: relative;
  overflow-y: auto;
  overflow-x: hidden;
}
.dates::-webkit-scrollbar {
  display: none;
}
.dates .col {
  border-bottom: 1px solid rgba(255,255,255,.2);
}
</style>
</head>
<body>
    <?php
    if(isset($_GET['month'])){
        $month=$_GET['month'];
    }else{
        $month=date("m"); //預設為今月
    }
    if(isset($_GET['year'])){
        $year=$_GET['year'];
    }else{
        $year=date("Y"); //預設為今年
    }

    // 使用三元運算符 (? :) 判斷當月份是否為邊界值（即 1 或 12）。
    // 若 month 為 1，prevMonth 設為 12 並將 prevYear 減少一年；否則，prevMonth 直接減 1，prevYear 保持不變。
    // 同理，若 month 為 12，nextMonth 設為 1 並將 nextYear 增加一年；否則，nextMonth 增加 1，nextYear 保持不變。
    $prevMonth = ($month == 1) ? 12 : $month - 1; 
    $prevYear = ($month == 1) ? $year - 1 : $year;

    $nextMonth = ($month == 12) ? 1 : $month + 1;
    $nextYear = ($month == 12) ? $year + 1 : $year;
    
    // 另一種寫法
    // if ($month-1<1) {
    //     $prevMonth=12;
    //     $prevYear=$year-1;
    // }else {
    //     $prevMonth=$month-1;
    //     $prevYear=$year;
    // }
    // if ($month+1>12) {
    //     $nextMonth=1;
    //     $nextYear=$year+1;
    // }else {
    //     $nextMonth=$month+1;
    //     $nextYear=$year;
    // }
    ?>
    <h1>萬年曆</h1>
    <h1>
        設計一個網頁版萬年曆，只需顯示西元年月日
    </h1>
<ul>
    <li>以月為單位來顯示一個月中的日期</li> 
    <li>有上一個月，下一個月的連結來切換月份</li>
    <li>有前年跟來年的按鈕</li>
</ul>
<a href="">前年</a>
<a href="calendar.php ?year=<?=$prevYear;?>&month=<?=$prevMonth;?>">上一個月</a>
<a href="calendar.php ?year=<?=$nextYear;?>&month=<?=$nextMonth;?>">下一個月</a>
<a href="">明年</a>
<h3><?php echo date("{$year}年{$month}月"); ?></h3>
    <table>
<tr>
    <td></td>
    <td>日</td>
    <td>一</td>
    <td>二</td>
    <td>三</td>
    <td>四</td>
    <td>五</td>
    <td>六</td>
</tr>
<?php 
//用時間戳date函數做月曆

$firstDay="{$year}-{$month}-1"; //顯示第一天
// echo $firstDay;
$firstDayTime=strtotime($firstDay);
$firstDayWeek=date("w",$firstDayTime);
for($i=0;$i<6;$i++){
    echo "<tr>";
    echo "<td>";
    echo $i+1;
    echo "</td>";
    for($j=0;$j<7;$j++){
        //echo "<td class='holiday'>";
        $cell=$i*7+$j -$firstDayWeek; // 取得需要打印日曆的日期
        $theDayTime=strtotime("$cell days".$firstDay); 
        // 把$cell得到的日期(天)加上$firstDay 讓函數strtotime運算 取得"時間戳"

        //所需樣式css判斷
        $theMonth=(date("m",$theDayTime)==date("m"))?'':'grey-text'; //
        
        // ? 和 : 是三元運算符的語法，這是一種簡化的 if-else 語句。
        // =if (date("m", $theDayTime) == date("m")) {
            // $theMonth = '';
        // } else {
        //     $theMonth = 'grey-text';
        // }
        //css樣式
        $isToday=(date("Y-m-d",$theDayTime)==date("Y-m-d"))?'today':''; 
        $w=date("w",$theDayTime);
        $isHoliday=($w==0 || $w==6)?'holiday':'';
        
        echo '<div class="dates">';
        echo "<td class='$isHoliday $theMonth $isToday col'>";//css樣式
        echo '<span>' . date("d", $theDayTime) . '</span>';
        echo "</td>";
        echo '</div>';
    }
    echo "</tr>";
}
?>
</table>
</body>
</html>