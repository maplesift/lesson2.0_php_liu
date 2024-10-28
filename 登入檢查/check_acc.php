<?php

$id=$_POST['id'];
$pass=$_POST['pass'];
if ($id== 'admin' && $pass=='1234') {
    echo '登入成功';
}else {
    echo '登入失敗';
}

?>