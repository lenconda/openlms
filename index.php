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
                <div align="center"><h3>图书借阅排行榜</h3></div>
                <?php
                    include "config/config_inc.php";
                    mysqli_query($link,"set NAMES 'UTF8'");
                    $books=mysqli_query($link,"select * from `lms_books` order by `borrow` desc");
                    echo "<br/><table class='table'>";     //使用表格格式化数据
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
                        echo "<td><div><form method='get' action='#'><button name='br_book_id' class='btn btn-primary' data-toggle='modal' data-target='.myModal1' value='{$books_row['id']}'>借出</button></form></div></td>";
                        echo "</tr>";
                    }

                ?>
                <!--<form action="borrow.php" method="get" target="_blank"><button class="btn btn-danger" type="submit">借出</button></form>-->
                <script src="js/classie.js"></script>
                <script src="js/modalEffects.js"></script>
            </div>
        </div>
        <div class="modal fade myModal1"><!--modal,弹出层父级,fade使弹出层有一个运动过程-->
            <div class="modal-dialog"><!--modal-dialog,弹出层-->
                <div class="modal-content"><!--modal-content,弹出层内容区域-->
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal">×</button><!--将关闭按钮放在标题前面可以使按钮位于右上角-->
                        <h4>图书借阅(借出)</h4>
                    </div><!--modal-header,弹出层头部区域-->
                    <div class="modal-body">
                        <form method="post">
                            <?php
                                mysqli_query($link,"set NAMES 'UTF8'");
                                $book_info=mysqli_query($link,"select * from `lms_books` where `id`='{$_GET['br_book_id']}' ");
                                $book_info_row=mysqli_fetch_array($book_info);
                                //计时函数，获取借书时间
                                $borrow_date=date("Y-m-d",time());
                                echo "<h5>图书ID： ".$_GET['br_book_id']."</h5><br/>";
                                echo "<h5>图书名称：".$book_info_row['name']."</h5><br/>";
                                echo "<h5>图书类别：".$book_info_row['type']."</h5><br/>";
                                echo "<h5>图书作者：".$book_info_row['author']."  著</h5><br/>";
                                echo "<h5>出版商：  ".$book_info_row['publisher']."</h5><br/>";
                                echo "<h5>ISBN：   ".$book_info_row['isbn']."</h5><br/>";
                                echo "<input type='text' style='width: auto' name='stu_name' class='form-control' placeholder='填写借阅人姓名'><br/>";
                                echo "<input type='text' style='width: auto' name='stu_id' class='form-control' placeholder='填写借阅人身份证号'><br/>";
                                //设置一个隐藏的input，存放需借出图书的ID号
                                echo "<input type='hidden' name='br_book' value='{$book_info_row['id']}'>";
                                //调用日历作为日期选择器
                                echo "<h5>请选择归还日期</h5><br/>";
                                echo "<input class='form_datetime form-control' type='text' style='width: auto' readonly name='return_time' value='2017-09-07'>";
                                echo "<script type='text/javascript'>$('.form_datetime').datetimepicker({format: 'yyyy-mm-dd',autoclose: true,todayBtn: true,todayHighlight: true,showMeridian: true,pickerPosition: 'bottom-left',startView: 2,minView: 2}); </script>";

                                echo "<br/><div class='modal-footer'><input type='submit' name='submit' class='btn btn-primary' value='确定'><button type='button' data-dismiss='modal' class='btn btn-default'>取消</button></div>";
                                if (isset($_POST['submit'])){
                                    $ifexist=mysqli_query($link,"select * from `lms_user` where `name`='{$_POST['stu_name']}' and `id_card`='{$_POST['stu_id']}'");
                                    if (mysqli_num_rows($ifexist) != 1) {
                                        echo "<script>alert('未查到此人！请检查借阅者身份信息是否无误')</script>";
                                        echo "<script>window.location.href='jump.php?jump=index.php'</script>";
                                    }elseif ($_POST['return_time'] == ''){
                                        echo "<script>alert('请选择归还日期！')</script>";
                                    }else{
                                        //建立一个变量计算并存放新的借阅次数
                                        $br_time=$book_info_row['borrow'] + 1;
                                        //更新lms_books表中的borrow字段
                                        $update_info=mysqli_query($link,"update `lms_books` set `borrow`='{$br_time}' where `id`='{$_POST['br_book']}'");
                                        //新建图书借阅记录
                                        $borrow=mysqli_query($link,"INSERT INTO `lms_borrow` (`book_name`, `book_isbn`,`book_publisher`, `stu_name`, `stu_id`, `borrow_time`, `return_time`, `if_return`) VALUES ('{$book_info_row['name']}', '{$book_info_row['isbn']}', '{$book_info_row['publisher']}', '{$_POST['stu_name']}', '{$_POST['stu_id']}', '{$borrow_date}', '{$_POST['return_time']}', '1')");
                                        if (!$borrow){
                                            echo "<script>alert('借出失败')</script>";
                                        }else{
                                            echo "<script>alert('借出成功')</script>";
                                            echo "<script>window.location.href='jump.php?jump=index.php'</script>";
                                        }
                                    }
                                }
                            ?>
                        </form>
                    </div><!--modal-body,弹出层主体区域-->
                </div>
            </div>
        </div>
  </body>
  <?php include "assets/footer.php";?>
</html>