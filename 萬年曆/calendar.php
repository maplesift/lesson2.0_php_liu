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
</style>
</head>
<body>
    <?php
    if(isset($_GET['month'])){
        $month=$_GET['month'];
    }else{
        $month=date("m");
    }
    if(isset($_GET['year'])){
        $year=$_GET['year'];
    }else{
        $year=date("Y");
    }
    if ($month-1<1) {
        $prevMonth=12;
        $prevYear=$year-1;
    }else {
        $prevMonth=$month-1;
        $prevYear=$year;
    }
    if ($month+1>12) {
        $nextMonth=1;
        $nextYear=$year+1;
    }else {
        $nextMonth=$month+1;
        $nextYear=$year;
    }
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
<a href="?month=<?=$month-1;?>">上一個月</a>
<a href="?month=<?=$month+1;?>">下一個月</a>
<a href="">明年</a>
<h3><?php echo date("{$month}月"); ?></h3>
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

$firstDay="2024-{$month}-1";
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
        $isToday=(date("Y-m-d",$theDayTime)==date("Y-m-d"))?'today':''; // 
        $w=date("w",$theDayTime);
        $isHoliday=($w==0 || $w==6)?'holiday':'';
        
        echo "<td class='$isHoliday $theMonth $isToday'>";
        echo date("d",$theDayTime); //將時間戳丟進date函數運算 取得日曆天數 d=月份中的第几天，有补零的两位数字	01 到 31
        echo "</td>";
    }
    echo "</tr>";
}
?>
</table>
</body>
</html>