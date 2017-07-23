<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="bootstrap/bootstrap.css">
    <link href="css/component.css" type="text/css" rel="stylesheet">
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
    <title>图书管理系统</title>
    <?php
        include "config/config_inc.php";
    ?>
  </head>
  <body>
        <?php
            include "assets/head.php";
            include "assets/sidebar.php";
        ?>

        <div class="col-md-10">
            <div class="row">
                <?php
                    include "config/config_inc.php";
                    mysqli_query($link,"set NAMES 'UTF8'");
                    $books=mysqli_query($link,"select * from `lms_books`");
                    echo "<br/><table class='table'>";     //使用表格格式化数据
                    echo "<tr><th>ID</th><th>名称</th><th>类型</th><th>作者</th><th>ISBN</th><th>出版商</th><th>价格</th><th>页数</th><th>入库时间</th><th>借阅次数</th><th>操作</th></tr>";
                    while ($books_row=mysqli_fetch_array($books)){
                        echo "<tr>";
                        echo "<td>".$books_row['id']."</td>";
                        echo "<td>".$books_row['name']."</td>";
                        echo "<td>".$books_row['type']."</td>";
                        echo "<td>".$books_row['author']."</td>";
                        echo "<td>".$books_row['isbn']."</td>";
                        echo "<td>".$books_row['publisher']."</td>";
                        echo "<td>".$books_row['price']."</td>";
                        echo "<td>".$books_row['page']."</td>";
                        echo "<td>".$books_row['intime']."</td>";
                        echo "<td>".$books_row['borrow']."</td>";
                        echo "<td><form method='get' action='borrow.php'><button class='btn btn-primary' type='submit' name='book_id' value='{$books_row['id']}'>借出</button></td>";
                        echo "</tr>";
                    }

                ?>



                <!--<form action="borrow.php" method="get" target="_blank"><button class="btn btn-danger" type="submit">借出</button></form>-->
                <script src="js/classie.js"></script>
                <script src="js/modalEffects.js"></script>
            </div>
        </div>


  </body>
</html>