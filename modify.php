<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="bootstrap/bootstrap.css">
    <link href="css/bootstrap-datetimepicker.css" type="text/css" rel="stylesheet">
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
    <script src="js/bootstrap-datetimepicker.js"></script>
    <title>修改图书信息</title>
    <?php
        session_start();
        include "config/config_inc.php";
    ?>
</head>
<body>
    <?php
        include "assets/head.php";
    ?>
    <div class="col-md-10">
        <div class="row">
            <div class="panel">
                <div align="center">
                    <form method="post">
                        <?php
                            mysqli_query($link,"set NAMES 'UTF8'");
                            $book_info=mysqli_query($link,"select * from `lms_books` where `id`='{$_GET['book_id']}' ");
                            $book_info_row=mysqli_fetch_array($book_info);
                            //计时函数，获取借书时间
                            $borrow_date=date("Y-m-d",time());
                            echo "<h5>".$_GET['book_id']."</h5><br/>";
                            echo "<form method='post'><input type='text' name='mod_name' class='form-control' style='width: auto' value='{$book_info_row['name']}'><br/>";
                            echo "<select class=\"form-control\" style=\"width: auto\" name=\"mod_type\"><br/>";
                            echo "<br/><option value=\"经典著作\">经典著作</option>
                                <option value=\"社会科学-政治法律\">社会科学-政治法律</option>
                                <option value=\"军事科学-财经管理\">军事科学-财经管理</option>
                                <option value=\"历史地理-文化教育\">历史地理-文化教育</option>
                                <option value=\"小中教育-语言文字\">小中教育-语言文字</option>
                                <option value=\"中外文学\">中外文学</option>
                                <option value=\"音乐-美术-雕塑\">音乐-美术-雕塑</option>
                                <option value=\"书法艺术\">书法艺术</option>
                                <option value=\"自然科学-医药卫生\">自然科学-医药卫生</option>
                                <option value=\"农业科学-工业技术\">农业科学-工业技术</option>
                                <option value=\"计算机\">计算机</option>
                                <option value=\"建筑工程\">建筑工程</option>
                                <option value=\"休闲娱乐\">休闲娱乐</option>
                                <option value=\"少儿读物\">少儿读物</option>
                                <option value=\"教材教辅\">教材教辅</option>";
                            echo "</sclect><br/>";
                            echo "<br/>";
                            echo "<br/><input type='text' name='mod_author' class='form-control' style='width: auto' value='{$book_info_row['author']}'><br/>";
                            echo "<input type='text' name='mod_publisher' class='form-control' style='width: auto' value='{$book_info_row['publisher']}'><br/>";
                            echo "<input type='number' name='mod_isbn' class='form-control' style='width: auto' value='{$book_info_row['isbn']}'><br/>";
                            echo "<input type='number' name='mod_price' class='form-control' style='width: auto' value='{$book_info_row['price']}'><br/>";
                            echo "<input type='number' name='mod_page' class='form-control' style='width: auto' value='{$book_info_row['page']}'><br/>";

                            echo "<br/><div><input type='submit' name='submit' class='btn btn-primary' value='确定'><a href='index.php' class='btn btn-danger'>取消</a></div></form>";
                            if (isset($_POST['submit'])){
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
                                        echo "<script>window.location.href='index.php'</script>";
                                    }

                                }
                            }
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
