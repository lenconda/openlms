<!--
Copyright (c) 2017 Peng Hanlin.
The software is published under the Apache License v2.0.
Authorized by Peng Hanlin in Nanchang, China.
Monday, 11, September, 2017
-->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="bootstrap/bootstrap.css">
    <link href="css/bootstrap-datetimepicker.css" type="text/css" rel="stylesheet">
    <link href="css/component.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css" type="text/css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <script src="js/jquery-1.9.1.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap-datetimepicker.js"></script>
    <link rel="stylesheet" href="css/main.css" type="text/css"/>
    <title>图书管理系统</title>
    <?php
        include "config/config_inc.php";
        session_start();
        if ($_SESSION['Admin'] == '1'){
            echo "<script>window.location.href='profile/index.php'</script>";
        }elseif ($_SESSION['Admin'] == '0'){

        }else{
            echo "<script>window.location.href='login.php'</script>";
        }

    ?>
</head>
<body>
    <?php
        include "assets/head.php";
    ?>
    <div class="container-fluid">
        <div class="row">
            <?php
            include "assets/sidebar.php";
            ?>
            <div class="col-md-10 col-md-offset-2">
                <div class="page-header">
                    <h1>图书归还记录</h1>
                </div>
                    <?php
                    include "config/config_inc.php";
                    mysqli_query($link,"set NAMES 'UTF8'");
                    $books=mysqli_query($link,"select * from `lms_borrow` where `if_return`='0' or `if_return` = '2'");
                    echo "<br/><table class='table table-bordered table-striped table-hover'>";     //使用表格格式化数据
                    echo "<tr><th>借阅单号</th><th>图书名称</th><th>ISBN</th><th>出版商</th><th>借阅人姓名</th><th>身份证号</th><th>借阅时间</th><th>归还时间</th></tr>";
                    while ($books_borrowed=mysqli_fetch_array($books)){
                        echo "<tr>";
                        echo "<td>".$books_borrowed['id']."</td>";
                        echo "<td>".$books_borrowed['book_name']."</td>";
                        echo "<td>".$books_borrowed['book_isbn']."</td>";
                        echo "<td>".$books_borrowed['book_publisher']."</td>";
                        echo "<td>".$books_borrowed['stu_name']."</td>";
                        echo "<td>".$books_borrowed['stu_id']."</td>";
                        echo "<td>".$books_borrowed['borrow_time']."</td>";
                        echo "<td>".$books_borrowed['return_time']."</td>";
                        echo "</tr>";
                    }
                    ?>
                    <!--<form action="borrow.php" method="get" target="_blank"><button class="btn btn-danger" type="submit">借出</button></form>-->
                    <script src="js/classie.js"></script>
                    <script src="js/modalEffects.js"></script>
            </div>

        </div>
    </div>
</body>
</html>