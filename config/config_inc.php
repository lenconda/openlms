<!--
Copyright (c) 2017 Peng Hanlin.
The software is published under the Apache License v2.0.
Authorized by Peng Hanlin in Nanchang, China.
Monday, 11, September, 2017
-->
<?php
    $HOSTNAME='localhost';
    $USERNAME='root';
    $PASSWORD='123';
    $DATABASE='library';
    $link = mysqli_connect($HOSTNAME, $USERNAME, $PASSWORD, $DATABASE);
    if (!$link){
        echo "<script>alert('链接数据库时发生错误！')</script>";
    }else{}