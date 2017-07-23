<?php
    $HOSTNAME='localhost';
    $USERNAME='root';
    $PASSWORD='123';
    $DATABASE='library';
    $link = mysqli_connect($HOSTNAME, $USERNAME, $PASSWORD, $DATABASE);
    if (!$link){
        echo "<script>alert('链接数据库时发生错误！')</script>";
    }else{

    }
?>