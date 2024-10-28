<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登入檢查</title>
    <link rel="stylesheet" href="../style.css">
     <!-- <style>
        div{
            margin: 30px;
        }
     </style> -->
</head>
<body>
    <form action="check_acc.php" method="post">
        <div>
            <label for="id">帳號:</label>
            <input type="text" name="id"  id="id">
        </div>
        <div>
            <label for="pass">密碼:</label>
            <input type="password" name="pass" id="pass">
        </div>
        <div>
            <input type="submit" value="登入">
        </div>
        <div>
            <input type="reset" value="清空/重置">
        </div>
    </form>
</body>
</html>