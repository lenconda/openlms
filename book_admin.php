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
        include "assets/sidebar.php";
    ?>

    <div class="col-md-10">
        <div class="row">
            <div class="page-header">
                <h1>图书管理</h1>
            </div>
            <div class="row gourpbtn" style="margin-left: 5px;">
                <a href="book_admin.php" class="btn btn-success">刷新</a>
                <button class="btn btn-primary" data-toggle="modal" data-target=".myModal1">添加图书</button>
            </div>
            <div></div><br/>
            <?php
                include "config/config_inc.php";
                mysqli_query($link,"set NAMES 'UTF8'");
                $books=mysqli_query($link,"select * from `lms_books`");
                echo "<br/><table class='table table-bordered table-striped table-hover'>";     //使用表格格式化数据
                echo "<tr><th>ID</th><th>名称</th><th>类型</th><th>作者</th><th>ISBN</th><th>出版商</th><th>价格</th><th>总字数</th><th>入库时间</th><th>借阅次数</th><th>操作</th></tr>";
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
                    echo "<td><div><form method='get' action='#'><button name='mod_book_id' class='btn btn-success' data-toggle='modal' data-target='.myModal2' value='{$books_row['id']}'>修改</button>&nbsp;&nbsp;<button name='del_book_id' class='btn btn-danger' data-toggle='modal' data-target='.myModal3' value='{$books_row['id']}'>删除</button></form></div></td>";
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
                            <option value="人物传记">人物传记</option>
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
                        <input name="bk_page" type="number" style="width: auto" class="form-control" placeholder="请输入图书总字数"><br/>
                        <div class="modal-footer"><input type="submit" class="btn btn-primary" name="add" value="确定"><button class="btn btn-default" data-dismiss="modal">取消</button></div><!--data-dismiss="modal"点击按钮之后可以关闭窗口-->
                    </form>
                    <?php
                        if (isset($_POST['add'])){
                            $intime_date=date("Y-m-d",time());
                            $add_book=mysqli_query($link,"INSERT INTO `lms_books` (`name`, `type`, `author`, `isbn`, `publisher`, `price`, `page`, `intime`, `borrow`) VALUES ('{$_POST['bk_name']}', '{$_POST['bk_type']}', '{$_POST['bk_author']}', '{$_POST['bk_isbn']}', '{$_POST['bk_publisher']}', '{$_POST['bk_price']}', '{$_POST['bk_page']}', '{$intime_date}', '0')");
                            if (!$add_book){
                                echo "<script>alert('添加图书失败')</script>";
                            }else{
                                echo "<script>alert('添加图书成功')</script>";
                                echo "<script>window.location.href='jump.php?jump=book_admin.php'</script>";
                            }
                        }
                    ?>
                </div><!--modal-body,弹出层主体区域-->
            </div>
        </div>
    </div>


    <div class="modal fade myModal2"><!--modal,弹出层父级,fade使弹出层有一个运动过程-->
        <div class="modal-dialog"><!--modal-dialog,弹出层-->
            <div class="modal-content"><!--modal-content,弹出层内容区域-->
                <div class="modal-header">
                    <button class="close" data-dismiss="modal">×</button><!--将关闭按钮放在标题前面可以使按钮位于右上角-->
                    <h4>修改图书信息</h4>
                </div><!--modal-header,弹出层头部区域-->
                <div class="modal-body">
                    <form method="post">
                        <?php
                            mysqli_query($link,"set NAMES 'UTF8'");
                            $book_info=mysqli_query($link,"select * from `lms_books` where `id`='{$_GET['mod_book_id']}' ");
                            $book_info_row=mysqli_fetch_array($book_info);
                            //计时函数，获取借书时间
                            $borrow_date=date("Y-m-d",time());
                            echo "<h5>图书ID:   ".$_GET['mod_book_id']."</h5><br/>";
                            echo "<form method='post'>";
                            echo "<label for='mod_name'>图书名称</label>";
                            echo "<input type='text' name='mod_name' id='mod_name' class='form-control' style='width: auto' value='{$book_info_row['name']}'><br/>";
                            echo "<label for='mod_type'>图书类别</label>";
                            echo "<select class='form-control' id='mod_type' style='width: auto' name='mod_type'><br/>";
                            echo "<br/><option value='经典著作'>经典著作</option>
                                    <option value='社会科学-政治法律'>社会科学-政治法律</option>
                                    <option value='军事科学-财经管理'>军事科学-财经管理</option>
                                    <option value='历史地理-文化教育'>历史地理-文化教育</option>
                                    <option value='小中教育-语言文字'>小中教育-语言文字</option>
                                    <option value='中外文学'>中外文学</option>
                                    <option value='人物传记'>人物传记</option>
                                    <option value='音乐-美术-雕塑'>音乐-美术-雕塑</option>
                                    <option value='书法艺术'>书法艺术</option>
                                    <option value='自然科学-医药卫生'>自然科学-医药卫生</option>
                                    <option value='农业科学-工业技术'>农业科学-工业技术</option>
                                    <option value='计算机'>计算机</option>
                                    <option value='建筑工程'>建筑工程</option>
                                    <option value='休闲娱乐'>休闲娱乐</option>
                                    <option value='少儿读物'>少儿读物</option>
                                    <option value='教材教辅'>教材教辅</option>        
                            </select><br/>";

                            echo "<br/><label for='mod_author'>图书作者/编者</label>";
                            echo "<br/><input type='text' name='mod_author' id='mod_author' class='form-control' style='width: auto' value='{$book_info_row['author']}'><br/>";
                            echo "<label for='mod_pub'>图书出版商</label>";
                            echo "<input type='text' name='mod_publisher' id='mod_pub' class='form-control' style='width: auto' value='{$book_info_row['publisher']}'><br/>";
                            echo "<label for='mod_isbn'>图书ISBN</label>";
                            echo "<input type='number' name='mod_isbn' id='mod_isbn' class='form-control' style='width: auto' value='{$book_info_row['isbn']}'><br/>";
                            echo "<label for='mod_price'>图书价格</label>";
                            echo "<input type='number' name='mod_price' id='mod_price' class='form-control' style='width: auto' value='{$book_info_row['price']}'><br/>";
                            echo "<label for='mod_page'>图书总字数</label>";
                            echo "<input type='number' name='mod_page' id='mod_page' class='form-control' style='width: auto' value='{$book_info_row['page']}'><br/>";
                            echo "<div class='modal-footer'><input type='submit' class='btn btn-primary' name='update' value='确定'><button class='btn btn-default' data-dismiss='modal'>取消</button></div>";
                            //echo "<br/><div><input type='submit' name='submit' class='btn btn-primary' value='确定'><a href='index.php' class='btn btn-danger'>取消</a></div></form>";
                            if (isset($_POST['update'])){
                                if ($_POST['mod_name'] == ''){
                                    echo "<script>alert('图书名称为空')</script>";
                                }elseif ($_POST['mod_author'] == ''){
                                    echo "<script>alert('作者名称为空')</script>";
                                }elseif ($_POST['mod_publisher'] == ''){
                                    echo "<script>alert('出版商为空')</script>";
                                }elseif ($_POST['mod_isbn'] == ''){
                                    echo "<script>alert('ISBN为空')</script>";
                                }elseif ($_POST['mod_price'] == ''){
                                    echo "<script>alert('图书价格为空')</script>";
                                }else{
                                    $update=mysqli_query($link,"update `lms_books` set `name`='{$_POST['mod_name']}',`type`='{$_POST['mod_type']}',`author`='{$_POST['mod_author']}',`isbn`='{$_POST['mod_isbn']}',`publisher`='{$_POST['mod_publisher']}',`price`='{$_POST['mod_price']}',`page`='{$_POST['mod_page']}' where `lms_books`.`id`='{$book_info_row['id']}'");
                                    if (!$update){
                                        echo "<script>alert('修改图书信息失败')</script>";
                                    }else{
                                        echo "<script>alert('修改图书信息成功')</script>";
                                        echo "<script>window.location.href='jump.php?jump=book_admin.php'</script>";
                                    }

                                }
                            }
                        ?>
                    </form>
                </div><!--modal-body,弹出层主体区域-->
            </div>
        </div>
    </div>

    <div class="modal fade myModal3"><!--modal,弹出层父级,fade使弹出层有一个运动过程-->
        <div class="modal-dialog"><!--modal-dialog,弹出层-->
            <div class="modal-content"><!--modal-content,弹出层内容区域-->
                <div class="modal-header">
                    <button class="close" data-dismiss="modal">×</button><!--将关闭按钮放在标题前面可以使按钮位于右上角-->
                    <h4>确认删除以下图书吗</h4>
                </div><!--modal-header,弹出层头部区域-->
                <div class="modal-body">
                    <form method="post">
                        <?php
                            $delete_info=mysqli_query($link,"select * from `lms_books` where `id`='{$_GET['del_book_id']}'");
                            $delete_info_row=mysqli_fetch_array($delete_info);
                            echo "<h5>图书ID：".$delete_info_row['id']."</h5>";
                            echo "<h5>图书名称：".$delete_info_row['name']."</h5>";
                            echo "<h5>出版商：".$delete_info_row['publisher']."</h5>";
                            echo "<h5>ISBN：".$delete_info_row['isbn']."</h5>";
                            echo "<br/><div class='modal-footer'><input name='delete_id' value='{$delete_info_row['id']}' type='hidden'><input type='submit' name='delete' class='btn btn-danger' value='确定'><button type='button' data-dismiss='modal' class='btn btn-default'>取消</button></div>"
                        ?>
                    </form>
                    <?php
                    if (isset($_POST['delete'])){
                        $del_alert=mysqli_query($link,"select * from `lms_books` where `id`='{$_POST['delete_id']}'");
                        $del_alert_row=mysqli_fetch_array($del_alert);
                        $del_book=mysqli_query($link,"DELETE FROM `lms_books` WHERE `lms_books`.`id` = '{$_POST['delete_id']}'");
                        if (!$del_book){
                            echo "<script>alert('".$del_alert_row['name']."已被成功删除')</script>";
                        }else{
                            echo "<script>alert('".$del_alert_row['name']."删除失败')</script>";
                            echo "<script>window.location.href='jump.php?jump=book_admin.php'</script>";
                        }
                    }
                    ?>
                </div><!--modal-body,弹出层主体区域-->
            </div>
        </div>
    </div>


</body>
<?php include "assets/footer.php";?>
</html>