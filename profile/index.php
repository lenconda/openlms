<!DOCTYPE html>
<html>
  <head>
      <meta charset="UTF-8">
      <link rel="stylesheet" type="text/css" href="../bootstrap/bootstrap.css">
      <link href="../css/bootstrap-datetimepicker.css" type="text/css" rel="stylesheet">
      <link href="../css/component.css" type="text/css" rel="stylesheet">
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
    <div class="panel-body" align="center">
        <div class="col-md-10">
            <div class="row">
                <div align="center"><h3>个人中心</h3></div>


                <ul id="myTab" class="nav nav-tabs">
                    <li class="active"><a href="#profile" data-toggle="tab">个人资料</a></li>
                    <li><a href="#borrowed" data-toggle="tab">借书记录</a></li>
                    <li><a href="#returned" data-toggle="tab">还书记录</a></li>
                    <li><a href="#delay" data-toggle="tab">延迟还书申请</a></li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade in active" id="profile">
                        <?php
                            mysqli_query($link,"set NAMES 'UTF8'");
                            $profile=mysqli_query($link,"select * from `lms_user` where `id` = '{$_SESSION['UID']}'");
                            $profile_row=mysqli_fetch_array($profile);
                            echo "<h5>用户ID：".$profile_row['id']."</h5><br/>";
                            echo "<h5>姓名：".$profile_row['name']."</h5><br/>";
                            echo "<h5>学号/工号：".$profile_row['gen_id']."</h5><br/>";
                            echo "<h5>身份证号：".$profile_row['id_card']."</h5><br/>";
                            echo "<form method='get' action='#'><button name='updateinfo' class='btn btn-danger' data-toggle='modal' data-target='.myModal1' value='{$profile_row['id']}'>修改信息</button><br/><br/><button name='updatepw' class='btn btn-danger' data-toggle='modal' data-target='.myModal1_pw' value='{$profile_row['id']}'>修改密码</button></form>";
                        ?>
                    </div>
                    <div class="tab-pane fade" id="borrowed">
                        <?php
                            mysqli_query($link,"set NAMES 'UTF8'");
                            $borrowed=mysqli_query($link,"select * from `lms_borrow` where `stu_id` = '{$profile_row['id_card']}' and `if_return` = '1'");
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

                    <div class="tab-pane fade" id="returned">
                        <?php
                            mysqli_query($link,"set NAMES 'UTF8'");
                            $returned=mysqli_query($link,"select * from `lms_borrow` where `stu_id` = '{$_SESSION['IDCARD']}' and `if_return` = '0' or `if_return` = '2' ");
                            echo "<br/><table class='table table-bordered table-striped table-hover'>";     //使用表格格式化数据
                            echo "<tr><th>借阅单号</th><th>书名</th><th>出版商</th><th>ISBN</th><th>借出日期</th><th>归还日期</th><th>状态</th></tr>";
                            while ($returned_row=mysqli_fetch_array($returned)){
                                echo "<tr>";
                                echo "<td>".$returned_row['id']."</td>";
                                echo "<td>".$returned_row['book_name']."</td>";
                                echo "<td>".$returned_row['book_publisher']."</td>";
                                echo "<td>".$returned_row['book_isbn']."</td>";
                                echo "<td>".$returned_row['borrow_time']."</td>";
                                echo "<td>".$returned_row['return_time']."</td>";
                                if ($returned_row['if_return'] == '0'){
                                    echo "<td>已归还</td>";
                                }elseif ($returned_row){
                                    echo "<td>已归还(逾期)</td>";
                                }else{
                                    echo "<td>查询失败</td>";
                                }
                                echo "</tr>";
                            }
                            echo "</table>";
                        ?>
                    </div>

                    <div class="tab-pane fade" id="delay">
                        <?php
                            mysqli_query($link,"set NAMES 'UTF8'");
                            $delayed=mysqli_query($link,"select * from `lms_delay` where `applicant_id` = '{$_SESSION['IDCARD']}'");
                            echo "<br/><table class='table table-bordered table-striped table-hover'>";     //使用表格格式化数据
                            echo "<tr><th>申请序号</th><th>借阅序号</th><th>书名</th><th>出版商</th><th>迄</th><th>状态</th></tr>";
                            while ($delayed_row=mysqli_fetch_array($delayed)){
                                echo "<tr>";
                                echo "<td>".$delayed_row['id']."</td>";
                                echo "<td>".$delayed_row['book_id']."</td>";
                                echo "<td>".$delayed_row['book_name']."</td>";
                                echo "<td>".$delayed_row['book_publisher']."</td>";
                                echo "<td>".$delayed_row['return_time']."</td>";
                                if ($delayed_row['passed'] == '1'){
                                    echo "<td>未批准或被驳回</td>";
                                }elseif ($delayed_row['passed'] == '0'){
                                    echo "<td>已批准</td>";
                                }else{
                                    echo "<td>查询失败</td>";
                                }
                                echo "</tr>";
                            }
                            echo "</table>";
                        ?>
                    </div>
                </div>
                <!--<form action="borrow.php" method="get" target="_blank"><button class="btn btn-danger" type="submit">借出</button></form>-->
                <script src="../js/classie.js"></script>
                <script src="../js/modalEffects.js"></script>
            </div>
        </div>
    </div>

        <div class="modal fade myModal1"><!--modal,弹出层父级,fade使弹出层有一个运动过程-->
            <div class="modal-dialog"><!--modal-dialog,弹出层-->
                <div class="modal-content"><!--modal-content,弹出层内容区域-->
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal">×</button><!--将关闭按钮放在标题前面可以使按钮位于右上角-->
                        <h4>修改信息</h4>
                    </div><!--modal-header,弹出层头部区域-->
                    <div class="modal-body">
                        <form method="post">
                            <?php
                                $update_act=mysqli_query($link,"select * from `lms_user` where `id`='{$_GET['updateinfo']}'");
                                $update_act_row=mysqli_fetch_array($update_act);
                                echo "<label for='stu_name'>姓名</label>";
                                echo "<input name='stu_name' id='stu_name' class='form-control' type='text' style='width: auto' value='{$update_act_row['name']}'><br/>";
                                echo "<label for='gen_id'>学号/工号</label>";
                                echo "<input name='gen_id' id='gen_id' class='form-control' type='text' style='width: auto' value='{$update_act_row['gen_id']}'><br/>";
                                echo "<label for='id_card'>身份证号</label>";
                                echo "<input name='id_card' id='id_card' class='form-control' type='text' style='width: auto' value='{$update_act_row['id_card']}'><br/>";
                                echo "<div class='modal-footer'><input type='hidden' name='update_id' value='{$_GET['updateinfo']}'><input type='submit' name='submit' value='确定' class='btn btn-primary'><button class='btn btn-default' data-dismiss='modal'>取消</button></div>";
                                if (isset($_POST['submit'])){
                                    if ($_POST['stu_name'] == ''){
                                        echo "<script>alert('未填写姓名')</script>";
                                    }elseif($_POST['gen_id'] == ''){
                                        echo "<script>alert('未填写学号/工号')</script>";
                                    }elseif($_POST['id_card'] == ''){
                                        echo "<script>alert('未填写姓名')</script>";
                                    }else{
                                        $modify=mysqli_query($link,"UPDATE `lms_user` SET `name`='{$_POST['stu_name']}', `id_card` = '{$_POST['id_card']}', `gen_id` = '{$_POST['gen_id']}' WHERE `lms_user`.`id` = '{$_POST['update_id']}'");
                                        if (!$modify){
                                            echo "<script>alert('修改失败')</script>";
                                        }else{
                                            echo "<script>alert('修改成功')</script>";
                                            echo "<script>window.location.href='../jump.php?jump=profile/index.php'</script>";
                                        }
                                    }
                                }
                            ?>
                        </form>
                    </div><!--modal-body,弹出层主体区域-->
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



        <div class="modal fade myModal1_pw"><!--modal,弹出层父级,fade使弹出层有一个运动过程-->
            <div class="modal-dialog"><!--modal-dialog,弹出层-->
                <div class="modal-content"><!--modal-content,弹出层内容区域-->
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal">×</button><!--将关闭按钮放在标题前面可以使按钮位于右上角-->
                        <h4>修改密码</h4>
                    </div><!--modal-header,弹出层头部区域-->
                    <div class="modal-body">
                        <form method="post">
                            <?php
                            $modpw_act=mysqli_query($link,"select * from `lms_user` where `id`='{$_GET['updatepw']}'");
                            $modpw_act_row=mysqli_fetch_array($modpw_act);
                            echo "<input name='oldpw' class='form-control' type='password' style='width: auto' placeholder='输入原密码'><br/>";
                            echo "<input name='newpw' class='form-control' type='password' style='width: auto' placeholder='输入新密码'><br/>";
                            echo "<input name='confirm' class='form-control' type='password' style='width: auto' placeholder='确认新密码'><br/>";
                            echo "<div class='modal-footer'><input type='hidden' name='modpw_id' value='{$_GET['updatepw']}'><input type='submit' name='modpw' value='确定' class='btn btn-primary'><button class='btn btn-default' data-dismiss='modal'>取消</button></div>";
                            if (isset($_POST['modpw'])){
                                if ($_POST['oldpw'] == ''){
                                    echo "<script>alert('未输入原密码')</script>";
                                }elseif($_POST['oldpw'] != $modpw_act_row['password']){
                                    echo "<script>alert('原密码输入错误')</script>";
                                }elseif($_POST['newpw'] == ''){
                                    echo "<script>alert('未输入新密码')</script>";
                                }elseif ($_POST['confirm'] == ''){
                                    echo "<script>alert('未确认新密码')</script>";
                                }elseif($_POST['newpw'] != $_POST['confirm']){
                                    echo "<script>alert('两次输入密码不一致')</script>";
                                }else{
                                    $modpw=mysqli_query($link,"UPDATE `lms_user` SET `password`='{$_POST['newpw']}' WHERE `lms_user`.`id` = '{$_POST['modpw_id']}'");
                                    if (!$modpw){
                                        echo "<script>alert('修改密码失败')</script>";
                                    }else{
                                        echo "<script>alert('修改密码成功')</script>";
                                        echo "<script>window.location.href='../logout.php?action=logout'</script>";
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
  <?php include "../assets/footer.php";?>
</html>