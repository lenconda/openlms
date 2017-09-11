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
      <link rel="stylesheet" type="text/css" href="../bootstrap/bootstrap.css">
      <link href="../css/bootstrap-datetimepicker.css" type="text/css" rel="stylesheet">
      <link href="../css/component.css" type="text/css" rel="stylesheet">
      <link href="../css/main.css" rel="stylesheet" type="text/css"/>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="">
      <meta name="author" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="">
      <meta name="author" content="">
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
      <script src="../js/jquery-1.9.1.js"></script>
      <script src="../js/bootstrap.js"></script>
      <script src="../js/bootstrap-datetimepicker.js"></script>
      <title>个人中心</title>
      <?php
          include "../config/config_inc.php";
          session_start();
          if ($_SESSION['Admin'] == '1'){

          }elseif ($_SESSION['Admin'] == '0'){
              echo "<script>window.location.href='../index.php'</script>";
          }else{
              echo "<script>window.location.href='../login.php'</script>";
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
                <div class="panel-body">
                    <div class="col-md-10 col-md-offset-2">
                        <div class="page-header">
                            <h1>借书记录</h1>
                        </div>
                        <?php
                        mysqli_query($link,"set NAMES 'UTF8'");
                        $borrowed=mysqli_query($link,"select * from `lms_borrow` where `stu_id` = '{$_SESSION['IDCARD']}' and `if_return` = '1'");
                        echo "<br/><table class='table table-bordered table-striped table-hover'>";     //使用表格格式化数据
                        echo "<tr><th>借阅单号</th><th>书名</th><th>出版商</th><th>ISBN</th><th>借出日期</th><th>归还日期</th><th>操作</th></tr>";
                        while ($borrowed_row=mysqli_fetch_array($borrowed)){
                            echo "<tr>";
                            echo "<td>".$borrowed_row['id']."</td>";
                            echo "<td>".$borrowed_row['book_name']."</td>";
                            echo "<td>".$borrowed_row['book_publisher']."</td>";
                            echo "<td>".$borrowed_row['book_isbn']."</td>";
                            echo "<td>".$borrowed_row['borrow_time']."</td>";
                            echo "<td>".$borrowed_row['return_time']."</td>";
                            echo "<td><div><form method='get' action='#'><button name='delay' class='btn btn-danger' data-toggle='modal' data-target='.myModal_delay' value='{$borrowed_row['id']}'>续借</button></form></div></td>";
                        }
                        echo "</tr></table>";
                        ?>
                    </div>
                </div>

            </div>
        </div>
        <div class="modal fade myModal_delay"><!--modal,弹出层父级,fade使弹出层有一个运动过程-->
            <div class="modal-dialog"><!--modal-dialog,弹出层-->
                <div class="modal-content"><!--modal-content,弹出层内容区域-->
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal">×</button><!--将关闭按钮放在标题前面可以使按钮位于右上角-->
                        <h4>选择归还日期</h4>
                    </div><!--modal-header,弹出层头部区域-->
                    <div class="modal-body">
                        <form method="post">
                            <?php
                                mysqli_query($link,"set NAMES 'UTF8'");
                                echo "<input class='form_datetime form-control' type='text' style='width: auto' readonly name='return_time' value='{$delay_info_row['return_time']}'><br/>";
                                echo "<script type='text/javascript'>$('.form_datetime').datetimepicker({format: 'yyyy-mm-dd',autoclose: true,todayBtn: true,todayHighlight: true,showMeridian: true,pickerPosition: 'bottom-left',startView: 2,minView: 2}); </script>";
                                echo "<div class='modal-footer'><input type='hidden' name='delay_id' value='{$_GET['delay']}'><input type='submit' name='delay' value='确定' class='btn btn-primary'><button class='btn btn-default' data-dismiss='modal'>取消</button></div>";
                                if (isset($_POST['delay'])){
                                    $delay_info=mysqli_query($link,"select * from `lms_borrow` where `id` = '{$_POST['delay_id']}'");
                                    $delay_info_row=mysqli_fetch_array($delay_info);
                                    $delay_act=mysqli_query($link,"INSERT INTO `lms_delay` (`id`, `book_name`, `book_id`, `book_publisher`, `applicant_name`, `applicant_id`, `return_time`, `passed`) VALUES (NULL, '{$delay_info_row['book_name']}', '{$delay_info_row['id']}', '{$delay_info_row['book_publisher']}', '{$delay_info_row['stu_name']}', '{$delay_info_row['stu_id']}', '{$_POST['return_time']}', '1')");

                                    /* ------------------------------------------------------------------------------------- */
                                    //$delay_act=mysqli_query($link,"update `lms_borrow` set `return_time` = '{$_POST['return_time']}' where `id` = '{$delay_info_row['id']}'");
                                    /* ------------------------------------------------------------------------------------- */
                                    if (!$delay_act){
                                        echo "<script>alert('续借请求失败')</script>";
                                    }else{
                                        echo "<script>alert('续借申请已成功提交，请等待审核')</script>";
                                        echo "<script>window.location.href='../jump.php?jump=profile/index.php'</script>";
                                    }
                                }
                            ?>
                        </form>
                    </div><!--modal-body,弹出层主体区域-->
                </div>
            </div>
        </div>
  </body>
</html>