<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>資料庫連線</title>
    <style>
        td{
            /* width: 30px;
            height: 30px; */
            /* background-color:red; */
            border: 1px solid black;
        }
    </style>
</head>
<body>
    <h1>資料庫連線</h1>
    <?php
    $dsn= "mysql:host=localhost;charset=utf8;dbname=school";
    $pdo= new PDO($dsn,'root','');
    $sql="select * from classes";
    $rows= $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    ?>


<?php

foreach ($rows as $row) {
    ?>
    <table>
        <tr>
            <td>序號</td>
            <td>班級名稱</td>
            <td>班導師</td>
        </tr>
        <tr>
            <td><?=$row['id'];?></td>
            <td><?=$row['name'];?></td>
            <td><?=$row['tutor'];?></td>
        </tr>
    </table>
    <?php
}
    ?>
    <!-- // echo "<table>"."<td>"."<tr>".$row['id']."-".$row['name']."-".$row['tutor']."</tr>"."</td>"."<br>"."</table>";
    // echo "<pre>";
    // print_r($rows);
    // echo "</pre>" -->


</body>
</html>