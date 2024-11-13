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
    // $sql="select * from students";
    $sql = "SELECT * FROM students LIMIT 50";  // 增加 LIMIT 50 限制行數
    $rows= $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    ?>
<?php
foreach ($rows as $row){

    echo $row['id']."-學號:".$row['uni_id']."-".$row['name']."<br>";
}
 
?> 
<!-- $row['id']."-".$row['name']."-".$row['tutor'] -->
</body>
</html>