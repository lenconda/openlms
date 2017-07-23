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
            <div><input type="submit" class="btn btn-success" value="刷新" name="refresh"><button class="btn btn-primary" data-toggle="modal" data-target=".myModal1">添加图书</button></div><br/>
            <?php
                session_start();
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
                    echo "<td><form method='post'><input type='hidden' value='{$books_row['id']}' name='book_id'><input type='submit' class='btn btn-danger' name='delete' value='删除'></td>";
                    echo "</tr>";
                }
                if (isset($_POST['delete'])){
                    $delete=mysqli_query($link,"delete from `lms_books` where `lms_books`.`id`='{$_POST['book_id']}'");
                    if (!$delete){
                        echo "<script>alert('删除图书失败')</script>";
                    }else{
                        echo "<script>alert('删除图书成功')</script>";
                        echo "<script>window.location.href='index.php'</script>";
                    }
                }

            ?>
        </div>
    </div>
    <div class="modal fade myModal1"><!--modal,弹出层父级,fade使弹出层有一个运动过程-->
        <div class="modal-dialog"><!--modal-dialog,弹出层-->
            <div class="modal-content"><!--modal-content,弹出层内容区域-->
                <div class="modal-header">
                    <button class="close" data-dismiss="modal">×</button><!--将关闭按钮放在标题前面可以使按钮位于右上角-->
                    <h4>添加新的图书</h4>
                </div><!--modal-header,弹出层头部区域-->
                <div class="modal-body">
                    <form method="post">
                        <input name="bk_name" type="text" style="width: auto" class="form-control" placeholder="请输入图书全名"><br/>
                        <select class="form-control" style="width: auto" name="bk_type">
                            <option value="经典著作">经典著作</option>
                            <option value="社会科学-政治法律">社会科学-政治法律</option>
                            <option value="军事科学-财经管理">军事科学-财经管理</option>
                            <option value="历史地理-文化教育">历史地理-文化教育</option>
                            <option value="小中教育-语言文字">小中教育-语言文字</option>
                            <option value="中外文学">中外文学</option>
                            <option value="音乐-美术-雕塑">音乐-美术-雕塑</option>
                            <option value="书法艺术">书法艺术</option>
                            <option value="自然科学-医药卫生">自然科学-医药卫生</option>
                            <option value="农业科学-工业技术">农业科学-工业技术</option>
                            <option value="计算机">计算机</option>
                            <option value="建筑工程">建筑工程</option>
                            <option value="休闲娱乐">休闲娱乐</option>
                            <option value="少儿读物">少儿读物</option>
                            <option value="教材教辅">教材教辅</option>
                        </select><br/>
                        <input name="bk_author" type="text" style="width: auto" class="form-control" placeholder="请输入图书作者"><br/>
                        <input name="bk_isbn" type="number" style="width: auto" class="form-control" placeholder="请输入图书的ISBN"><br/>
                        <input name="bk_publisher" type="text" style="width: auto" class="form-control" placeholder="请输入出版社全名"><br/>
                        <input name="bk_price" type="number" style="width: auto" class="form-control" placeholder="请输入图书单价"><br/>
                        <input name="bk_page" type="number" style="width: auto" class="form-control" placeholder="请输入图书总页数"><br/>
                        <div><input type="submit" class="btn btn-success" name="add" value="确定"><button class="btn btn-primary" data-dismiss="modal">取消</button></div><!--data-dismiss="modal"点击按钮之后可以关闭窗口-->
                    </form>
                    <?php
                        if (isset($_POST['add'])){
                            $intime_date=date("y-m-d",time());
                            $add_book=mysqli_query($link,"INSERT INTO `lms_books` (`name`, `type`, `author`, `isbn`, `publisher`, `price`, `page`, `intime`, `borrow`) VALUES ('{$_POST['bk_name']}', '{$_POST['bk_type']}', '{$_POST['bk_author']}', '{$_POST['bk_isbn']}', '{$_POST['bk_publisher']}', '{$_POST['bk_price']}', '{$_POST['bk_page']}', '{$intime_date}', '0')");
                            if (!$add_book){
                                echo "<script>alert('添加图书失败')</script>";
                            }else{
                                echo "<script>alert('添加图书成功')</script>";
                                echo "<script>window.location.href='index.php'</script>";
                            }
                        }
                    ?>
                </div><!--modal-body,弹出层主体区域-->
            </div>
        </div>
    </div>

</body>
</html>